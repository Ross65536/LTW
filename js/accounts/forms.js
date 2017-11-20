'use strict';

let loginErrorMap = 
{
    "login_error" : AjaxLib.displayErrorAlert.bind(null, "Username or login error")
};


function attachFormSubmitHandler(form)
{
    let ajaxActionPath, errorHandlerMap;

    switch(form.id)
    {
        case "login":
            ajaxActionPath = "PHP/actions/accounts/ajax_login.php";
            errorHandlerMap = loginErrorMap;
            break;
        default:
            return;
    }

    let ajaxAdapter = new AjaxFormSubmitAdapter(ajaxActionPath, errorHandlerMap);
    ajaxAdapter.registerSubmitHandler(form);
}

let form = document.querySelector('.account');
attachFormSubmitHandler(form);