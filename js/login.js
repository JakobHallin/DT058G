
// Create eventlistener for 'formid' submit to check for empty fields
document.getElementById("formid").addEventListener("submit", (e) => {
	if(document.getElementById("user").value == "" || document.getElementById("pass").value == ""){
		e.preventDefault();
		return false;
	}
	return true;
}) 
