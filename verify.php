<?php
    // Include your database configuration file
    include 'db_connect.php';

    // Check if verification code is set in URL
    if(isset($_GET['code'])) {
        $verification_code = $_GET['code'];

        // Get user data from temporary users table
        $sql = "SELECT * FROM users_temp WHERE verification_code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $verification_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user) {
            // Insert user data into users table
            $sql = "INSERT INTO users (username, password, address, phone_number, email, role) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $user['username'], $user['password'], $user['address'], $user['phone_number'], $user['email'], $user['role']);

            if($stmt->execute()) {
                echo "Account verified successfully.";

                // Delete user data from temporary users table
                $sql = "DELETE FROM users_temp WHERE verification_code = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $verification_code);
                $stmt->execute();

                // Redirect to index.php
                header("Location: login.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Invalid verification code.";
        }

        $stmt->close();
    } else {
        echo "Verification code not set in URL.";
    }

    $conn->close();
?>