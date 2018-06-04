submit = option => {
	const selectedForm = (option === 2) ? document.querySelector("#signupForm")
	 : document.querySelector("#loginForm")
	 selectedForm.submit()
}
/* 
equivalent to

function submit(option){
	if(option === 2) const selectedForm = document.querySelector("#signupForm")
	else const selectedForm =   document.querySelector("#loginForm")
	selectedForm.submit()	
}

*/