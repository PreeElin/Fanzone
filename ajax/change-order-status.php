<?php
include "../config.php";

$status = $_GET['status'];
$oid = $_GET['oid'];

$changeStatus = "UPDATE orders 
                set 
                status = '$status'
                where id = '$oid'";

echo $changeStatus;
if ($mysqli->query($changeStatus)) {
  echo 'Status updated successfully!';
} else {
  echo 'Failed to update the status';
}
?>
