'use strict';

let AjaxLib = {}; //namespace

AjaxLib.VALID_FORM_INPUT_TYPES = ['text', 'password', 'email']; //add more here

AjaxLib.getFormInputMap = function(formElem)
{
    let inputMap = {};
    let inputs = formElem.getElementsByTagName('input');
    let inputsList = [...inputs];

    let validInputs = inputsList.filter(
        (input) => AjaxLib.VALID_FORM_INPUT_TYPES.includes(input.type)
    );

    validInputs.forEach(
        (validInput) => inputMap[validInput.name] = validInput.value
    );

    return inputMap;
}

//dos slides do prof (function encodeForAjax)
AjaxLib.flattenFormMapToURI = function(dataMap) 
{
    let pairsArr = Object.keys(dataMap).map(
        (key) => encodeURIComponent(key) + '=' + encodeURIComponent(dataMap[key])
    );

    return pairsArr.join('&');
}

AjaxLib.joinPathToFormURI = function(filePath, inputsValueMap)
{
    let inputPairString = AjaxLib.flattenFormMapToURI(inputsValueMap);
    return `${filePath}?${inputPairString}`;
}

AjaxLib.goBack = () => history.back();