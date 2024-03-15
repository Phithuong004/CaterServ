<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header("location: login.php");
    exit;
}

// Include your database connection file here
require_once "db_connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Control</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #D4A762;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        input[type=submit] {
            background-color: #D4A762;
            color: black;
            font-weight: bold;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        input[type=submit]:hover {
            background-color: black;
            color: #D4A762;
        }
    </style>
<body>
    <h1>Admin Control</h1>

    <?php
        require 'db_connect.php';

        // Check if a delete request has been made
        if (isset($_GET['delete_id'])) {
            $id = $_GET['delete_id'];

            // Prepare a delete statement
            $stmt = $conn->prepare("DELETE FROM food WHERE food_id = ?");
            $stmt->bind_param("i", $id);

            // Execute the delete statement
            if ($stmt->execute()) {
                echo "Product deleted successfully";
            } else {
                echo "Error deleting product: " . $conn->error;
            }
        }
        // Check if an update request has been made
        if (isset($_POST['update_id'])) {
            $id = $_POST['update_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image_url = $_POST['image_url'];
            $type = $_POST['type'];
            $sale = $_POST['sale'];

            // Prepare an update statement
            $stmt = $conn->prepare("UPDATE food SET name = ?, price = ?, description = ?, image_url = ?, type = ?, sale = ? WHERE food_id = ?");
            $stmt->bind_param("ssssssi", $name, $price, $description, $image_url, $type, $sale, $id);

            // Execute the update statement
            if ($stmt->execute()) {
                echo "Product updated successfully";
                header("location: admin_control.php");
            } else {
                echo "Error updating product: " . $conn->error;
            }
        }
        // Fetch all products from the 'food' table
        $result = $conn->query("SELECT * FROM food");

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image URL</th><th>Type</th><th>Sale</th><th>Action</th></tr>";
            
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<form method='POST'>";
                echo "<td>" . $row["food_id"] . "<input type='hidden' name='update_id' value='" . $row["food_id"] . "'></td>";
                echo "<td><input type='text' name='name' value='" . $row["name"] . "'></td>";
                echo "<td><input type='text' name='price' value='" . $row["price"] . "'></td>";
                echo "<td><input type='text' name='description' value='" . $row["description"] . "'></td>";
                echo "<td><input type='text' name='image_url' value='" . $row["image_url"] . "'></td>";
                echo "<td><input type='text' name='type' value='" . $row["type"] . "'></td>";
                echo "<td><input type='text' name='sale' value='" . $row["sale"] . "'></td>";
                echo "<td><input type='submit' value='Update'> | <a href='admin_control.php?delete_id=" . $row["food_id"] . "'>Delete</a></td>";
                echo "</form>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No products found";
        }
    ?>

<!-- --------------------------------------------------------------------------- -->

    <h2>Add Product</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form"]) && $_POST["form"] == "addProduct") {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $image_url = $_POST["image_url"];
        $type = $_POST["type"];
        $sale = $_POST["sale"];

        $sql = "INSERT INTO food (name, price, description, image_url, type, sale) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $price, $description, $image_url, $type, $sale);

        if ($stmt->execute()) {
            echo "New product added successfully";
        } else {        
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <form method="post" action="">
        Name: <input type="text" name="name"><br>
        Price: <input type="text" name="price"><br>
        Description: <input type="text" name="description"><br>
        Image URL: <input type="text" name="image_url"><br>
        Type: <input type="text" name="type"><br>
        Sale: <input type="text" name="sale"><br>
        <input type="hidden" name="form" value="addProduct">
        <input type="submit" value="Add Product">
    </form>

    <!-- ------------------------------------------------------------------------ -->


    <h2>Manage Users</h2>
    <script>
    function toggleEditForm(id) {
        var form = document.getElementById('editForm' + id);
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
    </script>

    <?php
    // Handle the user role update
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form"]) && $_POST["form"] == "updateRole") {
        $id = $_POST["id"];
        $role = $_POST["role"];

        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $role, $id);

        if ($stmt->execute()) {
            echo "User role updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fetch all users from the 'users' table
    $result = $conn->query("SELECT * FROM users");

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Phone Number</th><th>Email</th><th>Address</th><th>Role</th><th>Action</th></tr>";
        
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["role"] . "</td>";
            echo "<td>";
            echo "<button onclick='toggleEditForm(" . $row["id"] . ")'>Edit</button>";
            echo "<form id='editForm" . $row["id"] . "' style='display: none' method='post' action=''>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "<input type='text' name='role' value='" . $row["role"] . "'>";
            echo "<input type='hidden' name='form' value='updateRole'>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No users found";
    }
    ?>
</body>
</html>