function validateField(field, value) {
    const rules = {
        email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
    };

    const errorMessages = {
        email: "Invalid email format (e.g., example@domain.com).",
    };
}

function validatePassword(value) {
    const lengthValid = value.length >= 8;
    const uppercaseValid = /[A-Z]/.test(value);
    const numberValid = /\d/.test(value);

    const criteriaMet = lengthValid && uppercaseValid && numberValid;
}

function validateForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const isEmailValid = validateField("email", email);
    const isPasswordValid = validatePassword(password);
    
    return isEmailValid && isPasswordValid;
};

