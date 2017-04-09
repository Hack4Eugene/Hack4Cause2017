using UnityEngine;
using System.Collections;
using UnityEngine.VR;

// http://forum.unity3d.com/threads/real-time-audio-from-microphone.145686/

public class MicMonitor : MonoBehaviour
{
    public class rmsEventData
    {
        public float rmsValue { get; private set; }
        float timeSinceLevelLoad;
        public rmsEventData (float rmsValue)
        {
            this.rmsValue = rmsValue;
            timeSinceLevelLoad = Time.timeSinceLevelLoad;
        }
        public bool IsInsideInterval (float intervalSeconds)
        {
            if (Time.timeSinceLevelLoad - timeSinceLevelLoad < intervalSeconds) return true;
            return false;
        }
    }

    public class fftIntervalData
    {
        public float[] fftData { get; private set; }
        float timeSinceLevelLoad;
        public fftIntervalData (float[] newFFTData)
        {
            // hard copy to avoid reference issues
            fftData = new float[newFFTData.Length];
            for (int i = 0; i < fftData.Length; i++) fftData[i] = newFFTData[i];
            timeSinceLevelLoad = Time.timeSinceLevelLoad;
        }
        public bool IsInsideInterval(float intervalSeconds)
        {
            if (Time.timeSinceLevelLoad - timeSinceLevelLoad < intervalSeconds) return true;
            return false;
        }
    }

    public static MicMonitor Instance;

    public int preferredMicIndex;

    public delegate void ProcessNewMicrophoneBuffer (float[] buffer);
    public ProcessNewMicrophoneBuffer processNewMicrophoneBuffer;

    // "FFT" stands for Fast Fourier Transform. Spectrum analysis.
    public delegate void ProcessNewMicrophoneFFT(float[] fftSpectrum);
    public ProcessNewMicrophoneFFT processNewMicrophoneFFT;

    // "RMS" stands for Root Mean Square. Loudness value.
    public delegate void ProcessNewMicrophoneRMS(float rmsIntervalAverage);
    public ProcessNewMicrophoneRMS processNewMicrophoneRMS;

    public EVoxType currentVoxType { get; set; }

    public float[] fftAverageOverInterval { get; private set; }

    public float rmsAverageOverInterval { get; private set; }
    public int fftSampleDataLength { get; set; }

    public float GetVoxRmsLevel (EVoxType voxType)
    {
        return voxRmsLevels[(int)voxType];
    }

    public void SetVoxRmsLevel (EVoxType voxType, float rmsLevel)
    {
        PlayerPrefs.SetFloat(voxType.ToString(), rmsLevel);
        voxRmsLevels[(int)voxType] = rmsLevel;
    }

    const float FFT_INTERVAL = 0.01f;
    const float FFT_AVERAGE_INTERVAL = 0.5f;
    const float RMS_AVERAGE_INTERVAL = 0.5f;
    const int SPECTRUM_INDEX_CUTOFF = 16; // in an array of spectrum data, values below this index (ultra low frequency tones) are ignored

    ArrayList rmsEventList;
    ArrayList fftIntervalDataList;
    AudioSource audioSource;
    float countdownToFFTAnalysis;
    float previousBufferEvaluationTime;
    int readHead;
    int sampleRate = 8000;
    public string micDeviceName;
    float[] voxRmsLevels;
    public float minBufferValue;
    public float maxBufferValue;

    void Awake()
    {
        Instance = this;

        audioSource = GetComponent<AudioSource>();

        if (Microphone.devices.Length == 0)
        {
            Debug.LogError("No microphone detected");
            this.enabled = false;
            return;
        }

        bool foundMic = false;
        for (int i = 0; i < Microphone.devices.Length; i++)
        {
            Debug.Log("Mic [" + i + "]: " + Microphone.devices[i]);
			if (i == preferredMicIndex)
			{
				micDeviceName = Microphone.devices[i];
				foundMic = true;
			}
        }

        if (foundMic == false)
        {
			micDeviceName = Microphone.devices[0];
        }

        int minFreq = 1234;
        int maxFreq = 1234;
        Microphone.GetDeviceCaps(micDeviceName, out minFreq, out maxFreq);
        Debug.Log(micDeviceName + " Min Freq: " + minFreq + " // Max Freq: " + maxFreq);

        audioSource.clip = Microphone.Start(
        deviceName: micDeviceName,
        loop: true,
        lengthSec: 1,
        frequency: sampleRate
        );

        SetupBuffers();

        rmsEventList = new ArrayList();
        fftIntervalDataList = new ArrayList();

        voxRmsLevels = new float[System.Enum.GetValues(typeof(EVoxType)).Length];
        for (int i = 0; i < voxRmsLevels.Length; i++)
        {
            string key = ((EVoxType)i).ToString();
            if (PlayerPrefs.HasKey(key)) voxRmsLevels[i] = PlayerPrefs.GetFloat(key);
            else voxRmsLevels[i] = 0;
        }
    }

