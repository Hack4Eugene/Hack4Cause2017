using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class RainAudio : MonoBehaviour {

	public static RainAudio instance;

	public AudioSource highRain;
	public AudioSource lowRain;

	float maxLowRainVolume = 0.7f;

	public void SetLowRainVolume (float volume)
	{
		lowRain.volume = volume * maxLowRainVolume;
	}

	public void SetHighRainVolume (float volume)
	{
		highRain.volume = volume;
	}

	public void SetHighRainPitch (float pitch)
	{
		highRain.pitch = pitch;
	}

	void Awake ()
	{
		instance = this;
		lowRain.Play();
		lowRain.loop = true;
		lowRain.volume = 0;
		highRain.Play();
		highRain.loop = true;
		highRain.volume = 0;
	}


}
