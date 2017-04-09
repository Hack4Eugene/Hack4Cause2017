using UnityEngine;
using System.Collections;

public class ScreenFader : MonoBehaviour
{
    public static ScreenFader instance;
	public float fadeTime = 2.0f;

	public Color fadeColor = new Color(0.01f, 0.01f, 0.01f, 1.0f);

	public void Clear ()
	{
		StopAllCoroutines();
		isFading = false;
		hasFadedOut = false;
	}

	public void FadeInFromColor (Color color, float duration)
	{
		fadeColor = color;
		Fade(duration, true);
	}

	public void FadeOutToColor(Color color, float duration)
	{
		fadeColor = color;
		Fade(duration, false);
	}

	public void Fade (float fadeTime, bool isFadingIn = true)
    {
        StopAllCoroutines();
        this.fadeTime = fadeTime;
		isFading = true;
        if (isFadingIn)
        {
            StartCoroutine(FadeIn());
        }
        else
        {
            StartCoroutine(FadeOut());
        }
    }

	public Material fadeMaterial = null;
	public bool isFading = false;
	private bool hasFadedOut;
	private YieldInstruction fadeInstruction = new WaitForEndOfFrame();

	/// <summary>
	/// Initialize.
	/// </summary>
	void Awake()
	{
        instance = this;
		// create the fade material
		fadeMaterial = new Material(Shader.Find("Unlit/UnlitAlpha"));
	}

	/// <summary>
	/// Cleans up the fade material
	/// </summary>
	void OnDestroy()
	{
		if (fadeMaterial != null)
		{
			Destroy(fadeMaterial);
		}
	}

	/// <summary>
	/// Fades alpha from 1.0 to 0.0
	/// </summary>
	IEnumerator FadeIn()
	{
		if (fadeTime <= 0)
		{
			Color newColor = Color.white;
			newColor.a = 0;
			isFading = false;
			fadeMaterial.color = newColor;
			hasFadedOut = false;
			yield return null;
		}
		else
		{
			float elapsedTime = 0.0f;
			Color color = fadeColor;
	        color.a = 1;
	        fadeMaterial.color = color;
	        isFading = true;
			hasFadedOut = false;
			while (elapsedTime < fadeTime)
			{
				yield return fadeInstruction;
				elapsedTime += Time.deltaTime;
				color.a = 1.0f - Mathf.Clamp01(elapsedTime / fadeTime);
				fadeMaterial.color = color;
			}
			isFading = false;
		}
	}

    IEnumerator FadeOut()
    {
		if (fadeTime <= 0)
		{
			isFading = false;
			fadeMaterial.color = fadeColor;
			hasFadedOut = true;
			yield return null;
		}
		else
		{
	        float elapsedTime = 0.0f;
	        Color color = fadeColor;
	        color.a = 0;
	        fadeMaterial.color = color;
	        isFading = true;
			hasFadedOut = false;
			while (elapsedTime < fadeTime)
	        {
	            yield return fadeInstruction;
	            elapsedTime += Time.deltaTime;
	            color.a = Mathf.Clamp01(elapsedTime / fadeTime);
	            fadeMaterial.color = color;
	        }
			hasFadedOut = true;
			isFading = false;
		}
    }

    /// <summary>
    /// Renders the fade overlay when attached to a camera object
    /// </summary>
    void OnPostRender()
	{
		if (isFading || hasFadedOut)
		{
			fadeMaterial.SetPass(0);
			GL.PushMatrix();
			GL.LoadOrtho();
			GL.Color(fadeMaterial.color);
			GL.Begin(GL.QUADS);
			GL.Vertex3(0f, 0f, -12f);
			GL.Vertex3(0f, 1f, -12f);
			GL.Vertex3(1f, 1f, -12f);
			GL.Vertex3(1f, 0f, -12f);
			GL.End();
			GL.PopMatrix();
		}
	}
}
