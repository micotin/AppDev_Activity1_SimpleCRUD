<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "No product ID specified.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['Name'];
    $description = $_POST['Description'];
    $price = $_POST['Price'];
    $quantity = $_POST['Quantity'];

    $sql = "UPDATE products SET Name=?, Description=?, Price=?, Quantity=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $name, $description, $price, $quantity, $id);

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

<h1>Edit Product</h1>
<br>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
    Name: <input type="text" name="Name" value="<?php echo htmlspecialchars($row['Name']); ?>" required><br>
    Description: <textarea name="Description" required><?php echo htmlspecialchars($row['Description']); ?></textarea><br>
    Price: <input type="text" name="Price" value="<?php echo htmlspecialchars($row['Price']); ?>" required><br>
    Quantity: <input type="number" name="Quantity" value="<?php echo htmlspecialchars($row['Quantity']); ?>" required><br>
    <br>
    <input type="submit" value="Update">
</form>

