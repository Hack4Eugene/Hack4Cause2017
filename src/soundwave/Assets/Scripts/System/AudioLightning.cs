using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class AudioLightning : MonoBehaviour {

	public float scalar = 1;

	private LineRenderer lineRenderer;
	private MicMonitor micMonitor;
	private Vector3 beginPosition;
	private Vector3 deltaPosition;
	private Vector3 crossVector;

	public void Initialize (MicMonitor micMonitor, Vector3 beginPosition, Vector3 endPosition, float scalar = 1, float lineWidth = 0.1f)
	{
		this.micMonitor = micMonitor;
		micMonitor.processNewMicrophoneBuffer += RenderLightning;

		this.beginPosition = beginPosition;
		deltaPosition = endPosition - beginPosition;

		Vector3 between = beginPosition - endPosition;
		crossVector = Quaternion.Euler(0, 0, 90) * between;

		lineRenderer.startWidth = lineWidth;
		lineRenderer.endWidth = lineWidth;
	}

	private void Awake ()
	{
		lineRenderer = GetComponent<LineRenderer>();
	}

	private void RenderLightning (float[] buffer)
	{
		lineRenderer.SetVertexCount(buffer.Length);

        for (int i = 0; i < buffer.Length; i++)
        {
            float pct = (float)i / buffer.Length;
            float h = buffer[i] * scalar;
			lineRenderer.SetPosition(i, beginPosition + deltaPosition * pct + crossVector * h);
        }
	}

	private void OnDisable ()
	{
		micMonitor.processNewMicrophoneBuffer -= RenderLightning;
	}
}
