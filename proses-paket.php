<?php
include "connection.php";
if (isset($_POST["simpan_paket"])) {
    # menampung data yg dikirim ke dalam variable
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];
    $image = $_POST["image"];

    # manage upload file
    $fileName = $_FILES["image"]["name"]; // file name
    $extension = pathinfo($_FILES["image"]["name"]);
    $ext = $extension["extension"]; // eksetensi file

    $image = time()."-".$fileName;
    
    # proses upload
    $folderName = "image/$image";
    if (move_uploaded_file($_FILES["image"]["tmp_name"],$folderName)) {
        # proses insert data ke tabel mobil
        $sql = "insert into paket values
        ('','$jenis','$harga','$image')";

        # eksekusi perintah SQL
        mysqli_query($connect, $sql);

        echo "Tambah data mobil berhasil";
        # direct ke halaman list mobil
        header("location:list-paket.php");
    }
    else{
        echo "Upload file gagal";
    }

}
elseif (isset($_POST["update_paket"])) {
    # menampung data yg dikirim ke dalam variable
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

    # jika update data beserta gambar
    if (!empty($_FILES["image"]["name"])) {
        # ambil data nama file yg akan di hapus
        $sql = "select * from paket where id_paket='$id_paket'";
        $hasil = mysqli_query($connect, $sql);
        $paket = mysqli_fetch_array($hasil);
        $oldFileName = $paket["image"];

        # membuat path file yg lama
        $path = "image/$oldFileName";

        # cek eksistensi file yg lama
        if (file_exists($path)) {
            # hapus file yg lama
            unlink($path);
        }

        # membuat file name baru
        $image = time()."-".$_FILES["image"]["name"];
        $folder = "image/$image";

        # proses upload file yg baru
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $folder)) {
            $sql = "update paket set
            jenis =' $jenis'
            harga = '$harga', 
            image='$image'
            where id_paket = '$id_paket'";
              
            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-paket.php");
            } else {
                # jika update gagal
                echo mysqli_error($connect);
            }
            
        }
    }

    # jika update data saja
    else {
        $sql = "update paket set
        jenis =' $jenis'
        harga = '$harga'
        where id_paket = '$id_paket'";

            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-paket.php");
            } else {
                # jika update gagal
                echo mysqli_error($connect);
            }
    }
}

elseif (isset($_GET["id_paket"])) {
    $id_paket = $_GET["id_paket"];
    # ambil data dari tabel paket sesuai id yg dikirim
    $sql = "select * from paket where id_paket = '$id_paket'";
    $hasil = mysqli_query($connect, $sql);
    $paket = mysqli_fetch_array($hasil);
    
    # ambil data file name yg dihapus
    $oldFileName = $paket["image"];

    # membuat path file yg lama
    $path = "image/$oldFileName";

    # hapus file yg ada di folder
    # cek eksistensi file yg lama
    if (file_exists($path)) {
        # hapus file yg lama
        unlink($path);
    }

    # hapus data yg ada di tabel mobil
    $sql = "delete from paket where id_paket = '$id_paket'";
    if (mysqli_query($connect, $sql)) {
        header("location:list-paket.php");
    } else {
        mysqli_error($connect);
    } 
}
?>