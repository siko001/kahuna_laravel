export default class ApiService {
	constructor() {
		// Constructor code
	}

	checkUsername(username) {
		return fetch('/check-username', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add this line if you're using Laravel's CSRF protection
			},
			body: JSON.stringify({ username }),
		})
			.then((response) => {
				if (response.ok) {
					return response.json();
				}
				throw new Error('Request failed.');
			})
			.then((data) => {
				// Handle the response
				const usernameNotice = document.querySelector('.username-notice');
				if (data.exists) {
					usernameNotice.textContent = 'Username taken';
				} else {
					usernameNotice.textContent = 'Username available';
				}
			})
			.catch((error) => {
				// Handle any errors
				console.error(error);
			});
	}

	checkEmail(email) {
		return fetch('/check-email', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add this line if you're using Laravel's CSRF protection
			},
			body: JSON.stringify({ email }),
		})
			.then((response) => {
				if (response.ok) {
					return response.json();
				}
				throw new Error('Request failed.');
			})
			.then((data) => {
				// Handle the response
				const emailNotice = document.querySelector('.email-notice');
				if (data.exists) {
					emailNotice.textContent = 'Email taken';
				} else {
					emailNotice.textContent = 'Email available';
				}
			})
			.catch((error) => {
				// Handle any errors
				console.error(error);
			});
	}
}

// Assuming you have an input field for username and email
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');

const apiService = new ApiService();

usernameInput.addEventListener('keyup', () => {
	const username = usernameInput.value;
	apiService.checkUsername(username);
});

emailInput.addEventListener('keyup', () => {
	const email = emailInput.value;
	apiService.checkEmail(email);
});
