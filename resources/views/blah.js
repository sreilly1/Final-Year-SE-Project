// if the user has provided an invalid range then they are informed with a JavaScript alert with this
// and the forms default action is prevented, i.e. the form is not submitted as there is no need to process
// the HTTP request on the server side if it is known to be invalid on the client side

function checkDateRangeValidity (fromDate, toDate) {
	if (new Date(fromDate).getTime() > new Date(toDate).getTime() ) {
		alert("the date range entered is invalid, please make sure the 'from' date is earlier than the 'to' date");
		e.preventDefault();
		//returning false will stop execution of the JavaScript function so that the user will not
		//continually get JavaScript alerts till they tell the browser that they do not want 
		//additional dialogue boxes
		return false;
	}

}