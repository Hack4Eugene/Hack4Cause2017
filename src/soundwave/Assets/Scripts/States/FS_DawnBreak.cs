using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_DawnBreak : FiniteState 
{
	public float transitionDuration = 5;
	public Color endSkyColor;
	public Transform sunTransform;
	public float sunEndY;
	public float sunBeginY;
	public float sunZ = 3;

	private Color beginSkyColor;
	private float transitionTimer;

	protected override void OnInitialize ()
	{
		sunTransform.position = new Vector3(0, sunBeginY, sunZ);
	}

	protected override void OnEnter()
	{
		beginSkyColor = Camera.main.backgroundColor;
	}

	protected override void OnProcess ()
	{
		transitionTimer += Time.deltaTime;
		float t = transitionTimer / transitionDuration;
		Camera.main.backgroundColor = Color.Lerp(beginSkyColor, endSkyColor, t);
		float sunY = Mathf.Lerp(sunBeginY, sunEndY, t);
		sunTransform.position = new Vector3(0, sunY, sunZ);
		if (t >= 1)
		{
			finiteStateController.GoToNextState();
		}
	}

	protected override void OnExit ()
	{
	}
}
