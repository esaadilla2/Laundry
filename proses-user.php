<?php
include ("connection.php");
if (isset($_POST["simpan_user"])) {
    # data input dari user
    $nama_user = $_POST["nama_user"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    $role = $_POST["role"];

    // insert ke tabel karyawan
    $sql = "insert into user values
    ('','$nama_user','$username','$password','$role')";

    //eksekusi perintah sql
    if (mysqli_query($connect, $sql)){
        //menuju halaman list karyawan
        header("location:list-user.php");
    }else {
        //gagal
        echo mysqli_error($connect);
    }
}
else if (isset($_POST["edit_user"])) {
    # data yg akan diupdate
    $nama_user = $_POST["nama_user"];
    $username = $_POST["username"];
    $role = $_POST["role"];
    
    if (empty($_POST["password"])) {
        #pass tdk diedit 
        $sql = "update user set nama_user = '$nama_user', 
        username = '$username', role = '$role' where id_user = '$id_user'";
    }else {
        # pass diedit
        $password = sha1($_POST["password"]);
        $sql = "update user set nama_user = '$nama_user',
        username = '$username', password = '$password', role = '$role'";
    }
    # eksekusi perintah sql
    if(mysqli_query($connect, $sql)){
        header("location:list-user.php");
    }else {
        //gagal
        echo mysqli_error($connect);
    }
}
?>