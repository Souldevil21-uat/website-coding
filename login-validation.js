// login-validation.js
// Client-side validation to ensure userid and password fields are not empty.

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    if (!form) return;

    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Clear previous error messages
        setError("useridError", "");
        setError("passwordError", "");

        // Get current field values
        const userid = document.getElementById("userid").value.trim();
        const password = document.getElementById("password").value.trim();

        // Userid must not be blank
        if (userid === "") {
            setError("useridError", "Please enter your userid.");
            isValid = false;
        }

        // Password must not be blank
        if (password === "") {
            setError("passwordError", "Please enter your password.");
            isValid = false;
        }

        // If validation failed, prevent the form from submitting
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Helper function to show an error message in the given span element.
    function setError(elementId, message) {
        const el = document.getElementById(elementId);
        if (el) {
            el.textContent = message;
        }
    }
});
