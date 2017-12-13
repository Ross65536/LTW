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
		let captchaError = form.querySelector('#captcha_error');

		let loginErrorMap = 
		{
			"login_error" : DOMLib.getBindShowError(loginError),
			"wrong_captcha": DOMLib.getBindTimedShowError(captchaError, 5000),
		};

		
        let inputUsername = form.querySelector('#username_input');
        let inputPassword = form.querySelector('#password_input');
		
        AjaxFormSubmitterFactory.addHideErrorHandler(inputUsername, loginError);
        AjaxFormSubmitterFactory.addHideErrorHandler(inputPassword, loginError);
		AjaxFormSubmitterFactory.addSmartCaptcha(loginErrorMap);
		
		let ajaxActionPath = "PHP/actions/accounts/ajax_login.php";
		let adapter = new CaptchaFormAdapter(ajaxActionPath, loginErrorMap, AjaxLib.redirectTo.bind(null, "index.php"));
		return adapter;
	}

	static buildRegisterAdapter(form)
	{
		let usernameError = form.querySelector('#username_already_exists_error');
		let emailError = form.querySelector('#email_already_exists_error');
		let passwordMatchError = form.querySelector('#password_match_error');
		let captchaError = form.querySelector('#captcha_error');
		let emailExistenceError = form.querySelector('#email_doesnt_exist_error');
		
		let registerErrorMap = 
		{
			"username_exists_error" : DOMLib.getBindShowError(usernameError),
			"email_exists_error" : DOMLib.getBindShowError(emailError),
			"email_doesnt_exist" : DOMLib.getBindShowError(emailExistenceError),
			"password_match_error" : DOMLib.getBindShowError(passwordMatchError),
			"wrong_captcha": DOMLib.getBindTimedShowError(captchaError),
		};
		
		let inputUsername = form.querySelector('#username_input');
        let inputEmail = form.querySelector('#email_input');
        let inputPassword = form.querySelector('#password_input');
        let inputConfirmPassword = form.querySelector('#confirm_password_input');
		let submitButton = form.querySelector('#submit_button_id');

		AjaxFormSubmitterFactory.addHideErrorHandler(inputUsername, usernameError);
		AjaxFormSubmitterFactory.addHideErrorHandler(inputEmail, emailError);
		AjaxFormSubmitterFactory.addHideErrorHandler(inputEmail, emailExistenceError);
		AjaxFormSubmitterFactory.disableSubmitOnUnmatchingPassword(inputPassword, inputConfirmPassword, passwordMatchError, submitButton);
		AjaxFormSubmitterFactory.addSmartCaptcha(registerErrorMap);
		
		let ajaxActionPath = "PHP/actions/accounts/ajax_register.php";
		let adapter = new CaptchaFormAdapter(ajaxActionPath, registerErrorMap, AjaxLib.redirectTo.bind(null, "index.php"));
		return adapter;
	}

	static addSmartCaptcha(handlerMap)
	{
		let captcha = form.querySelector('#google_recaptcha');
		handlerMap["should_display_captcha"] = DOMLib.getBindShowCaptcha(captcha);
	}

	static buildEditInfoAdapter(form)
	{
		let emailError = form.querySelector('#email_already_exists_error2');
		let passwordMatchError = form.querySelector('#password_match_error2');
		let wrongPasswordError = form.querySelector('#wrong_password_error');
		let editSuccess = form.querySelector('#successfuly_edited_account_message');
		let captchaError = form.querySelector('#captcha_error');
		let emailExistenceError = form.querySelector('#email_doesnt_exist_error');
		
		
		let editInfoErrorMap = 
		{
			"email_exists_error" : DOMLib.getBindShowError(emailError),
			"email_doesnt_exist" : DOMLib.getBindShowError(emailExistenceError),
			"wrong_password_error" : DOMLib.getBindShowError(wrongPasswordError),
			"password_match_error" : DOMLib.getBindShowError(passwordMatchError),
			"wrong_captcha": DOMLib.getBindTimedShowError(captchaError),
			
		};
		let showMsgFun = () => {
			DOMLib.getBindTimedShowSuccess(editSuccess)();//call immediatly
			let captcha = form.querySelector('#google_recaptcha');
			DOMLib.getBindHideCaptcha(captcha)();
		}
		
		let inputEmail = form.querySelector('#email_input');
        let inputOldPassword = form.querySelector('#old_password_input');		
        let inputNewPassword = form.querySelector('#new_password_input');
		let inputConfirmNewPassword = form.querySelector('#confirm_new_password_input');
		let submitButton = form.querySelector('#submit_button_id');

		AjaxFormSubmitterFactory.addHideErrorHandler(inputEmail, emailError);
		AjaxFormSubmitterFactory.addHideErrorHandler(inputOldPassword, wrongPasswordError);	
		AjaxFormSubmitterFactory.addHideErrorHandler(inputEmail, emailExistenceError);
		AjaxFormSubmitterFactory.disableSubmitOnUnmatchingPassword(inputNewPassword, inputConfirmNewPassword, passwordMatchError, submitButton);
		AjaxFormSubmitterFactory.addSmartCaptcha(editInfoErrorMap);

		let ajaxActionPath = "PHP/actions/accounts/ajax_edit_account.php";

		let adapter = new CaptchaFormAdapter(ajaxActionPath, editInfoErrorMap, showMsgFun);
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