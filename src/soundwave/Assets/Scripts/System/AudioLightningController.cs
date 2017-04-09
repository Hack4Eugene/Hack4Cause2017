using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class AudioLightningController : MonoBehaviour {

	public GameObject audioLightningPrefab;
	public int nodeCount;
	public Transform endLocation;

	private float moveDuration;
	private float moveTimer;
	private LineRenderer lineRenderer;
	private Vector3[] nodes;

	public void Activate (float duration)
	{
		moveDuration = duration;
		moveTimer = 0;
		this.enabled = true;
	}

	public void Deactivate ()
	{
		this.enabled = false;
		lineRenderer.enabled = false;
	}

	private void Awake ()
	{
		Vector3 begin = transform.position;
		Vector3 end = endLocation.position;
		Vector3 direction = (end - begin).normalized;
		Vector3 crossVector = Quaternion.Euler(0, 0, 90) * (begin - end);

		float nodeDistance = Vector3.Distance(begin, end) / (float) nodeCount;

		lineRenderer = GetComponent<LineRenderer>();
		lineRenderer.positionCount = nodeCount + 1;
		nodes = new Vector3[nodeCount + 1];

		lineRenderer.SetPosition(0, begin);
		lineRenderer.SetPosition(nodeCount, end);
		int angleDirection = 1;
		for (int i = 0; i < nodeCount; i++)
		{
			nodes[i] = begin + direction * nodeDistance * i;
			if (i != 0)// && i != nodeCount - 1)
				nodes[i] += crossVector * Random.Range(0, .1f) * angleDirection;
			angleDirection *= -1;
		}
		nodes[nodes.Length - 1] = end;

		Deactivate();
	}

	private void Update ()
	{
		lineRenderer.enabled = true;
	
		moveTimer += Time.deltaTime * Time.timeScale;
		float t = Mathf.Clamp01(moveTimer / moveDuration);
		int finalNode = (int) (t * nodeCount) + 1;
		if (t == 1) finalNode = nodeCount;
		lineRenderer.positionCount = finalNode + 1;

		// this will take the lightning to nodes we've already passed
		for (int i = 0; i < lineRenderer.positionCount; i++)
		{
			lineRenderer.SetPosition(i, nodes[i]);
		}

		// this will walk the lightning to the next node
		if (t < 1)
		{
			float deltaPct = 1f / (float) nodeCount;
			float localPct = t - (deltaPct * (finalNode - 1));
			float normalizedDistanceToNextNode = Mathf.Clamp01(localPct / deltaPct);
			Vector3 nodeBegin = nodes[finalNode - 1];
			Vector3 nodeEnd = nodes[finalNode];
			Vector3 nodeDelta = nodeEnd - nodeBegin;
			lineRenderer.SetPosition(finalNode, nodeBegin + nodeDelta * normalizedDistanceToNextNode);
		}
		else // we're done
		{
			this.enabled = false;
		}
	}
}
