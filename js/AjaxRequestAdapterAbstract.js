'use strict';

class AjaxRequestAdapterAbstract
{
    constructor()
    { }

    sendRequest(ajaxActionURI)
    {
        let request = new XMLHttpRequest();

        request.addEventListener('load', this.onLoadHandler.bind(this));

        request.open("get", ajaxActionURI, true);
        request.send();
    }

    /************************************************************************/
    /*************    MANDATORY template methods          *******************/
    /************************************************************************/

    handleJSONResponseTemplate(JSONResponse)
    {
        throw new Error("calling abstract method");
    }

    /************************************************************************/
    /*************    OPTIONAL overrideable methods       *******************/
    /************************************************************************/



    /************************************************************************/
    /*************    'private' methods                   *******************/
    /************************************************************************/

    onLoadHandler(event)
    {
        let JSONResponseText = event.currentTarget.responseText;
        console.log(JSONResponseText);

        let JSONResponseObject = JSON.parse(JSONResponseText);
        this.handleJSONResponseTemplate(JSONResponseObject);
    }

}
