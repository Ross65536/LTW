'use strict';

let DOMLib = {}; //namespace


/**
 * Return the name => value pairs for each valid input in form
 */
DOMLib.getFormInputMap = function (formElem)
{
    let inputMap = {};
    let inputs = formElem.getElementsByTagName('input');
    let inputsList = [...inputs];

    inputsList.forEach(
        (validInput) => inputMap[validInput.name] = validInput.value
    );

    return inputMap;
}

DOMLib.changeClass = function (elem, oldClass, newClass)
{
    if(elem.classList.contains(oldClass))
        elem.classList.replace(oldClass, newClass);
    
}

DOMLib.getBindShowError = (elem) => DOMLib.changeClass.bind(DOMLib, elem, "error_message_invisible", "error_message");

DOMLib.getBindHideError = (elem) => DOMLib.changeClass.bind(DOMLib, elem, "error_message", "error_message_invisible");

DOMLib.getBindTimedShowSuccess = function (elem, timeout = 2000) 
{
    let timedoutFun = function()
    {
        DOMLib.changeClass(elem, "success_message_invisible", "success_message");
        window.setTimeout(() => DOMLib.changeClass(elem, "success_message", "success_message_invisible"), timeout);
    }

    return timedoutFun;
};
