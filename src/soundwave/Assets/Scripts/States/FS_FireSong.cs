using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_FireSong : FiniteState 
{
	public float rainFadeDuration = 10;
	public ParticleSystem rainParticles;
	public ParticleSystem smokeParticles;
	public MicLoudness micLoudness;

	private float rainFadeTimer;
	private float baseRate;
	private ParticleSystem.EmissionModule rainEmitter;

	protected override void OnInitialize ()
	{
		ParticleSystem.EmissionModule smokeEmitter = smokeParticles.emission;
		smokeEmitter.enabled = false;
	}

	protected override void OnEnter()
	{
		ParticleSystem.EmissionModule smokeEmitter = smokeParticles.emission;
		smokeEmitter.enabled = true;

		rainEmitter = rainParticles.emission;
		baseRate = rainEmitter.rateOverTimeMultiplier;
		CampfireController.instance.SetFireIsActive(true);
		micLoudness.SetActive(true);
	}

	protected override void OnProcess ()
	{
		rainFadeTimer += Time.deltaTime;
		float t = 1 - Mathf.Clamp01(rainFadeTimer / rainFadeDuration);
		rainEmitter.rateOverTimeMultiplier = baseRate * t;
		RainAudio.instance.SetLowRainVolume(t);
		float loudness = micLoudness.GetLoudness();
		CampfireController.instance.SetStrength(loudness);
		CampfireController.instance.SetColorValue(loudness);
		if (Input.GetKeyDown(KeyCode.Space)) finiteStateController.GoToNextState();
	}

	protected override void OnExit ()
	{
		micLoudness.SetActive(false);
	}
}
