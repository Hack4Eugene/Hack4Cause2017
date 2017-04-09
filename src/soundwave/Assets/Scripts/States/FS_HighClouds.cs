using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_HighClouds : FiniteState 
{
	public Transform cloudContainer;

	public MicBuffer micBuffer;
	public MicLoudness micLoudness;
	Vector3[] basePositions;
	Transform[] clouds;

	protected override void OnEnter()
	{
	/*
		micBuffer.SetActive(true);
		basePositions = new Vector3[cloudContainer.childCount];
		clouds = new Transform[cloudContainer.childCount];
		int i = 0;
		foreach (Transform t in cloudContainer)
		{
			clouds[i] = t;
			basePositions[i] = t.position;
			i++;
		}
		*/

		micLoudness.SetActive(true);
	}

	protected override void OnProcess ()
	{
		//float[] buffer = micBuffer.GetBuffer();

		if (micLoudness.GetLoudness() > 0.5f) HandleClap();

		if (Input.GetKeyDown(KeyCode.Space))
		{
			finiteStateController.GoToNextState();
		}
	}

	protected override void OnExit ()
	{
		micLoudness.SetActive(false);

		//micBuffer.SetActive(false);
	}

	private void HandleClap ()
	{
		finiteStateController.GoToNextState();
	}
}
