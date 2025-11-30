// Modal Elements
const authModal = document.getElementById("authModal");
const navBar = document.getElementById("navBar");
const logoutBtn = document.getElementById("logoutBtn");
const closeBtn = document.querySelector(".close");

const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");
const toRegister = document.getElementById("toRegister");
const toLogin = document.getElementById("toLogin");

const sections = document.querySelectorAll("section");

// Function to show main page
function showMainPage() {
    authModal.style.display = "none";
    navBar.style.display = "flex";
    sections.forEach(section => section.style.display = "block");
}

// Function to show auth modal
function showAuthModal() {
    authModal.style.display = "block";
    navBar.style.display = "none";
    sections.forEach(section => section.style.display = "none");
}

// Check if user is logged in on page load (using sessionStorage for simplicity, replace with cookies/sessions in PHP)
window.addEventListener("load", () => {
    const loggedInUser = sessionStorage.getItem("loggedInUser");
    if (loggedInUser) {
        showMainPage();
    } else {
        showAuthModal();
    }
});

// Switch forms
toRegister.addEventListener("click", () => {
    loginForm.style.display = "none";
    registerForm.style.display = "block";
});
toLogin.addEventListener("click", () => {
    loginForm.style.display = "block";
    registerForm.style.display = "none";
});

// Close modal (only if logged in)
closeBtn.addEventListener("click", () => {
    if (!sessionStorage.getItem("loggedInUser")) {
        return;
    }
    authModal.style.display = "none";
});
window.addEventListener("click", (e) => {
    if (e.target == authModal && sessionStorage.getItem("loggedInUser")) {
        authModal.style.display = "none";
    }
});

// Registration using Fetch API
const registerSubmit = document.getElementById("registerSubmit");
registerSubmit.addEventListener("click", () => {
    const username = document.getElementById("regUsername").value;
    const password = document.getElementById("regPassword").value;
    if (username && password) {
        fetch('auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'register', username, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                sessionStorage.setItem("loggedInUser", username);
                alert("Registration successful! You are now logged in.");
                document.getElementById("regUsername").value = "";
                document.getElementById("regPassword").value = "";
                showMainPage();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert("Please enter username and password.");
    }
});

// Login using XMLHttpRequest
const loginSubmit = document.getElementById("loginSubmit");
loginSubmit.addEventListener("click", () => {
    const username = document.getElementById("loginUsername").value;
    const password = document.getElementById("loginPassword").value;
    if (username && password) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'auth.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                if (data.success) {
                    sessionStorage.setItem("loggedInUser", username);
                    alert("Login successful!");
                    document.getElementById("loginUsername").value = "";
                    document.getElementById("loginPassword").value = "";
                    showMainPage();
                } else {
                    alert(data.message);
                }
            }
        };
        xhr.send(JSON.stringify({ action: 'login', username, password }));
    } else {
        alert("Please enter username and password.");
    }
});

logoutBtn.addEventListener("click", () => {
    sessionStorage.removeItem("loggedInUser");
    alert("Logged out!");
    showAuthModal();
});

// Smooth scrolling for nav links
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        target.scrollIntoView({ behavior: 'smooth' });
    });
});

// Handle enrollment form submission using Fetch API
const enrollmentForm = document.getElementById("enrollmentForm");
enrollmentForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const parentName = document.getElementById("parentName").value;
    const parentEmail = document.getElementById("parentEmail").value;
    const childName = document.getElementById("childName").value;
    const childAge = document.getElementById("childAge").value;
    fetch('auth.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'enroll', parentName, parentEmail, childName, childAge })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        enrollmentForm.reset();
    })
    .catch(error => console.error('Error:', error));
});

// Handle contact form submission (client-side only, as before)
const contactForm = document.getElementById("contactForm");
contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Thank you for your message! We'll get back to you soon.");
    contactForm.reset();
});