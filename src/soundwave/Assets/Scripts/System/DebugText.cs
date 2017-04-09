using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class DebugText : MonoBehaviour {

	public static DebugText instance;

	private TextMesh textMesh;

	void Awake ()
	{
		instance = this;
		textMesh = GetComponent<TextMesh>();
		SetText("");
	}

	public void SetText (string text)
	{
		textMesh.text = text;
	}
}
