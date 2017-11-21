'use strict';

let form = document.querySelector('.account');

try 
{
    let ajaxAdapter = AjaxFormSubmitterFactory.build(form);
    ajaxAdapter.registerSubmitHandler(form);
}
catch (e)
{
    console.error(e); //comment later
}

