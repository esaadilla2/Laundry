<?php
include "connection.php";

$id_transaksi = $_GET["id_transaksi"];
$tgl_bayar = date("Y-m-d H:i:s");

$sql = "update transaksi set tgl_bayar = '$tgl_bayar' where id_transaksi = '$id_transaksi'";

if (mysqli_query($connect, $sql)) {
    # jika berhasil insert ke tabel sewa
    header("location:list-transaksi.php");
}else{
    # jia gagal insert tabel sewa
    echo mysqli_error($connect);
}
?>