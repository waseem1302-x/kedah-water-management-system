<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "water_quality");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check credentials securely to avoid SQL injection
    $stmt = $conn->prepare("SELECT username FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username; // Store the username in the session for display
        header("Location: index.php"); // Redirect to the main dashboard
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <h2>Admin Login</h2>
            <?php if (isset($error_message)) : ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">LOG IN NOW</button>
            </form>
            <div class="social-login">
    <p>Log in via</p>
    <a href="https://www.facebook.com"><img src="images\facebook logo.png" alt="Facebook" style="width: 30px; height: 30px;"></a>
    <a href="https://www.twitter.com"><img src="images\x logo.png" alt="Twitter" style="width: 30px; height: 30px;"></a>
    <a href="https://www.instagram.com"><img src="images\insta logo.png" alt="Instagram" style="width: 30px; height: 30px;"></a>
</div>

        </div>
    </div>
</body>
</html>
