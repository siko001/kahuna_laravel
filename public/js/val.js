$(document).ready(function () {
	// Clear error messages when any input field is focused
	$('#usernamereg').on('input', function () {
		$('.username').remove();
	});
	$('#emailreg').on('input', function () {
		$('.email').remove();
	});
	$('#password').on('input', function () {
		$('.password').remove();
	});
	$('#cpassword').on('input', function () {
		$('.cpassword').remove();
	});
});
//validation and ajax calls for registration(AJAX is also calling the update profile page username and email!)

$(document).ready(function () {
	$('.usernamereg').keyup(function () {
		var username = $(this).val();

		//check if the Username is minimum 4 chars long
		if (username.length < 4) {
			var noticeElement = $('.username-notice');
			// Username is less than 4 characters
			noticeElement.html('<p class="error">Minimum 4 characters</p>');
			return;
		}

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
		});

		$.ajax({
			url: '/registerusername',
			method: 'POST',
			data: { username: username },
			success: function (response) {
				var noticeElement = $('.username-notice');

				if (response.available) {
					// Username is available
					noticeElement.html(`<p class='good'>Username is available</p>`).removeClass('unavailable').addClass('available');
				} else {
					// Username is not available
					noticeElement.html('<p class="error">Username is not available</p>').removeClass('available').addClass('unavailable');
				}
			},
		});
	});
});

$(document).ready(function () {
	$('.emailreg').keyup(function () {
		var email = $(this).val();
		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		var noticeElement = $('.email-notice');
		if (!emailRegex.test(email)) {
			noticeElement.html('<p class="error">Invalid email format</p>').removeClass('available').addClass('invalid');
			return;
		}

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
		});

		$.ajax({
			url: '/registeremail',
			method: 'POST',
			data: { email: email },
			success: function (response) {
				var noticeElement = $('.email-notice');

				if (response.available) {
					// email is available
					noticeElement.html('<p class="good">Email is available!</p>').removeClass('unavailable').addClass('available');
				} else {
					// Username is not available
					noticeElement.html('<p class="error">Email already registered!</p>').removeClass('available').addClass('unavailable');
				}
			},
		});
	});
});

$(document).ready(function () {
	$('#password').keyup(function () {
		var password = $(this).val();
		var noticeElement = $('#password-notice');
		var cpassword = $('#cpassword').val();
		var cnoticeElement = $('#cpassword-notice');

		if (password.length < 4) {
			noticeElement.html('<p class="error">Password must be a minimum of 4 characters long</p>');
		} else {
			noticeElement.html('');
		}
		if (password.length >= 4 && cpassword.length >= 4) {
			if (cpassword === password) {
				noticeElement.html("<p class='good'>Passwords match</p>");
				cnoticeElement.html("<p class='good'>Passwords match</p>");
			} else {
				noticeElement.html("<p class='error'>Passwords do not match</p>");
				cnoticeElement.html("<p class='error'>Passwords do not match</p>");
			}
		} else {
			cnoticeElement.html('');
		}
	});

	$('#cpassword').keyup(function () {
		var password = $('#password').val();
		var cpassword = $(this).val();
		var noticeElement = $('#password-notice');
		var cnoticeElement = $('#cpassword-notice');

		if (cpassword === password) {
			noticeElement.html("<p class='good'>Passwords match</p>");
			cnoticeElement.html("<p class='good'>Passwords match</p>");
		} else {
			noticeElement.html("<p class='error'>Passwords do not match</p>");
			cnoticeElement.html("<p class='error'>Passwords do not match</p>");
		}
	});
});

//--validation for extra information in update profile section-----------------

$(document).ready(function () {
	$('#name').keyup(function () {
		var name = $(this).val();
		var nameNotice = $('.name-notice');
		var nameRegex = /^[A-Za-z]+$/;

		if (!nameRegex.test(name)) {
			nameNotice.html('<p class="error">Name Cannot contain numbers</p>');
		} else {
			nameNotice.text('');
		}
	});
});
$(document).ready(function () {
	$('#surname').keyup(function () {
		var surname = $(this).val();
		var surnameNotice = $('.surname-notice');
		var surnameRegex = /^[A-Za-z]+$/;

		if (!surnameRegex.test(surname)) {
			console.log('hello');
			surnameNotice.html('<p class="error">Surname Cannot contain numbers</p>');
		} else {
			surnameNotice.text('');
		}
	});
});

$(document).ready(function () {
	$('#phone_number').keyup(function () {
		var number = $(this).val();
		var phoneNotice = $('.phone-notice');
		var regex = /^(\+)?([0-9]+)$/;

		if (!regex.test(number)) {
			phoneNotice.html('<p class="error">Phone number should contain only numbers</p>');
		} else {
			phoneNotice.text('');
		}
	});
});

// ENTER NEW PASSWORD VALIDATION ----------------------
$(document).ready(function () {
	$('.new-password').keyup(function () {
		var password = $(this).val();
		var noticeElement = $(this).closest('.form-floating').find('.new-password-notice');
		var cpassword = $(this).closest('.custom-form').find('.confirm-new-password').val();
		var cnoticeElement = $(this).closest('.custom-form').find('.confirm-new-password-notice');

		if (password.length < 4) {
			noticeElement.html('<p class="error">Password must be a minimum of 4 characters long</p>');
		} else {
			noticeElement.html('');
		}

		if (password.length >= 4 && cpassword.length >= 4) {
			if (cpassword === password) {
				noticeElement.html("<p class='good'>Passwords match</p>");
				cnoticeElement.html("<p class='good'>Passwords match</p>");
			} else {
				noticeElement.html("<p class='error'>Passwords do not match</p>");
				cnoticeElement.html("<p class='error'>Passwords do not match</p>");
			}
		} else {
			cnoticeElement.html('');
		}
	});

	$('.confirm-new-password').keyup(function () {
		var password = $(this).closest('.custom-form').find('.new-password').val();
		var cpassword = $(this).val();
		var noticeElement = $(this).closest('.custom-form').find('.new-password-notice');
		var cnoticeElement = $(this).closest('.custom-form').find('.confirm-new-password-notice');

		if (cpassword === password) {
			noticeElement.html("<p class='good'>Passwords match</p>");
			cnoticeElement.html("<p class='good'>Passwords match</p>");
		} else {
			noticeElement.html("<p class='error'>Passwords do not match</p>");
			cnoticeElement.html("<p class='error'>Passwords do not match</p>");
		}
	});
});

//pointer to either registration or login form ---------------------------------------------
var url = window.location.href;
if (url.includes('register')) {
	document.getElementById('tab-2');
	if (tab2 !== null) {
		tab2.checked = true;
	}
} else {
	var tab1 = document.getElementById('tab-1');
	if (tab1 !== null) {
		tab1.checked = true;
	}
}

document.getElementById('myLink').addEventListener('click', function (event) {
	event.preventDefault();
});
