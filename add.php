
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST['password'] ?? '';

    // Basic input check
    if (empty($password)) // Check if password is empty 
    {
        echo "0";
        exit;
    }

    // 1️⃣ Strict characters only — reject anything weird or dangerous
    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+=]{8,50}$/', $password)) { // Check if password contains only allowed characters
        echo "0";
        exit;   // Invalid password
    }

    // 2️⃣ Enforce rule-based password policy
    $has_upper = preg_match('/[A-Z]/', $password); // Check if password contains at least one uppercase letter
    $has_lower = preg_match('/[a-z]/', $password); // Check if password contains at least one lowercase letter
    $has_digit = preg_match('/[0-9]/', $password); // Check if password contains at least one digit
    $has_symbol = preg_match('/[!@#$%^&*()_+=]/', $password); // Check if password contains at least one symbol

    if (!$has_upper || !$has_lower || !$has_digit || !$has_symbol) {
        echo "0";
        exit;   // Password does not meet complexity requirements
    }

    // ✅ Safe to run the EXE now
    $command = __DIR__ . DIRECTORY_SEPARATOR . "passphp.exe " . escapeshellarg($password); // Prepare the command to execute the EXE with the password as an argument
    $output = []; // Initialize output array to capture command output
    exec($command, $output, $return_code); // Execute the command and capture output

    if (!empty($output)) {
        echo (int)$output[0];
    } else {
        echo "0"; // EXE failed or empty result
    }
    exit;
}

echo "0";
?>
