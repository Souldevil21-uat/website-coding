// ====== validation.js ======
// Custom client-side validation for Pilot Application Form

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("pilotApplicationForm");

    // Make sure the form exists before running validation
    if (!form) return;

    // Run validation on form submit
    form.addEventListener("submit", function (event) {
        let isValid = true; // Assume valid until a check fails

        // Clear all old error messages
        clearError("fullNameError");
        clearError("emailError");
        clearError("ageError");
        clearError("flightHoursError");
        clearError("experienceLevelError");
        clearError("readinessError");
        clearError("relocateError");
        clearError("motivationError");

        // Grab all form values
        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const age = parseInt(document.getElementById("age").value);
        const flightHours = parseInt(document.getElementById("flightHours").value);
        const experience = document.getElementById("experienceLevel").value;
        const relocate = document.getElementById("relocate").value;
        const motivation = document.getElementById("motivation").value.trim();

        // Get radio selection for readiness
        const readiness = document.querySelector('input[name="readiness"]:checked');

        // ===== VALIDATION RULES =====

        // Name required
        if (fullName === "") {
            setError("fullNameError", "Please enter your full name.");
            isValid = false;
        }

        // Email must not be blank and follow pattern
        if (email === "") {
            setError("emailError", "Please enter your email address.");
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            setError("emailError", "Invalid email format.");
            isValid = false;
        }

        // Age between 21 and 60
        if (isNaN(age)) {
            setError("ageError", "Please enter your age.");
            isValid = false;
        } else if (age < 21 || age > 60) {
            setError("ageError", "Age must be between 21 and 60.");
            isValid = false;
        }

        // Flight hours must be numeric and >= 1000
        if (isNaN(flightHours)) {
            setError("flightHoursError", "Please enter your total flight hours.");
            isValid = false;
        } else if (flightHours < 1000) {
            setError("flightHoursError", "You must have at least 1000 flight hours.");
            isValid = false;
        }

        // Must select experience
        if (experience === "") {
            setError("experienceLevelError", "Please select your experience level.");
            isValid = false;
        }

        // Must select readiness
        if (!readiness) {
            setError("readinessError", "Please rate your readiness.");
            isValid = false;
        }

        // Must select relocation option
        if (relocate === "") {
            setError("relocateError", "Please choose your relocation option.");
            isValid = false;
        }

        // Motivation must be at least 30 characters
        if (motivation.length < 30) {
            setError("motivationError", "Motivation must be at least 30 characters long.");
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });

    // ===== Helper functions =====

    // Display error message
    function setError(id, message) {
        document.getElementById(id).textContent = message;
    }

    // Clear existing error
    function clearError(id) {
        document.getElementById(id).textContent = "";
    }
});
