<?php
require 'database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();

    $parent = $_POST["parent"];
    $name = $_POST["name"];

    $stmt = $conn->prepare("INSERT INTO members (ParentId, Name) VALUES (?, ?)");
    $stmt->execute([$parent, $name]);

    $query = "SELECT * FROM members";
    $stmt = $conn->query($query);
    $members = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $members[] = $row;
    }
}
?>
