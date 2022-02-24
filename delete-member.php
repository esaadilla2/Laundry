<?php
include("connection.php");

$id = $_GET['id'];

$sql = "delete from member where id_member = '".$id_member."'" ;

$result = mysqli_query($connect, $sql);

if ($result) {
    header ("location:list-member.php");
} else {
    printf ('Gagal'.mysqli_error($connect));
    exit();
}
?>