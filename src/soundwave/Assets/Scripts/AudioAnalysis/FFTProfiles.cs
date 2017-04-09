using UnityEngine;
using System.Collections;

public class FFTProfiles : MonoBehaviour {

    public static FFTProfiles Instance;

    public float[] GetProfileData (EFFTProfileType profileType)
    {
        int profileId = (int)profileType;
        float[] spectrumPoints;

        if (fftProfileData[profileId] == null)
        {
            spectrumPoints = new float[] { 0, 0 };
        }
        else
        {
            int pointCount = fftProfileData[profileId].Length;
            spectrumPoints = new float[pointCount];
            for (int i = 0; i < pointCount; i++) spectrumPoints[i] = fftProfileData[profileId][i];
        }
        return spectrumPoints;
    }

    public bool HasProfileData (EFFTProfileType profileType)
    {
        if (GetProfileData(profileType).Length == 2) return false;
        return true;
    }

    public void SetProfileData (float[] spectrumPoints, EFFTProfileType profileType)
    {
        int profileId = (int)profileType;
        int pointCount = spectrumPoints.Length;
        fftProfileData[profileId] = new float[pointCount];
        for (int i = 0; i < pointCount; i++) fftProfileData[profileId][i] = spectrumPoints[i];
    }

    float[][] fftProfileData;

    void Awake ()
    {
        Instance = this;
        fftProfileData = new float[System.Enum.GetValues(typeof(EFFTProfileType)).Length][];
    }

}
