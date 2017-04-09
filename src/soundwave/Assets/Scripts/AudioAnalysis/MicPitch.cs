using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class MicPitch : MonoBehaviour {

	public MicMonitor micMonitor;

	private float normalizedPitch;
	private int lowerBounds;
	private int upperBounds;
	private int maxFrequency; 

	private void Awake ()
	{
		lowerBounds = 10;
		upperBounds = 80;
	}

	// returns a value of zero to one
	public float GetNormalizedPitch ()
	{
		return normalizedPitch;
	}

	public void SetActive (bool isActive)
	{
		if (isActive)
		{
			micMonitor.processNewMicrophoneFFT += HandleNewMicrophoneFFT;
		}
		else
		{
			micMonitor.processNewMicrophoneFFT -= HandleNewMicrophoneFFT;
		}
	}

	public void SetLowerBounds (int lBounds)
	{
		lowerBounds = lBounds;
	}


	public void SetUpperBounds (int uBounds)
	{
		upperBounds = uBounds;
	}

	private void HandleNewMicrophoneFFT (float[] buffer)
	{
		// only if maxFrequency has not been defined
		//if (!maxFrequency) maxFrequency = buffer.Length;

		// determine what the loudest frequency is
		int loudestFrequency = getDominantFrequencyIndex(buffer);
		normalizedPitch = Mathf.Clamp01((upperBounds - loudestFrequency) / (upperBounds - lowerBounds));
	}

	private int getDominantFrequencyIndex(float[] buffer)
	{
		float max = buffer[0];
		int index = 0;
		for (int i = 0; i < buffer.Length; i++) {
			if (buffer [i] > max) {
				max = buffer [i];
				index = i;
			}
		}
		return index;
	}

}