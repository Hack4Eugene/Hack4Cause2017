using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class MicLoudness : MonoBehaviour {

	public MicMonitor micMonitor;

	public float currentLoudness;

	private float targetLoudness;

	public float GetLoudness ()
	{
		return currentLoudness;
	}

	public bool IsLoudEnough ()
	{
		return currentLoudness >= targetLoudness;
	}

	public void SetActive (bool isActive)
	{
		if (isActive)
		{
			micMonitor.processNewMicrophoneRMS += HandleNewLoudnessValue;
		}
		else
		{
			micMonitor.processNewMicrophoneRMS -= HandleNewLoudnessValue;
		}
	}

	public void SetTargetLoudness (float value)
	{
		targetLoudness = value;
	}

	private void HandleNewLoudnessValue (float value)
	{
		currentLoudness = value;
	}
}
