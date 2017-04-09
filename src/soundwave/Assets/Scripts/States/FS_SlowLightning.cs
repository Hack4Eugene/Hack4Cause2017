using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_SlowLightning : FiniteState 
{
	public AudioSource thunderclap;
	public AudioLightningController lightning;
	public ScriptedMotion cameraMotion;
	public float moveDuration = 1;
	public float timeScale = 0.1f;
	public ParticleSystem lightningStrikeParticles;

	private float totalMoveDuration;

	protected override void OnEnter()
	{
		ScreenFader.instance.FadeInFromColor(Color.white, 0.2f);
		cameraMotion.MoveToEnd(moveDuration);
		lightning.Activate(moveDuration);
		RainAudio.instance.SetHighRainPitch(timeScale);
		Time.timeScale = timeScale;
		totalMoveDuration = moveDuration;
	}

	protected override void OnProcess ()
	{
		moveDuration -= Time.deltaTime * Time.timeScale;

		float t = moveDuration / totalMoveDuration;
		RainAudio.instance.SetHighRainVolume(t);

		if (moveDuration <= 0)
		{
			lightning.Deactivate();
			ScreenFader.instance.FadeInFromColor(Color.white, 1f);
			Time.timeScale = 1;
			RainAudio.instance.SetLowRainVolume(1);
			lightningStrikeParticles.Play();
			thunderclap.Play();
			finiteStateController.GoToNextState();
		}
	}

	protected override void OnExit ()
	{
	}
}
