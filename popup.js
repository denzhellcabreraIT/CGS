// Get modal elements
var loginModal = document.getElementById("loginModal");

// Get buttons that open the modals
var openLogin = document.getElementById("openLogin");

// Get elements that close the modals
var closeLogin = document.getElementById("closeLogin");

// Open login modal when button is clicked
openLogin.onclick = function() {
    loginModal.style.display = "flex";
}

// Close login modal when close button is clicked
closeLogin.onclick = function() {
    loginModal.style.display = "none";
}

// Close modal if user clicks outside of it
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
}