    // Fast Fourier Transform (FFT) of an audio buffer. This provides an array of frequency strength.
    void ProcessAudioBufferFFT (float[] buffer)
    {
        // Because the FFT process is processor intensive, order of operation matters for these commands

        // Initialize the FFT
        uint log2 = 0;
        uint.TryParse(Mathf.Log(buffer.Length, 2).ToString(), out log2);
        FFT fftAnalysis = new FFT();
        fftAnalysis.Init(log2);

        // Create the arrays holding our data
        double[] spectrumReal = new double[buffer.Length];
        for (int i = 0; i < buffer.Length; i++) spectrumReal[i] = (double)buffer[i];
        double[] spectrumImaginary = new double[buffer.Length];

        // Run the FFT and modify the array values in place
        fftAnalysis.Run(spectrumReal, spectrumImaginary);

        // Cast HALF the spectrum into float that is further processing using root mean square
        int pointCount = (int)(spectrumReal.Length * 0.5f);
        float[] fftSpectrum = new float[pointCount - SPECTRUM_INDEX_CUTOFF];
        for (int i = 0; i < fftSpectrum.Length; i++)
        {
            float imaginary = (float) spectrumImaginary[i + SPECTRUM_INDEX_CUTOFF];
            float real = (float)spectrumReal[i + SPECTRUM_INDEX_CUTOFF];
            float value = Mathf.Sqrt((imaginary * imaginary) + (real * real));
            fftSpectrum[i] = Mathf.Abs(value);
        }

        UpdateFFTAverageOverInterval(fftSpectrum);

        // Inform delegates
        if (processNewMicrophoneFFT != null)
            processNewMicrophoneFFT(fftSpectrum);
    }

    // Root Mean Square (RMS) of an audio buffer. This returns a good loudness estimate.
    void ProcessAudioBufferRMS (float[] buf)
    {
        float deltaTime = Time.timeSinceLevelLoad - previousBufferEvaluationTime;
        previousBufferEvaluationTime = Time.timeSinceLevelLoad;

        // Fixed Update can run multiple times before Update, meaning we occasionally get zero length intervals
        if (deltaTime == 0)
            return;
 
        // Find Root Mean Squared
        double totalSquared = 0;

        for (int i = 0; i < buf.Length; i++)
        {
            totalSquared += buf[i] * buf[i];
            if (buf[i] < minBufferValue) minBufferValue = buf[i];
            if (buf[i] > maxBufferValue) maxBufferValue = buf[i];
        }

        double meanSquared = totalSquared / (double)buf.Length;

        float meanSquaredFloat = -1;
        float.TryParse(totalSquared.ToString(), out meanSquaredFloat);

        if (meanSquaredFloat == -1)
        {
            Debug.LogError("ProcessAudioBufferRMS could not parse double " + meanSquared.ToString());
            return;
        }

        float rootMeanSquared = Mathf.Sqrt(meanSquaredFloat);

        UpdateRMSAverageOverInterval(rootMeanSquared);
    }

    void Update ()
    {
        countdownToFFTAnalysis -= Time.deltaTime;
    }

    void UpdateFFTAverageOverInterval (float[] newFFTData)
    {
        if (newFFTData.Length != fftSampleDataLength) return;

        float[] fftAverageOverInterval = new float[fftSampleDataLength];
        float count = 0;

        fftIntervalDataList.Add(new fftIntervalData(newFFTData));

        for (int i = fftIntervalDataList.Count - 1; i >= 0; i--)
        {
            fftIntervalData data = (fftIntervalData)fftIntervalDataList[i];
            if (data.IsInsideInterval(RMS_AVERAGE_INTERVAL) == false)
            {
                rmsEventList.RemoveAt(i);
            }
            else
            {
                for (int i2 = 0; i2 < fftAverageOverInterval.Length; i2++)
                {
                    fftAverageOverInterval[i2] = data.fftData[i2];
                }
                count++;
            }
        }

        if (count != 0)
        {
            for (int i = 0; i < fftAverageOverInterval.Length; i++)
            {
                fftAverageOverInterval[i] /= count;
            }
        }
    }

