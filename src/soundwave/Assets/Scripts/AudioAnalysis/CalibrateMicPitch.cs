using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CalibrateMicPitch : MonoBehaviour {

	public MicPitch micPitch;

	private int upperFrequencyIndex;
	private int lowerFrequencyIndex;

	void Awake ()
	{
		lowerFrequencyIndex = 1000000;
		upperFrequencyIndex = -1000000;
	}

	public void SetActive (bool isActive)
	{
		if (isActive)
		{
			micPitch.micMonitor.processNewMicrophoneFFT += ProcessBuffer;
		}
		else
		{
			micPitch.micMonitor.processNewMicrophoneFFT -= ProcessBuffer;
		}
	}

	void ProcessBuffer (float[] buffer)
	{
		float max = buffer[0];
		int dominantFrequencyIndex = 0;
		for (int i = 0; i < buffer.Length; i++) 
		{
			if (buffer [i] > max) 
			{
				max = buffer [i];
				dominantFrequencyIndex = i;
			}
		}

		if (dominantFrequencyIndex < lowerFrequencyIndex) 
		{
			lowerFrequencyIndex = dominantFrequencyIndex;
			micPitch.SetLowerBounds(lowerFrequencyIndex);
		}

		if (dominantFrequencyIndex > upperFrequencyIndex) 
		{
			upperFrequencyIndex = dominantFrequencyIndex;
			micPitch.SetUpperBounds(upperFrequencyIndex);
		}
	}

}
