<?php

include 'db.php';

$query = "SELECT * FROM students";
$result = $connection->query($query);

if ($result) {
    $rows = $result->num_rows;
    echo $rows;
} else {
    echo "Error: " . $connection->error;
}
?>
