<!DOCTYPE html>
<html style = "background: url(https://image.slidesdocs.com/responsive-images/background/gradient-business-blue-blooming-watercolor-gradient-peace-powerpoint-background_52df18bdda__960_540.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
<head>
    <title>Password Strength Checker</title>
    /*    This HTML file is designed to check the strength of a password entered by the user.
        It uses a PHP backend to evaluate the password and returns a score based on its strength. */
    <style>
        body {
            font-family: Arial;  /* Use Arial font for better readability */
            color: black;  /* Set text color to black for contrast */   
            background:rgba(240, 240, 240, 0); /* Transparent background for the body */
            padding: 40px; /* Add padding around the body for better spacing */
        }
        .container {
            max-width: 500px; /* Set a maximum width for the container */
            margin: auto; /* Center the container */
            background: white;  /* White background for the container */
            padding: 30px; /* Add padding inside the container */
            border-radius: 10px;  /* Rounded corners for the container */
            box-shadow: 2px 2px 15px rgba(0,0,0,0.2); /* Add a subtle shadow for depth */
        }  
          /* Form styles */
        input[type="password"], input[type="submit"] /* Style for password input and submit button */{
            padding: 10px; /* Add padding for better touch targets */
            width: 100%; /* Full width for inputs */
            margin-top: 15px; /* Space between inputs */
            font-size: 16px; /* Larger font size for better readability */
        }

        /*  Modal styles  */ 
         /* Style for the modal popup */
        /* The modal is hidden by default and will be displayed when the user submits the form */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Fixed position to cover the entire screen */
            top: 0; left: 0; right: 0; bottom: 0;   /* Cover the entire viewport */
            background-color: rgba(0,0,0,0.5); /* Semi-transparent background */
            justify-content: center;     /* Center the modal content */
            align-items: center; /* Center the modal content vertically and horizontally */
            z-index: 1000; /* Ensure the modal is above other content */
        }
        .modal-content  /* Style for the content inside the modal */{
            background: white; /* White background for the modal content */
            padding: 20px 30px; /* Padding inside the modal content */
            border-radius: 10px; /* Rounded corners for the modal content */
            text-align: center; /* Center the text inside the modal */
            max-width: 400px; /* Maximum width for the modal content */
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3); /* Subtle shadow for depth */
        }
        .close-btn { /* Style for the close button in the modal */
            margin-top: 20px; /* Space above the button */
            background-color: #e74c3c; /* Red background for the close button */
            color: white;  /* White text color for contrast */
            padding: 8px 16px; /* Padding for the button */
            border: none; /* No border for the button */
            border-radius: 5px; /* Rounded corners for the button */
            cursor: pointer; /* Pointer cursor on hover */
        }
        .result-text {
            font-size: 18px; /* Larger font size for the result text */
            font-weight: bold; /* Bold text for emphasis */
        } 
        /* Responsive styles */
    </style> 
</head> 
<body> <!-- Main container for the password strength checker -->
    <div style = "color: black;" class="container">   <!-- Container for the form and modal -->
        <h2 style = "color: black ;">Check Your Password Strength</h2> <!-- Heading for the password strength checker --> 
        <form id="passwordForm"> <!-- Form to submit the password -->
            <label style = "color: black;" for="password">Enter password:</label> <!-- Label for the password input -->
            <input type="password" id="password" name="password" required> <!-- Password input field, required for submission -->
            <input type="submit" value="Check Strength"> <!-- Submit button to check the password strength -->
        </form>
    </div>

    <!-- Modal popup -->
    <div id="strengthModal" class="modal"> <!-- Modal to display the password strength result -->
        <div class="modal-content">     <!-- Content inside the modal -->
            <div id="strengthResult" class="result-text"></div>   <!-- Div to display the password strength result -->
            <button class="close-btn" onclick="closeModal()">Close</button>  <!-- Close button to hide the modal -->
        </div>
    </div>
    <!-- JavaScript to handle form submission and modal display -->
    <script>
        const form = document.getElementById('passwordForm'); // Get the form element by its ID
        const modal = document.getElementById('strengthModal'); // Get the modal element by its ID
        const resultDiv = document.getElementById('strengthResult'); // Get the result div inside the modal
        // Add event listener for form submission
        form.addEventListener('submit', function(e) { 
            e.preventDefault(); // Prevent the default form submission behavior

            const password = document.getElementById('password').value; // Get the password value from the input field
            // Validate password length
            fetch('add.php', { // Send a POST request to the PHP script to check password strength
                method: 'POST',  // Use POST method for the request
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}, // Set the content type to URL encoded
                body: 'password=' + encodeURIComponent(password) // Encode the password for safe transmission
            }) 
             // Handle the response from the PHP script
            .then(response => response.text())  // Convert the response to text
            .then(score => { 
                score = parseInt(score); // Parse the score returned by the PHP script
                let message = `Password Strength Score: ${score} / 11<br>`;  // Prepare the message to display in the modal

                if (score >= 8) { 
                    message += "<span style='color:green'>Strength: STRONG ✅</span>";
                } else if (score >= 5) {
                    message += "<span style='color:orange'>Strength: MODERATE ⚠️</span>";
                } else {
                    message += "<span style='color:red'>Strength: WEAK ❌</span>";
                }

                resultDiv.innerHTML = message;
                modal.style.display = 'flex';
            })
            .catch(err => {
                resultDiv.innerHTML = "<span style='color:red'>Error checking password strength.</span>";
                modal.style.display = 'flex';
            });
        });

        function closeModal() {
            modal.style.display = 'none';
            document.getElementById('password').value = ''; // Clear password
        }
    </script>
</body>
</html>
