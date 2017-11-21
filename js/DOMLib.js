'use strict';

let DOMLib = {}; //namespace



DOMLib.VALID_FORM_INPUT_TYPES = ['text', 'password', 'email']; //add more here
/**
 * Return the name => value pairs for each valid input in form
 */
DOMLib.getFormInputMap = function (formElem)
{
    let inputMap = {};
    let inputs = formElem.getElementsByTagName('input');
    let inputsList = [...inputs];

    let validInputs = inputsList.filter(
        (input) => DOMLib.VALID_FORM_INPUT_TYPES.includes(input.type)
    );

    validInputs.forEach(
        (validInput) => inputMap[validInput.name] = validInput.value
    );

    return inputMap;
}

DOMLib.changeClass = function (elem, oldClass, newClass)
{
    elem.classList.remove(oldClass);
    elem.classList.add(newClass);
}

