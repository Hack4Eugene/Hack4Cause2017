using UnityEngine;

public abstract class FiniteState : MonoBehaviour
{
	public bool skipThisState;

    protected FiniteStateController finiteStateController;

    public void Initialize(FiniteStateController finiteStateController)
    {
        this.finiteStateController = finiteStateController;
        this.enabled = false;
        OnInitialize();
    }

    public void Enter()
    {
    	if (skipThisState)
    	{
    		finiteStateController.GoToNextState();
    		return;
    	}
        this.enabled = true;
        OnEnter();
    }

    public void Process()
    {
        OnProcess();
    }

    public void Exit()
    {
        this.enabled = false;
        OnExit();
    }

    protected virtual void OnInitialize() {}
	protected virtual void OnEnter() {}
	protected virtual void OnProcess() {}
	protected virtual void OnExit() {}

}
