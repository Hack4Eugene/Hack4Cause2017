using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class MicVisualizerOLD : MonoBehaviour {

	public float heightScalar = 1;

	float maxHeight;
	private LineRenderer lineRenderer;
    Vector3 beginPosition;
    Vector3 deltaPosition;
    Vector3 endPosition;

	void Start () 
	{
		lineRenderer = GetComponent<LineRenderer>();
		MeshRenderer r = GetComponent<MeshRenderer>();
        Bounds b = r.bounds;

        maxHeight = b.extents.y;
        beginPosition = transform.position - transform.right * b.extents.x;
        beginPosition -= transform.up * maxHeight;
        endPosition = transform.position + transform.right * b.extents.x;
        endPosition -= transform.up * maxHeight;
        deltaPosition = endPosition - beginPosition;

        r.enabled = false;
        if (heightScalar <= 0) heightScalar = 1;

		MicMonitor.Instance.processNewMicrophoneFFT += RenderBuffer;

	}

	void RenderBuffer (float[] buffer)
	{
		Debug.Log(buffer.Length);
		lineRenderer.SetVertexCount(buffer.Length);

        for (int i = 0; i < buffer.Length; i++)
        {
            float pct = (float)i / buffer.Length;
            float h = buffer[i] * maxHeight * heightScalar;
			lineRenderer.SetPosition(i, beginPosition + deltaPosition * pct + Vector3.up * h);
        }
	}
}
