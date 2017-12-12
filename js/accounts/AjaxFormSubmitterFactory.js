'use strict';

class AjaxFormSubmitterFactory
{
	static build(form)
	{
		let formID = form.id;
		switch(formID)
	    {
	        case "login":
				return AjaxFormSubmitterFactory.buildLoginAdapter(form);
			case "register":
				return AjaxFormSubmitterFactory.buildRegisterAdapter(form);
			case "edit_account":
				return AjaxFormSubmitterFactory.buildEditInfoAdapter(form);
	        default:
	            throw new Error("No builder for form " + formID);
	    }
	}

	/*****************************************************************/
    /**********    'private' methods                   ***************/
    /*****************************************************************/

	static buildLoginAdapter(form)
	{
		let loginError = form.querySelector('#login_error');

		let loginErrorMap = 
		{
		    "login_error" : DOMLib.getBindShowError(loginError)
		};

		
        let inputUsername = form.querySelector('input[name="username"]');
        let inputPassword = form.querySelector('input[name="password"]');
		
        AjaxFormSubmitterFactory.addHideErrorHandler(inputUsername, loginError);
        AjaxFormSubmitterFactory.addHideErrorHandler(inputPassword, loginError);
		
		
		let ajaxActionPath = "PHP/actions/accounts/ajax_login.php";
		let adapter = new AjaxFormSubmitAdapter(ajaxActionPath, loginErrorMap, AjaxLib.redirectTo.bind(null, "index.php"));
		return adapter;
	}

	static buildRegisterAdapter(form)
	{
		let usernameError = form.querySelector('#username_already_exists_error');
		let emailError = form.querySelector('#email_already_exists_error');
		let passwordMatchError = form.querySelector('#password_match_error');
		
		let registerErrorMap = 
		{
			"username_exists_error" : DOMLib.getBindShowError(usernameError),
			"email_exists_error" : DOMLib.getBindShowError(emailError),
			"password_match_error" : DOMLib.getBindShowError(passwordMatchError),
		};
		
		let inputUsername = form.querySelector('input[name="username"]');
        let inputEmail = form.querySelector('input[name="email"]');
        let inputPassword = form.querySelector('input[name="password"]');
        let inputConfirmPassword = form.querySelector('input[name="confirm_password"]');
		let submitButton = form.querySelector('input[type="submit"]');

		AjaxFormSubmitterFactory.addHideErrorHandler(inputUsername, usernameError);
		AjaxFormSubmitterFactory.addHideErrorHandler(inputEmail, emailError);
		AjaxFormSubmitterFactory.disableSubmitOnUnmatchingPassword(inputPassword, inputConfirmPassword, passwordMatchError, submitButton);

		let ajaxActionPath = "PHP/actions/accounts/ajax_register.php";

		let adapter = new CaptchaFormAdapter(ajaxActionPath, registerErrorMap, AjaxLib.redirectTo.bind(null, "index.php"));
		return adapter;
	}

	static buildEditInfoAdapter(form)
	{
		let emailError = form.querySelector('#email_already_exists_error2');
		let passwordMatchError = form.querySelector('#password_match_error2');
		let wrongPasswordError = form.querySelector('#wrong_password_error');
		let editSuccess = form.querySelector('#successfuly_edited_account_message');
		
		let registerErrorMap = 
		{
			"email_exists_error" : DOMLib.getBindShowError(emailError),
			"wrong_password_error" : DOMLib.getBindShowError(wrongPasswordError),
			"password_match_error" : DOMLib.getBindShowError(passwordMatchError),
		};
		let showMsgFun = DOMLib.getBindTimedShowSuccess(editSuccess);

		
		let inputEmail = form.querySelector('input[name="email"]');
        let inputOldPassword = form.querySelector('input[name="old_password"]');		
        let inputNewPassword = form.querySelector('input[name="new_password"]');
		let inputConfirmNewPassword = form.querySelector('input[name="confirm_new_password"]');
		let submitButton = form.querySelector('input[type="submit"]');

		AjaxFormSubmitterFactory.addHideErrorHandler(inputEmail, emailError);
		AjaxFormSubmitterFactory.addHideErrorHandler(inputOldPassword, wrongPasswordError);		
		AjaxFormSubmitterFactory.disableSubmitOnUnmatchingPassword(inputNewPassword, inputConfirmNewPassword, passwordMatchError, submitButton);

		let ajaxActionPath = "PHP/actions/accounts/ajax_edit_account.php";
		let adapter = new CaptchaFormAdapter(ajaxActionPath, registerErrorMap, showMsgFun);
		return adapter;
	}

	static addHideErrorHandler(input, error)
    {
        let handler = DOMLib.getBindHideError(error);

        input.addEventListener("change", handler);
	}
	
	static disableSubmitOnUnmatchingPassword(passInput, confirmPassInput, matchError, submitButton)
	{
		let showError = DOMLib.getBindShowError(matchError);
		let hideError = DOMLib.getBindHideError(matchError);

		let passMatchChecker = function (event) {
			const pass = passInput.value;
			const confirmPass = confirmPassInput.value;
			const isError = confirmPass != "" && pass != "" && pass !== confirmPass;

			if(isError)
			{
				submitButton.disabled = true;
				showError();
			}
			else 
			{
				submitButton.disabled = false;
				hideError();
			}
		}
			
		passInput.addEventListener("change", passMatchChecker);
		confirmPassInput.addEventListener("change", passMatchChecker);

	}

	static showSuccessMessage(msgElem)
	{

	}
}