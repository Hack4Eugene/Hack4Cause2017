using UnityEngine;
using System.Collections;
using System.Collections.Generic;

// Controls input for FFTProfiles

public class FFTProfileInterface : MonoBehaviour
{
    public void DetermineCurrentFFTProfile (float[] micFFTData)
    {
        if (FFTProfiles.Instance.HasProfileData(EFFTProfileType.Room))
        {
            if (FFTProfiles.Instance.HasProfileData(activeProfileType))
            {
                float[] profileFFTData = FFTProfiles.Instance.GetProfileData(activeProfileType);
                float[] roomFFTData = FFTProfiles.Instance.GetProfileData(EFFTProfileType.Room);
                float[] spectrumDeltas = new float[profileFFTData.Length];
                float spectrumDeltaSum = 0;
                float min = Mathf.Infinity;
                float max = 0;
                int matchesProfileCount = 0;
                float factor = 4;
                float maxDelta = 0.004f;
                float[] deltas = new float[profileFFTData.Length];

                if (profileFFTData.Length == micFFTData.Length && roomFFTData.Length == micFFTData.Length)
                {
                    for (int i = 0; i < profileFFTData.Length; i++)
                    {
                        float mic = micFFTData[i] - roomFFTData[i];
                        float profile = profileFFTData[i] - roomFFTData[i];

                        mic = Mathf.Abs(mic);
                        profile = Mathf.Abs(profile);

                        float delta = mic - profile;
                        deltas[i] = Mathf.Abs(delta);

                        //float rmsDelta = Mathf.Sqrt((mic * mic) + (profile * profile));

                        if (delta < min) min = delta;
                        if (delta > max) max = delta;

                        spectrumDeltas[i] = mic - profile;
                        spectrumDeltaSum += (mic - profile);

                        //if (micFFTData[i] == 0) matchesProfileCount++;
                        //else if (micFFTData[i] < profileFFTData[i] * factor) matchesProfileCount++;

                        if (Mathf.Abs(delta) < maxDelta) matchesProfileCount++;
                    }
                }
                else return;

                if (showMinMaxForNextFFT)
                {
                    //Debug.Log("Min: " + min + " // Max: " + max + " // Sum: " + spectrumDeltaSum + " // Factor: " + (spectrumDeltaSum/ max));
                    Debug.Log(profileFFTData.Length + " samples. " + matchesProfileCount + " match (less than profile x " + factor + ")");
                    showMinMaxForNextFFT = false;
                }

                float matchPct = matchesProfileCount / (float)profileFFTData.Length;

                float totalDelta = 0;
                for (int i = 0; i < deltas.Length; i++) totalDelta += deltas[i];
                float averageDelta = totalDelta / deltas.Length;

                txtTitle.text = "Match: " + matchPct.ToString("F2") + " (avg. delta " + averageDelta.ToString("F4") + ")"; //+ spectrumDeltaSum.ToString("F8");
                //Debug.Log("Match: " + spectrumDeltaSum.ToString("F8"));
            }
            else
            {
                txtTitle.text = "Record Profile for " + activeProfileType.ToString();
            }
        }
        else
        {
            txtTitle.text = "Record Profile for Room";
        }
    }

    public void StartRecordingFFTProfile ()
    {
        Debug.Log("Start Recording FFT Profile");
        rawFFTData = new ArrayList();
        MicMonitor.Instance.processNewMicrophoneFFT += UpdateActiveFFTProfile;
        fftDataCounts = new Dictionary<int, int>();
    }

    public void StopRecordingFFTProfile ()
    {
        MicMonitor.Instance.processNewMicrophoneFFT -= UpdateActiveFFTProfile;

        int samplesArrayLength = 0;
        int samplesArrayCount = 0;
        foreach (KeyValuePair<int, int> entry in fftDataCounts)
        {
            if (entry.Value > samplesArrayCount)
            {
                samplesArrayCount = entry.Value;
                samplesArrayLength = entry.Key;
            }
            //Debug.Log(entry.Key + " samples: " + entry.Value + " entries");
        }
        Debug.Log("Stopped Recording FFT Profile. Using " + samplesArrayCount + " arrays of " + samplesArrayLength + " samples");

        // Sum all profile data matching sample length 
        float[] fftProfile = new float[samplesArrayLength];
        for (int i = 0; i < rawFFTData.Count; i++)
        {
            float[] rawData = (float[])rawFFTData[i];
            if (rawData.Length == samplesArrayLength)
            {
                for  (int i2 = 0; i2 < rawData.Length; i2++)
                {
                    fftProfile[i2] += rawData[i2];
                }
            }
        }
        
        // Average profile samples
        for (int i = 0; i < fftProfile.Length; i++)
        {
            fftProfile[i] /= (float)samplesArrayLength;
        }

        FFTProfiles.Instance.SetProfileData(fftProfile, activeProfileType);
        profileFFTVis.DisplaySpectrumData(fftProfile);

    }

