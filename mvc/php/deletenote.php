<?php

include 'dbcon.php';

$id = $_GET['id'];

$delete= "delete from sellernotes where ID=$id";
$delquery= mysqli_query($con,$delete);
if($delquery){
    ?>
    <script>
            alert("deleted successfully");
            location.replace("../front/dashboard.php");
    </script>
    <?php
}
else{
    ?>
    <script>
            alert("delete failed");
            location.replace("../front/dashboard.php");
    </script>
    <?php
}

?>