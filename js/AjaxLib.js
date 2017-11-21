'use strict';

let AjaxLib = {}; //namespace

//dos slides do prof (function encodeForAjax)
AjaxLib.flattenMapToGetURI = function(dataMap) 
{
    let pairsArr = Object.keys(dataMap).map(
        (key) => encodeURIComponent(key) + '=' + encodeURIComponent(dataMap[key])
    );

    return pairsArr.join('&');
}

AjaxLib.buildGetURI = function(actionPath, inputsValueMap)
{
    let inputPairString = AjaxLib.flattenMapToGetURI(inputsValueMap);
    return `${actionPath}?${inputPairString}`;
}

AjaxLib.displayErrorAlert = function(msg)
{
    alert("Error: " + msg);
}

AjaxLib.redirectBack = () => history.back();

AjaxLib.redirectTo = (URLPath) => window.location.replace(URLPath);