using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class ScriptedMotion : MonoBehaviour {

	public float beginY;
	public AnimationCurve motionCurve;

	float moveDuration;
	float moveTimer;
	Vector3 beginPosition;
	Vector3 endPosition = Vector3.forward * -10;

	void Awake ()
	{
		beginPosition = endPosition + Vector3.up * beginY;
		transform.position = beginPosition;
		this.enabled = false;
	}

	public void MoveToEnd (float duration)
	{
		moveDuration = duration;
		moveTimer = 0;
		this.enabled = true;
	}

	void Update ()
	{
		moveTimer += Time.deltaTime * Time.timeScale;
		float t = motionCurve.Evaluate(Mathf.Clamp01(moveTimer / moveDuration));
		transform.position = Vector3.Lerp(beginPosition, endPosition, t);
	}
}
