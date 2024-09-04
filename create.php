<?php
include 'conn.php';

if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $description = $_POST['Description'];
    $price = $_POST['Price'];
    $quantity = $_POST['Quantity'];

    $stmt = $conn->prepare("INSERT INTO products (Name, Description, Price, Quantity, `Created At`, `Updated At`) 
                             VALUES (?, ?, ?, ?, NOW(), NOW())");

    $stmt->bind_param("ssdi", $name, $description, $price, $quantity);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<h1>Add Product</h1>
<br>
<form method="POST" action="">
    Name: <input type="text" name="Name" required><br>
    Description: <textarea name="Description" required></textarea><br>
    Price: <input type="text" name="Price" required><br>
    Quantity: <input type="number" name="Quantity" required><br>
    <br>
    <input type="submit" name="submit" value="Add Product">
</form>

