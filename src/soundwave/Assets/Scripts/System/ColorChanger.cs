using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ColorChanger : MonoBehaviour {

	public Color endColor;

	private Color beginColor;
	private Material newMaterial;
	private MeshRenderer meshRenderer;

	public void SetChangePercentage (float percentage)
	{
		newMaterial.color = Color.Lerp(beginColor, endColor, percentage);
	}

	void Awake ()
	{
		meshRenderer = GetComponent<MeshRenderer>();
		newMaterial = (Material) Instantiate (meshRenderer.material);
		meshRenderer.material = newMaterial;
		beginColor = newMaterial.color;
	}

}
