function validateField(field, value) {
    const rules = {
        firstName: /^[a-zA-Z]{2,}$/,
        lastName: /^[a-zA-Z]{2,}$/,
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        phone: /^\+?\d{4,15}$/,
        password: /^(?=.*[A-Z]).{8,}$/,
    };

    const errorMessages = {
        firstName: "First name must be at least 2 letters and contain only alphabets.",
        lastName: "Last name must be at least 2 letters and contain only alphabets.",
        email: "Email should be in the format: example@domain.com.",
        phone: "Phone number must be 4 to 15 digits long.",
        password: "Password must be at least 8 characters and include an uppercase letter.",
    };

    const regex = rules[field];
    const errorMessage = errorMessages[field];
    const errorElement = document.getElementById(`${field}Error`);

    if (!regex.test(value)) {
        errorElement.textContent = errorMessage;
        return false;
    } else {
        errorElement.textContent = "";
        return true;
    }
}

function validateForm() {
    let isValid = true;
    document.querySelectorAll('.error-message').forEach(msg => msg.textContent = "");

    const formValues = {
        firstName: document.getElementById("firstName").value.trim(),
        lastName: document.getElementById("lastName").value.trim(),
        email: document.getElementById("email").value.trim(),
        phone: document.getElementById("phone").value.trim(),
        password: document.getElementById("password").value,
        confirmPassword: document.getElementById("confirmPassword").value,
    };

    Object.keys(formValues).forEach(field => {
        if (field !== 'confirmPassword') {
            isValid &= validateField(field, formValues[field]);
        }
    });

    if (formValues.password !== formValues.confirmPassword) {
        document.getElementById('confirmPasswordError').textContent = "Passwords do not match.";
        isValid = false;
    } else {
        document.getElementById('confirmPasswordError').textContent = "";
    }

    return isValid;
}

document.querySelectorAll('#signupForm input').forEach(input => {
    input.addEventListener('blur', () => {
        validateField(input.id, input.value.trim());
    });
});