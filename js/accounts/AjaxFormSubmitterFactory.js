
class AjaxFormSubmitterFactory
{
	static build(form)
	{
		let formID = form.id;
		switch(formID)
	    {
	        case "login":
	            return AjaxFormSubmitterFactory.buildLoginAdapter(form);
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
		    "login_error" : DOMLib.changeClass.bind(DOMLib, loginError, "error_message_invisible", "error_message")
		};

		let ajaxActionPath = "PHP/actions/accounts/ajax_login.php";


		let adapter = new AjaxFormSubmitAdapter(ajaxActionPath, loginErrorMap, AjaxLib.redirectTo.bind(null, "index.php"));
		return adapter;
	}
}