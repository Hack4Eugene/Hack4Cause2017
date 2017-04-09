using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FS_HighNoon : FiniteState 
{
	public AudioSource song;

	protected override void OnEnter()
	{
		song.Play();
	}

	protected override void OnProcess ()
	{
	}

	protected override void OnExit ()
	{
	}
}
