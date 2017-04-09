using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_StartRain : FiniteState {

	public ParticleSystem rainParticles;
	public float startRainDuration = 5;
	public AnimationCurve bringRainCurve;
	public MicLoudness audienceLoudness;
	[Range(0,1)]
	public float minLoudness = 0.4f;

	private float baseRate;
	private float rainAcceleration;
	private float rainAmount;
	private ParticleSystem.EmissionModule rainEmitter;

	protected override void OnInitialize()
	{
		rainEmitter = rainParticles.emission;
		baseRate = rainEmitter.rateOverTimeMultiplier;
		rainAcceleration = baseRate / startRainDuration;
		rainEmitter.rateOverTimeMultiplier = 0;
		rainEmitter.enabled = false;
	}

	protected override void OnEnter ()
	{
		rainEmitter.enabled = true;
		audienceLoudness.SetActive(true);
	}

	protected override void OnProcess ()
	{
		// if the audience mic loudness is over a certain level
		bool isAudienceLoud = audienceLoudness.GetLoudness() >= minLoudness;

		// Emergency override
		if (isAudienceLoud == false) isAudienceLoud = Input.GetKey(KeyCode.Space);

		string debugText = audienceLoudness.GetLoudness().ToString("0.00") + " / " + minLoudness.ToString("0.00");
		DebugText.instance.SetText(debugText);

		if (isAudienceLoud)
		{
			rainAmount += rainAcceleration * Time.deltaTime;
		}
		else
		{
			rainAmount -= rainAcceleration * Time.deltaTime;
		}

		rainAmount = Mathf.Clamp(rainAmount, 0, baseRate);

		float t = bringRainCurve.Evaluate(rainAmount / baseRate);

		RainAudio.instance.SetHighRainVolume(t);
		rainEmitter.rateOverTimeMultiplier = t * baseRate;

		if (rainAmount >= baseRate)
		{
			finiteStateController.GoToNextState();
		}
	}

	protected override void OnExit ()
	{
		DebugText.instance.SetText("");
		audienceLoudness.SetActive(false);
	}
}