    public void UpdateActiveFFTProfile (float[] FFTspectrumData)
    {
        rawFFTData.Add(FFTspectrumData);

        // use the count as a key
        int count = FFTspectrumData.Length;
        if (fftDataCounts.ContainsKey(count)) fftDataCounts[count]++;
        else fftDataCounts.Add(count, 1);

        profileFFTVis.DisplaySpectrumData(FFTspectrumData);
    }

    public FFTSpectrumVisualizer liveFFTVis;
    public FFTSpectrumVisualizer profileFFTVis;
    public TextMesh txtInstructions;
    public TextMesh txtProfileTypes;
    public TextMesh txtTitle;

    ArrayList rawFFTData;
    bool showMinMaxForNextFFT;
    Dictionary<int, int> fftDataCounts;
    EFFTProfileType activeProfileType;
    float maxHeight;
    float[] spectrumPoints;
    LineRenderer profileLineRenderer;
    Vector3 beginPosition;
    Vector3 deltaPosition;
    Vector3 endPosition;

    void Awake ()
    {
        profileLineRenderer = GetComponent<LineRenderer>();
        MeshRenderer r = GetComponent<MeshRenderer>();
        Bounds b = r.bounds;
        maxHeight = b.extents.y;
        beginPosition = transform.position - transform.right * b.extents.x;
        beginPosition -= transform.up * maxHeight;
        endPosition = transform.position + transform.right * b.extents.x;
        endPosition -= transform.up * maxHeight;
        deltaPosition = endPosition - beginPosition;

        r.enabled = false;
        spectrumPoints = new float[512];
    }

    void Start ()
    {
        MicMonitor.Instance.processNewMicrophoneFFT += liveFFTVis.DisplaySpectrumData;
        MicMonitor.Instance.processNewMicrophoneFFT += DetermineCurrentFFTProfile;
        SwitchToProfile((EFFTProfileType)0);
    }

    void SwitchToProfile (EFFTProfileType newProfile)
    {
        activeProfileType = newProfile;
        profileFFTVis.DisplaySpectrumData(FFTProfiles.Instance.GetProfileData(activeProfileType));
        MicMonitor.Instance.fftSampleDataLength = FFTProfiles.Instance.GetProfileData(activeProfileType).Length;
    }

    void Update ()
    {
        string profileString = "";
        for (int i = 0; i < System.Enum.GetValues(typeof(EFFTProfileType)).Length; i++)
        {
            if (i == (int)activeProfileType) profileString += "<color=white>";
            else profileString += "<color=#333>";
            profileString += "(" + (i+1).ToString() + ") " + ((EFFTProfileType)i).ToString();
            profileString += "</color>";
            if (i < System.Enum.GetValues(typeof(EFFTProfileType)).Length - 1) profileString += "       ";
        }
        txtProfileTypes.text = profileString;

        if (Input.GetKeyDown(KeyCode.Alpha1)) SwitchToProfile((EFFTProfileType)0);
        if (Input.GetKeyDown(KeyCode.Alpha2)) SwitchToProfile((EFFTProfileType)1);
        if (Input.GetKeyDown(KeyCode.Alpha3)) SwitchToProfile((EFFTProfileType)2);

        if (Input.GetKeyDown(KeyCode.Space)) StartRecordingFFTProfile();
        else if (Input.GetKeyUp(KeyCode.Space)) StopRecordingFFTProfile();

        if (Input.GetKeyDown(KeyCode.A))
        {
            showMinMaxForNextFFT = true;
        }
    }
}
