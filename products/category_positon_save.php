<?php
    include '../include/dbcon.inc.php';

    if (isset($_POST['update'])) {
        foreach($_POST['positions'] as $position) {
           $index = $position[0];
           $newPosition = $position[1];

           $conn->query("UPDATE category1 SET position = '$newPosition' WHERE idx='$index'");
        }

        exit('success');
    }
?>