'use strict';

class AjaxFormSubmitAdapter extends AjaxRequestAdapterAbstract
{
    /**
     * If received error not in map, an alert is displayed
     * 
     * @param {*} actionPath path to php action
     * @param {*} eventHandlerMap a map that maps an eror string returned from php to a function(void)
     * @param {*} noErrorsHandler function called when no errors are received
     */
    constructor(actionPath, eventHandlerMap, noErrorsHandler = AjaxLib.redirectBack)
    {
        super();

        if(actionPath == null)
            throw Error("Invalid action filepath");

        this.noErrorsHandler = noErrorsHandler;
        this.eventHandlerMap = eventHandlerMap;
        this.actionPath = actionPath;        
    }

    registerSubmitHandler(form)
    {
        let sendHandler = this.sendRequestHandler.bind(this);
        form.addEventListener('submit', sendHandler);
    }


    /************************************************************************/
    /*************    'private' template methods          *******************/
    /************************************************************************/

    handleJSONResponseTemplate(responseErrorList)
    {
        if(responseErrorList.length === 0)
            this.noErrorsHandler();
        else
        {
            for(let i=0; i < responseErrorList.length; i++)
            {
                let error = responseErrorList[i];

                if(error in this.eventHandlerMap)
                    this.eventHandlerMap[error]();
                else
                    AjaxLib.displayErrorAlert(error);
            }
        }
    }

    /************************************************************************/
    /*************    'private' methods                   *******************/
    /************************************************************************/

    sendRequestHandler(event)
    {
        event.preventDefault();

        const ajaxActionURI = this.buildActionURI(event);
        super.sendRequest(ajaxActionURI);
    }

    
    buildActionURI(event)
    {
        let form = event.currentTarget;        
        let inputsMap = DOMLib.getFormInputMap(form);
        return AjaxLib.buildGetURI(this.actionPath, inputsMap);
    }

}