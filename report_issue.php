<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $problem = $_POST['problem'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "water_quality");

    // Check connection
    if ($conn->connect_error) {
        die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
    }

    // Insert query
    $sql = "INSERT INTO reported_issues (name, address, location, problem, phone_number, email, description) 
            VALUES ('$name', '$address', '$location', '$problem', '$phone_number', '$email', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Issue reported successfully. Thank you for your feedback!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }

    // Close connection
    $conn->close();
}
?>

<h2>Report an Issue</h2>
<div class="form-container">
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your address" required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter the location of the issue" required>
        </div>

        <div class="form-group">
            <label for="problem">Problem:</label>
            <input type="text" id="problem" name="problem" placeholder="Describe the problem" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" placeholder="Provide a detailed description of the issue" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

<style>
    .form-container {
        max-width: 600px;
        margin: auto;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }

    input:focus, textarea:focus {
        border-color: #6C63FF;
        outline: none;
        box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
    }

    button {
        background-color: #6C63FF;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #5548C8;
    }
</style>
