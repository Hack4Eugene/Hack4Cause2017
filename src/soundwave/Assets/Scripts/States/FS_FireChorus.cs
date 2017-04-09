using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_FireChorus : FiniteState 
{
	public AudioSource fireStart;
	public AudioSource fireLoop;
	public MicPitch micPitch;

	protected override void OnEnter()
	{
		fireStart.Play();
		fireLoop.Play();
		CampfireController.instance.SetFireIsActive(true);
		CampfireController.instance.SetFireIsLow(false);
		CampfireController.instance.SetStrength(1);
		micPitch.SetActive(true);
	}

	protected override void OnProcess ()
	{
		CampfireController.instance.SetColorValue(micPitch.GetNormalizedPitch());

		if (Input.GetKeyDown(KeyCode.Space)) finiteStateController.GoToNextState();
	}

	protected override void OnExit ()
	{
		micPitch.SetActive(false);
	}
}
