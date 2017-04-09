using UnityEngine;
using System.Collections;
using UnityEngine.VR;

/// <summary>
/// FFT Spectrum Visualizer
/// When given an audio source, it renders a line within the bounds of an invisible quad.
/// </summary>

public class FFTSpectrumVisualizer : MonoBehaviour {

    const float FFT_INTERVAL = 0.01f;
    const float FFT_AVERAGE_INTERVAL = 0.5f;
    const float RMS_AVERAGE_INTERVAL = 0.5f;
    const int SPECTRUM_INDEX_CUTOFF = 0; // in an array of spectrum data, values below this index (ultra low frequency tones) are ignored

    public float heightScalar = 1;
    public AudioSource audioSource;
    [Tooltip("If true, the visualizer will show the FFT spectrum, not the wavelength")]
    public bool showFFT;
    public float minBufferValue = -1;
    public float maxBufferValue = 1;

    public void DisplaySpectrumData (float[] buffer)
    {
        liveLineRenderer.SetVertexCount(buffer.Length);

        for (int i = 0; i < buffer.Length; i++)
        {
            float pct = (float)i / buffer.Length;
            float h = buffer[i] * maxHeight * heightScalar;
            liveLineRenderer.SetPosition(i, beginPosition + deltaPosition * pct + Vector3.up * h);
        }
    }

    float countdownToFFTAnalysis;
    float maxHeight;
    int previousSamplePosition;
    LineRenderer liveLineRenderer;
    Vector3 beginPosition;
    Vector3 deltaPosition;
    Vector3 endPosition;

    void Awake ()
    {
        liveLineRenderer = GetComponent<LineRenderer>();
        MeshRenderer r = GetComponent<MeshRenderer>();
        Bounds b = r.bounds;

        maxHeight = b.extents.y;
        beginPosition = transform.position - transform.right * b.extents.x;
        beginPosition -= transform.up * maxHeight;
        endPosition = transform.position + transform.right * b.extents.x;
        endPosition -= transform.up * maxHeight;
        deltaPosition = endPosition - beginPosition;

        r.enabled = false;
        if (heightScalar <= 0) heightScalar = 1;
    }

    void Update ()
    {
        int sampleCountThisFrame = 0;

        // Get a count how many samples have played since the last update
        if (audioSource.timeSamples >= previousSamplePosition)
        {
            sampleCountThisFrame = audioSource.timeSamples - previousSamplePosition;
        }
        // The clip has looped, so we need to add the distance from the previous sample to the end, to the current position
        else
        {
            sampleCountThisFrame = audioSource.clip.samples - previousSamplePosition;
            sampleCountThisFrame += audioSource.timeSamples;
        }

        if (sampleCountThisFrame == 0) return;

        float[] audioSourceBuffer = new float[sampleCountThisFrame];

        audioSource.clip.GetData(audioSourceBuffer, previousSamplePosition);

        if (showFFT)
        {
            DisplaySpectrumData(ProcessAudioBufferFFT(audioSourceBuffer));
        }
        else
        {
            DisplaySpectrumData(audioSourceBuffer);
        }

        previousSamplePosition = audioSource.timeSamples;
    }

    // Fast Fourier Transform (FFT) of an audio buffer. This provides an array of frequency strength.
    float[] ProcessAudioBufferFFT (float[] buffer)
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

        // Cast HALF the spectrum into float that is further processed using root mean square
        int pointCount = (int)(spectrumReal.Length * 0.5f);

        float[] fftSpectrum = new float[pointCount - SPECTRUM_INDEX_CUTOFF];
        for (int i = 0; i < fftSpectrum.Length; i++)
        {
            float imaginary = (float) spectrumImaginary[i + SPECTRUM_INDEX_CUTOFF];
            float real = (float)spectrumReal[i + SPECTRUM_INDEX_CUTOFF];
            float value = Mathf.Sqrt((imaginary * imaginary) + (real * real));
            fftSpectrum[i] = Mathf.Abs(value);
        }

        return fftSpectrum;
    }

}
