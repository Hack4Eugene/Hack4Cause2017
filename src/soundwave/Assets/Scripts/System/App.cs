using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class App : MonoBehaviour {

	public static App instance;

	private void Awake ()
	{
		instance = this;
	}

	void Update () 
	{
		if (Input.GetKeyDown(KeyCode.Escape))
		{
			Application.Quit();
		}
	}
}
