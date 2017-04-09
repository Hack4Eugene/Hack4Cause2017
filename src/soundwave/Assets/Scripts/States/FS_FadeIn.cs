using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_FadeIn : FiniteState 
{
	public float fadeTime = 2;

	protected override void OnEnter()
	{
		ScreenFader.instance.FadeInFromColor(Color.black, fadeTime);
	}

	protected override void OnProcess ()
	{
		fadeTime -= Time.deltaTime;
		if (fadeTime <= 0) finiteStateController.GoToNextState();
	}

	protected override void OnExit ()
	{
	}
}
