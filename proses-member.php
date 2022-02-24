<?php
include ("connection.php");
if (isset($_POST["simpan_member"])) {
    # data input dari user
    $nama_member = $_POST["nama_member"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tlp = $_POST["tlp"];

    // insert ke tabel member
    $sql = "insert into member values
    ('','$nama_member','$alamat','$jenis_kelamin','$tlp')";

    //eksekusi perintah sql
    if (mysqli_query($connect, $sql)){
        //menuju halaman list pelanggan
        header("location:list-member.php");
    }else {
        //gagal
        echo mysqli_error($connect);
    }
}
else if (isset($_POST["edit_member"])) {
    # data yg akan diupdate
    $nama_member = $_POST["nama_member"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tlp = $_POST["tlp"];

    $sql = "update member set nama_member = '$nama_member', alamat = '$alamat', 
    jenis_kelamin = '$jenis_kelamin' tlp = '$tlp' where id_member = '$id_member'";
    # eksekusi perintah SQL
    mysqli_query($connect, $sql);

    # direct / dikembalikan ke halaman list pelanggan
    header("location:list-member.php");
    }   
?>