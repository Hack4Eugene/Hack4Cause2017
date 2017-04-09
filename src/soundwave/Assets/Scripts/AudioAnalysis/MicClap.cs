using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;

public class MicClap : MonoBehaviour {

	public MicMonitor micMonitor;

	public delegate void MicClapEvent ();
	public MicClapEvent OnMicClapEvent;

	private float lowerBounds;
	private float upperBounds;
	private int loudnessChangeDirection = 0;
	private const float clapThreshold = 0.3f;
	private const float significantChange = 0.05f;
	private float edgeStartLoudness;

	private LinkedList<float> loudnessSamples = new LinkedList<float>();

	private void Awake ()
	{
		// default values
		lowerBounds = 0.1f;
		upperBounds = 1;
	}

	public void SetActive (bool isActive)
	{
		if (isActive)
		{
			micMonitor.processNewMicrophoneRMS += HandleNewMicrophoneLoudness;
		}
		else
		{
			micMonitor.processNewMicrophoneRMS -= HandleNewMicrophoneLoudness;
		}
	}

	public void SetLowerBounds (float lBounds)
	{
		lowerBounds = lBounds;
	}

	public void SetUpperBounds (float uBounds)
	{
		upperBounds = uBounds;
	}

	float smooth(float value, LinkedList<float> list, float smoothing) {
		float previous;
		if (list.Count > 0) {
			previous = list.Last.Value;
		} else {
			previous = value;
		}
		return (value - previous) / smoothing;
	}

	private void HandleNewMicrophoneLoudness (float loudness)
	{
		bool detectedClap = false;

		// process
		float loudnessRange = upperBounds - lowerBounds;
		// the frequency as a float within the calibrated upper/lower range
		float loudnessPcent = (loudness - lowerBounds) / loudnessRange;
		loudness = smooth (loudnessPcent, loudnessSamples, 1.5f);

		if (loudnessSamples.Count >= 16) {
			loudnessSamples.RemoveFirst();
		}

		float previous = loudnessSamples.Count > 0 ? loudnessSamples.Last.Value : loudness;
		float delta = loudness - previous;
		DebugText.instance.SetText(delta.ToString());
		int previousDirection = loudnessChangeDirection; 

		loudnessSamples.AddLast(loudness);

		// detect rising edge, falling edge.
		if (Math.Abs (delta) >= significantChange) {
			if (loudness > previous) {
				if (loudnessChangeDirection <= 0) {
					// was falling/static, now rising
					Debug.Log ("Rising loudness: previous " + previous + ", current: " + loudness);
					loudnessChangeDirection = 1;
				}
			}
			else if (loudness < previous) {
				if (loudnessChangeDirection <= 0) {
					Debug.Log("Falling loudness: previous " + previous + ", current: " + loudness);
					loudnessChangeDirection = -1;
				}
			}
			// a peak is a falling edge after a rising edge
			if (previousDirection != loudnessChangeDirection) {
				if (edgeStartLoudness > 0 && loudnessChangeDirection == -1
				) {
					Debug.Log("peak!");
					// a peak, but is it big enough to be a clap?
					if (loudness - edgeStartLoudness > clapThreshold) {
						detectedClap = true;
					}
				}
				edgeStartLoudness = loudness;
			}
		}

		// Broadcast to delegates
		if (detectedClap && OnMicClapEvent != null)
		{
			OnMicClapEvent();
		}
	}
}
