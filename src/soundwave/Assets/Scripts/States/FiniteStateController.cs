using UnityEngine;

/// <summary>
/// FiniteStateController is a generic handler for FiniteState classes.
/// SETUP
/// - Create its FiniteStates and add them to finiteStates in the inspector
/// USE
/// - FiniteStateController does nothing when instantiated... it simply disables itself.
/// - When appropriate, call Initialize to initialize all finite states associated with this controller
/// - Call Launch to start the controller and enter the first state
/// - Call Shutdown to exit the current state and disable itself
/// </summary>
public class FiniteStateController : MonoBehaviour
{
    /// <summary>
    /// Drag references to all necessary finite states to this entry in the inspector.
    /// </summary>
    [Tooltip("The controller runs these states in this order")]
    public FiniteState[] finiteStates;

    public TextMesh debugTextMesh;

    // GameState can use this to determine if the controller has completed, and the game is ready to move on
    public bool isRunning
    {
        get
        {
            return this.enabled;
        }
    }

    public string __stateName;

    FiniteState currentFiniteState;
    int currentFiniteStateId;

    /// <summary>
    /// Simply proceeds to the next FiniteState in finiteStates.
    /// Skips null states.
    /// If there are no more states, the controller shuts down.
    /// </summary>
    public void GoToNextState()
    {
        currentFiniteStateId += 1;
        
        if (currentFiniteStateId >= finiteStates.Length)
        {
            Shutdown();
            return;
        }

        if (finiteStates[currentFiniteStateId] == null)
        {
            GoToNextState();
        }
        else
        {
            GoToState(finiteStates[currentFiniteStateId]);
        }
    }

    /// <summary>
    /// 1. Exits the current finite state (if applicable)
    /// 2. Enters the new finite state
    /// </summary>
    /// <param name="newState"></param>
    public void GoToState (FiniteState newState)
    {
        // Exit the current state if necessary
        if (currentFiniteState != null)
        {
            currentFiniteState.Exit();
        }

        // Enter the next state
        if (newState != null)
        {
            currentFiniteState = newState;
            currentFiniteState.Enter();
            __stateName = currentFiniteState.GetType().ToString();
			if (debugTextMesh != null) debugTextMesh.text = __stateName;
        }
    }

    // This can be called by FiniteStates as well as GameStates
    public void Shutdown()
    {
        if (currentFiniteState != null)
        {
            currentFiniteState.Exit();
        }
        this.enabled = false;
    }

    public void Start ()
    {
		for (int i = 0; i < finiteStates.Length; i++)
        {
            if (finiteStates[i] != null)
            {
                finiteStates[i].Initialize(this);
            }
        }

		GoToState(finiteStates[0]);
        this.enabled = true;
    }

	public void Update()
	{
        if (Input.GetKeyDown(KeyCode.Equals)) GoToNextState();

        if (currentFiniteState != null)
        {
            currentFiniteState.Process();
        }
	}
}