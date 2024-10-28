function openNav() {
    document.getElementById("myNav").style.width = "100%"; // Open the overlay
    document.getElementById("openNavButton").style.display = "none"; // Hide the open button
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%"; // Close the overlay
    document.getElementById("openNavButton").style.display = "block"; // Show the open button again
}

let prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;
    let navbar = document.getElementById("navbar");
    
    if (prevScrollpos > currentScrollPos) {
        navbar.style.top = "32px"; // Navbar is visible while scrolling up
    } else {
        navbar.style.top = "0px"; // Navbar hides while scrolling down
    }
    
    prevScrollpos = currentScrollPos;
};

document.getElementById('checkoutform').addEventListener('submit', function(event) {
    // Full Name validation
    var fname = document.getElementById('fname').value;
    if (!/^[A-Za-z\s]{1,50}$/.test(fname)) {
        alert('Please enter a valid full name (letters and spaces only, max 50 characters).');
        event.preventDefault();
        return;
    }

    // Email validation
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        event.preventDefault();
        return;
    }

    // Address validation
    var address = document.getElementById('adr').value;
    if (address.length < 5) {
        alert('Please enter a valid address with at least 5 characters.');
        event.preventDefault();
        return;
    }

    // City validation
    var city = document.getElementById('city').value;
    if (!/^[A-Za-z\s]{1,50}$/.test(city)) {
        alert('Please enter a valid city name.');
        event.preventDefault();
        return;
    }

    // Province validation
    var province = document.getElementById('state').value;
    if (!/^[A-Za-z\s]{1,50}$/.test(province)) {
        alert('Please enter a valid province name.');
        event.preventDefault();
        return;
    }

    // Zip Code validation (must be a number, 5 digits)
    var zip = document.getElementById('zip').value;
    if (!/^\d{5}$/.test(zip)) {
        alert('Please enter a valid 5-digit zip code.');
        event.preventDefault();
        return;
    }

    // Credit Card Number validation (must be 16 digits, formatted as xxxx-xxxx-xxxx-xxxx)
    var cardnumber = document.getElementById('ccnum').value;
    var cardPattern = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
    if (!cardPattern.test(cardnumber)) {
        alert('Please enter a valid credit card number (format: xxxx-xxxx-xxxx-xxxx).');
        event.preventDefault();
        return;
    }

    // Expiration Month validation
    var expmonth = document.getElementById('expmonth').value;
    if (!/^[A-Za-z\s]+$/.test(expmonth)) {
        alert('Please enter a valid expiration month.');
        event.preventDefault();
        return;
    }

    // Expiration Year validation (must be a 4-digit number)
    var expyear = document.getElementById('expyear').value;
    if (!/^\d{4}$/.test(expyear)) {
        alert('Please enter a valid expiration year (4 digits).');
        event.preventDefault();
        return;
    }

    // CVV validation (must be 3 digits)
    var cvv = document.getElementById('cvv').value;
    if (!/^\d{3}$/.test(cvv)) {
        alert('Please enter a valid 3-digit CVV number.');
        event.preventDefault();
        return;
    }

    // If all validations pass
    alert('Form submitted successfully!');
});

