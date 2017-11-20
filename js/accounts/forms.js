'use strict';


let form = getAccountsForm();
form.addEventListener('submit', sendLoginFormJSON);

function getAccountsForm()
{
    return document.querySelector('.account');
}

function sendLoginFormJSON(event)
{
    const ajaxLoginPHPPath = "PHP/actions/accounts/ajax_login.php";

    event.preventDefault();

    let inputsMap = AjaxLib.getFormInputMap(this);
    const ajaxLoginURI = AjaxLib.joinPathToFormURI(ajaxLoginPHPPath, inputsMap);
    
    let request = new XMLHttpRequest();
    request.addEventListener('load', loginOnLoad);
    request.open("get", ajaxLoginURI, true);
    request.send();
}

function loginOnLoad()
{
    let error = JSON.parse(this.responseText);
    if(error == 0)
        AjaxLib.goBack();
    else
        alert("error " + error);
}