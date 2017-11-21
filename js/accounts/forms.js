'use strict';

let form = document.querySelector('.account');

let error = form.querySelector('.error_message_invisible');

let loginErrorMap = 
{
    "login_error" : DOMLib.changeClass.bind(DOMLib, error, "error_message_invisible", "error_message")
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

attachFormSubmitHandler(form);