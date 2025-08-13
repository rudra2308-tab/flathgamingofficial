<?php
$email = $_POST['email'];
$mcname = $_POST['minecraftName'];
$discord = $_POST['discordName'];
$mobile = $_POST['mobile'];

// Ensure data folder exists
if (!is_dir('data')) {
    mkdir('data', 0755, true);
}

// Check if already registered
if (file_exists("data/$email.txt")) {
    die('You have already registered.');
}

// Generate unique code
$code = strtoupper(bin2hex(random_bytes(4)));

// Save record
file_put_contents("data/$email.txt", "$mcname|$discord|$mobile|$code");

// Send email
$subject = "Your Minecraft Ticket Code";
$message = "Hello $mcname,\n\nThank you for registering!\nYour ticket code is: $code\n\nKeep this code safe.";
$headers = "From: noreply@yourdomain.com";

if (mail($email, $subject, $message, $headers)) {
    echo "Registration successful! Check your email for the ticket code.";
} else {
    echo "Registration saved, but email could not be sent.";
}
?>