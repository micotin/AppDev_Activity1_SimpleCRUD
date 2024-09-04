<?php
include 'conn.php';

if (isset($_GET['id']) && !isset($_GET['confirm'])) {

    $id = $_GET['id'];

    echo "Are you sure you want to delete this record?<br>";
    echo "<a href='delete.php?id=$id&confirm=yes'>Yes</a> | ";
    echo "<a href='index.php'>No</a>";

} elseif (isset($_GET['id']) && $_GET['confirm'] === 'yes') {
    
    $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