    // Whenever a Root Mean Square is calculated for an audio buffer, it's sent here.
    // This finds the RMS average over a period of time defined as RMS_AVERAGE_INTERVAL.
    void UpdateRMSAverageOverInterval(float newRmsValue)
    {
        float total = 0;
        float count = 0;
        for (int i = rmsEventList.Count - 1; i >= 0; i--)
        {
            rmsEventData data = (rmsEventData)rmsEventList[i];
            if (data.IsInsideInterval(RMS_AVERAGE_INTERVAL) == false)
            {
                rmsEventList.RemoveAt(i);
            }
            else
            {
                total += data.rmsValue;
                count++;
            }
        }

        rmsEventList.Add(new rmsEventData(newRmsValue));

        total += newRmsValue;
        count++;
        rmsAverageOverInterval = total / count;

        if (rmsAverageOverInterval <= GetVoxRmsLevel(EVoxType.Silence)) currentVoxType = EVoxType.Silence;
        else if (rmsAverageOverInterval < GetVoxRmsLevel(EVoxType.Talking) * 0.5f) currentVoxType = EVoxType.Breathing;
        else currentVoxType = EVoxType.Talking;

        if (processNewMicrophoneRMS != null)
            processNewMicrophoneRMS(rmsAverageOverInterval);
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    // Buffers

    /*
        every frame in FixedUpdate(), we send all new mic data to all listeners
        say e.g. 610 samples have arrived
        the obvious approach is to dynamically allocate 612 floats and copy 612 floats out of the ring buffer
        this is BAD.
        dynamic allocation in real-time audio is BAD.

        solution:
        pre-allocate buffers of length 1,2,4,8,…,512,1024
        now 610 =  512 + 64 + 32 + 2

        so we could just fill up some of our preallocated POT (power of 2) buffers and make a
                separate delegate callback for each.

        furthermore we can decide to hold back up to e.g. 63 samples
        so this frame we sent back 512 + 64,  leaving 34 which will be sent in the next update
        this reduces overhead of function calls;

        additionally there is a potential problem that the streamer may change the contents of a
                particular buffer while one of the listeners is chewing on it.

        solution here is to create say 8 buffers of each size and cycle through them.
    */

    class POTBuf
    {
        public const int POT_min = 6;      // 2^6 = 64
        public const int POT_max = 10;      // 2^10 = 1024

        const int redundancy = 8;
        int index = 0;

        float[][] internalBuffers = new float[redundancy][];

        public float[] buf
        {
            get
            {
                return internalBuffers[index];
            }
        }

        public void Cycle()
        {
            index = (index + 1) % redundancy;
        }

        public POTBuf(int POT)
        {
            for (int r = 0; r < redundancy; r++)
            {
                internalBuffers[r] = new float[1 << POT];
            }
        }
    }

    POTBuf[] potBuffers = new POTBuf[POTBuf.POT_max + 1];

    void SetupBuffers()
    {
        for (int k = POTBuf.POT_min; k <= POTBuf.POT_max; k++)
            potBuffers[k] = new POTBuf(k);
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    void FixedUpdate()
    {
        FlushToListeners();
    }

    // - - -

    void FlushToListeners()
    {
        int writeHead = Microphone.GetPosition(micDeviceName);

        if (readHead == writeHead || potBuffers == null)
            return;

        // Say audio.clip.samples (S)  = 100
        // if w=1, r=0, we want 1 sample.  ( S + 1 - 0 ) % S = 1 YES
        // if w=0, r=99, we want 1 sample.  ( S + 0 - 99 ) % S = 1 YES
        int nFloatsToGet = (audioSource.clip.samples + writeHead - readHead) % audioSource.clip.samples;

        // Get buffer values
        for (int k = POTBuf.POT_max; k >= POTBuf.POT_min; k--)
        {
            POTBuf B = potBuffers[k];

            int n = B.buf.Length; // i.e.  1 << k;

            while (nFloatsToGet >= n)
            {

                // If the read length from the offset is longer than the clip length,
                //   the read will wrap around and read the remaining samples
                //   from the start of the clip.
                audioSource.clip.GetData(B.buf, readHead);
                readHead = (readHead + n) % audioSource.clip.samples;

                if (countdownToFFTAnalysis <= 0)
                {
					if (processNewMicrophoneBuffer != null) processNewMicrophoneBuffer(B.buf);
                    ProcessAudioBufferFFT(B.buf);
                    countdownToFFTAnalysis = FFT_INTERVAL;
                }

                ProcessAudioBufferRMS(B.buf);

                // moving away from other programs processing raw mic input
                //if (processMicBufferDelegate != null)
                //    processMicBufferDelegate(B.buf);

                B.Cycle();
                nFloatsToGet -= n;
            }
        }
    }
}
