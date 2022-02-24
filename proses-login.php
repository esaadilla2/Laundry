<?php
session_start();
include "connection.php";
# session -> tempat penyimpanan data di sisi server yg dapat diakses seceara global
# pada halaman web yang membutuhkan

if (isset($_POST["login"])) {
    # menampung data username dan password
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    # ambil data petugas sesuai username dan password
    $sql = "select * from user where
    username= '$username' and password = '$password'";
    $hasil = mysqli_query($connect, $sql);

    # cek hasil query
    # mysqli_num_rows -> mengambil jumlah baris hasil query di tabel
    if (mysqli_num_rows($hasil)> 0) {
        # login berhasil apabila num rows lebih dari 0
        # data disimpan di dalam session
        $karyawan = mysqli_fetch_array($hasil);
        $_SESSION["user"] = $user;
        header("location:list-paket.php");
    }else {
        # login gagal
        echo "<script>alert ('Username atau password yang anda masukkan salah'); 
        location.href='login.php'</script>";
    }
}
?>