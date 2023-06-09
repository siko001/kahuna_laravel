var timerId = null; // Variable to store the timer ID

function showOverlayAdd() {
	document.getElementById('preview-adding').style.display = 'flex';
	document.body.style.overflow = 'hidden';
	var spinner = document.querySelector('.spinner');
	spinner.style.display = 'block';
	var text = document.querySelector('.hidden');
	text.style.display = 'none';
	if (timerId) {
		clearTimeout(timerId); // Clear the previous timer (if any)
	}
	timerId = setTimeout(function () {
		spinner.style.display = 'block';
		text.style.display = 'none';
		timerId = null; // Reset timerId after showing the text
	}, 750);
}

function closeOverlayAdd() {
	document.getElementById('preview-adding').style.display = 'none';
	document.body.style.overflow = 'auto';
	spinner.style.display = 'block';
	if (timerId) {
		clearTimeout(timerId); // Clear the timer if the overlay is closed before the text is shown
		timerId = null; // Reset timerId
	}
}

function showOverlayRemove(id) {
	productId = id;
	console.log(productId);
	var spinner = document.querySelector('#spinner');
	spinner.style.display = 'none';
	document.getElementById('preview-remove').style.display = 'flex';
	document.body.style.overflow = 'hidden';
}

function closeOverlayRemove() {
	document.getElementById('preview-remove').style.display = 'none';
	document.body.style.overflow = 'auto';
}

productId = id;
function closeOverlayRemoveProceed() {
	var spinner = document.querySelector('#spinner');
	spinner.style.display = 'block';
	const deleteButton = document.querySelector('#go-forward');
	deleteButton.addEventListener('click', function () {
		deleteProduct(productId);
		setTimeout(() => {
			window.location.reload();
		}, 1500);
	});

	window.onload = function () {
		document.getElementById('successMessage').style.display = 'block';
	};
}

function deleteProduct(productId) {
	// Make an AJAX request using the product ID
	var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': csrfToken,
		},
		url: '/delete-product/' + productId, // Replace with your actual route
		type: 'DELETE',

		success: function (response) {
			console.log(response);
			// Handle the success response, e.g., update the UI
			// Remove the deleted product from the displayed list
			// You can use JavaScript to remove the element from the DOM or reload the page
		},
		error: function (xhr) {
			// Handle the error response, e.g., display an error message
		},
	});
}
