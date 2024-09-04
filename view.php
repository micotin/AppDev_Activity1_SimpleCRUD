<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
} else {
    echo "No product ID specified.";
    exit;
}
?>

<h1>View Product</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <td><?php echo htmlspecialchars($product['id']); ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo htmlspecialchars($product['Name']); ?></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo htmlspecialchars($product['Description']); ?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php echo htmlspecialchars($product['Price']); ?></td>
    </tr>
    <tr>
        <th>Quantity</th>
        <td><?php echo htmlspecialchars($product['Quantity']); ?></td>
    </tr>
    <tr>
        <th>Created At</th>
        <td><?php echo htmlspecialchars($product['Created At']); ?></td>
    </tr>
    <tr>
        <th>Updated At</th>
        <td><?php echo htmlspecialchars($product['Updated At']); ?></td>
    </tr>
</table>

<br>
<a href="index.php">Back to Suarez ~ Products</a>
