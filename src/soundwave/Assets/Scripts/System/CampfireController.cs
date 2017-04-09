using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CampfireController : MonoBehaviour {

	public static CampfireController instance;

	public Gradient fireGradient;
	public Gradient flashGradient;
	public Gradient highFireGradient;

	public ParticleSystem fireParticles;
	public Transform fireFlash;

	[System.Serializable]
	public class FireData 
	{
		public float minLifetime;
		public float maxLifetime;
		public float minSizeLow;
		public float maxSizeLow;
		public float minSizeHigh;
		public float maxSizeHigh;
		public float minSpeed;
		public float maxSpeed;

		public void SetNormalizedStrength (ParticleSystem particles, float value)
		{
			ParticleSystem.MainModule main = particles.main;

			float deltaLifetime = maxLifetime - minLifetime;
			main.startLifetime = minLifetime + deltaLifetime * value;

			float deltaMaxSize = maxSizeHigh - maxSizeLow;
			float maxCurve = maxSizeLow + deltaMaxSize * value;
			float deltaMinSize = minSizeHigh - minSizeLow;
			float minCurve = minSizeLow + deltaMinSize * value;
			main.startSize = new ParticleSystem.MinMaxCurve(minCurve, maxCurve); 

			float deltaSpeed = maxSpeed - minSpeed;
			main.startSpeed = minSpeed + deltaSpeed * value;
		}
	}

	bool isHighFire;
	public FireData lowFire;
	public FireData highFire;

	private ParticleSystem.EmissionModule fireEmitter;

	private FireData activeFireData;

	public void SetFireIsActive (bool isActive)
	{
		fireEmitter.enabled = isActive;
		SetFireIsLow(true);
	}

	public void SetColorValue (float value)
	{
		ParticleSystem.MainModule main = fireParticles.main;
		if (isHighFire)
			main.startColor = highFireGradient.Evaluate(value);
		else
			main.startColor = fireGradient.Evaluate(value);
	}

	public void SetStrength (float value)
	{
		activeFireData.SetNormalizedStrength(fireParticles, value);
	}

	public void SetFireIsLow (bool isLow)
	{
		isHighFire = !isLow;
		if (isLow)
		{
			activeFireData = lowFire;
			//lowFire.SetNormalizedStrength(fireParticles, 0);
		}
		else
		{
			activeFireData = highFire;
			//highFire.SetNormalizedStrength(fireParticles, 0);
		}
		SetStrength(0);
	}

	void Awake ()
	{
		instance = this;
		fireEmitter = fireParticles.emission;
		fireEmitter.enabled = false;
		fireFlash.gameObject.SetActive(false);
		SetFireIsLow(true);
	}
}
