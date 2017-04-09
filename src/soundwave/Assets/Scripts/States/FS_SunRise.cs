using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_SunRise : FiniteState 
{
	public Transform sunTransform;
	public ColorChanger[] sceneColorChangers;

	public float sunEndY;
	public float sinkSpeedMax = 1;
	public int clapsRequired = 8;

	float clapJumpDistance;
	float sinkSpeed;
	float sinkAcceleration = 0.1f;
	float sunBeginY;
	float sunZ = 3;

	protected override void OnEnter()
	{
		sunBeginY = sunTransform.position.y;
		clapJumpDistance = (sunEndY - sunBeginY) / (float) clapsRequired;
	}

	protected override void OnProcess ()
	{
		if (Input.GetKeyDown(KeyCode.Space))
		{
			OnGoodClap();
		}
		else
		{
			sinkSpeed += sinkAcceleration * Time.deltaTime;
			SetSunY(sunTransform.position.y - sinkSpeed * Time.deltaTime);
		}
	}

	private void OnGoodClap ()
	{
		sinkSpeed = 0;
		SetSunY(sunTransform.position.y + clapJumpDistance);
	}

	private void SetSunY (float y)
	{
		if (y >= sunEndY) y = sunEndY;
		if (y < sunBeginY) y = sunBeginY;
			
		sunTransform.position = new Vector3(0, y, sunZ);
		float percentRaised = 1 - Mathf.Clamp01((sunEndY - y) / (sunEndY - sunBeginY));
		for (int i = 0; i < sceneColorChangers.Length; i++)
		{
			sceneColorChangers[i].SetChangePercentage(percentRaised);
		}

		if (y >= sunEndY)
			finiteStateController.GoToNextState();
	}
}
