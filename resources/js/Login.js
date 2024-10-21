$(document).ready(function() {
    // Cache the jQuery selectors for performance optimization
    const signUpButton = $('#signUp'); // Sign-up button element
    const signInButton = $('#signIn'); // Sign-in button element
    const container = $('#container'); // Container for the form

    signUpButton.on('click', function() {
        
        container.addClass('right-panel-active');
    });
    signInButton.on('click', function() {
       
        container.removeClass('right-panel-active');
    });

    
    function validateEmail(email) {
        // Regular expression for validating an email address
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        // Test the email address against the regex and return the result (true or false)
        return re.test(email);
    }

    function validatePassword(password) {
        // Check if the password length is at least 8 characters
        return password.length >= 8;
    }

    $('#signUpSubmit').on('click', function() {
        // Get the values from the input fields
        const email = $('#signUpForm input[type="email"]').val();
        const password = $('#signUpForm input[type="password"]').val();


        let isValid = true;

        if (!validateEmail(email)) {
            $('.sign-up-container .email-error').show().text('Invalid email address');
            isValid = false;
        } else {
            $('.sign-up-container .email-error').hide();
        }

        if (!validatePassword(password)) {
            $('.sign-up-container .password-error').show().text('Invalid password. Password must be at least 8 characters.');
            isValid = false;
        } else {
            $('.sign-up-container .password-error').hide();
        }

        // If the form is valid, redirect to the homepage
        if (isValid) {
            window.location.href = "Homepage.html";
        }
    });

    
    $('#signInSubmit').on('click', function() {
        // Get the values from the input fields
        const email = $('#signInForm input[type="email"]').val();
        const password = $('#signInForm input[type="password"]').val();

        let isValid = true;

        
        if (!validateEmail(email)) {
            $('.sign-in-container .email-error').show().text('Invalid email address');
            isValid = false;
        } else {
            $('.sign-in-container .email-error').hide();
        }

        if (!validatePassword(password)) {
            $('.sign-in-container .password-error').show().text('Invalid password. Password must be at least 8 characters.');
            isValid = false;
        } else {
            $('.sign-in-container .password-error').hide();
        }

        if (isValid) {
            window.location.href = "Homepage.html";
        }
    });
});
