using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_Ambience : FiniteState 
{
	protected override void OnEnter()
	{
		ScreenFader.instance.FadeOutToColor(Color.black, 0);
	}

	protected override void OnProcess ()
	{
		if (Input.GetKeyDown(KeyCode.Space))
		{
			finiteStateController.GoToNextState();
		}
	}

	protected override void OnExit ()
	{
	}
}
