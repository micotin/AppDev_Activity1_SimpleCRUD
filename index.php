<?php
include 'conn.php';

echo "<h1>Suarez ~ Products</h1>";

echo "<a href='create.php'>Add Product</a><br><br>";

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"]. "</td>
        <td>" .$row["Name"]. "</td>
        <td>" .$row["Description"]. "</td>
        <td>" .$row["Price"]. "</td>
        <td>" .$row["Quantity"]. "</td>
        <td>" .$row["Created At"]. "</td>
        <td>" .$row["Updated At"]. "</td>
        <td>
            <a href='view.php?id=" . $row["id"] . "'>View</a> | 
            <a href='update.php?id=".$row["id"]."'>Edit</a> | 
            <a href='delete.php?id=".$row["id"]."'>Delete</a>
        </td>
        </tr>";   
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
