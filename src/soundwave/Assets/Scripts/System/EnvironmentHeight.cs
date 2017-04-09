using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class EnvironmentHeight : MonoBehaviour {

	public Transform cameraTransform;

	public float topY = 7;
	public float bottomY = 0;
	public float deltaY = 0;

	float baseY;
	float z;

	void Start ()
	{
		baseY = transform.position.y;
		z = transform.position.z;
	}

	void Update ()
	{
		float normalizedHeight = Mathf.Clamp01((cameraTransform.position.y - bottomY) / (topY - bottomY));
		transform.position = new Vector3(0, baseY + deltaY * normalizedHeight, z);
	}
}
