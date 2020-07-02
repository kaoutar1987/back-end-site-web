const firstNameDiv = document.querySelector('#fname');
const lastNameDiv = document.querySelector('#lname');
const emailDiv = document.querySelector('#email');
const passwordDiv = document.querySelector('#password');
const passwordConfirmDiv = document.querySelector('#password-confirm');
const error = document.querySelector('#add_err2');
const submit = document.querySelector('#register');

submit.addEventListener('click', validation);

function validateEmail(email) {
	const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email))
}

function validation(e) {
	let firstName = firstNameDiv.value;
	let lastName = lastNameDiv.value;
	let email = emailDiv.value;
	let password = passwordDiv.value;
	let passwordConfirm = passwordConfirmDiv.value;

	let numbers = /[0-9]/g;
	let special = /[!@#$%^&*]/g;

	e.preventDefault();

	if (firstName == '') {
		error.innerHTML = `<div class="alert alert-danger">please enter your first name</div>`;
		return;
	} else if (lastName == '') {
		error.innerHTML = `<div class="alert alert-danger">please enter your last name</div>`;
		return;
	} else if (email == '') {
		error.innerHTML = `<div class="alert alert-danger">please enter your email</div>`;
		return;
	} else if (email == 'kaoutarhabach@gmail.com') {
		error.innerHTML = `<div class="alert alert-danger">your email already exists, please login</div>`;
		return;
	} else if (!validateEmail(email)) {
		error.innerHTML = `<div class="alert alert-danger">your email format is invalid</div>`;
		return;
	} else if (password == '') {
		error.innerHTML = `<div class="alert alert-danger">please enter a password</div>`;
		return;
	} else if (password.length < 6) {
		error.innerHTML = `<div class="alert alert-danger">please enter a longer password</div>`;
		return;
	} else if (!password.match(numbers) || !password.match(special)) {
		error.innerHTML = `<div class="alert alert-danger">your password must contain at least a number and a special caracter</div>`;
		return;
	} else if (passwordConfirm == '') {
		error.innerHTML = `<div class="alert alert-danger">please confirm your password</div>`;
		return;
	} else if (passwordConfirm !== password) {
		error.innerHTML = `<div class="alert alert-danger">your password doesn't match, try again</div>`;
		return;
	} else {
		error.innerHTML = `<div class="alert alert-success">registration submitted</div>`;
		return;
	}
}
