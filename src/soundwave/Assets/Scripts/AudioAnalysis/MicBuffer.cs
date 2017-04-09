using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class MicBuffer : MonoBehaviour {

	public MicMonitor micMonitor;

	private float[] buffer;

	public void SetActive (bool isActive)
	{
		if (isActive)
		{
			micMonitor.processNewMicrophoneBuffer += SetBuffer;
		}
		else
		{
			micMonitor.processNewMicrophoneBuffer -= SetBuffer;
		}
	}

	public void SetBuffer (float[] newBuffer)
	{
		buffer = newBuffer;
	}

	public float[] GetBuffer ()
	{
		return buffer;
	}
}
