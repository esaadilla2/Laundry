<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Member</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include("home.php")?>
<div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white text-center">Form Member</h4>
            </div>

            <div class="card-body">
                <?php
                if(isset($_GET["id_member"])){
                    include("connection.php");

                    # mengakses data member dari id member yg terkirim
                    $id = $_GET["id_member"];
                    $sql = "select * from member where id_member = '$id_member'";

                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);

                    #konversi hasil query ke bentuk array
                    $member = mysqli_fetch_array($hasil);
                ?>
                <!--untuk edit data-->
                <form action="proses-member.php" method="post">
                    Nama 
                    <input type="text" name="nama_member" 
                    class="form-control mb-2" required 
                    value="<?=($member["nama_member"])?>"/>

                    Alamat
                    <input type="text" name="alamat" 
                    class="form-control mb-2" required 
                    value="<?=($member["alamat"])?>"/>

                    Jenis Kelamin
                    <select name="jenis_kelamin" class="form-control mb-2"
                    required>
                        <option value="<?=$member["jenis_kelamin"]?>" selected>
                            <?=$member["jenis_kelamin"]?>
                        </option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    Telepon
                    <input type="text" name="tlp" 
                    class="form-control mb-2" required 
                    value="<?=($member["tlp"])?>"/>

                    <button type="submit" 
                    class=" btn btn-success btn-block"
                    name="edit_member">
                        Simpan
                    </button>
                </form>
                <?php
                }else{
                    //jk tidak maka digunakan untuk insert data
                    ?>
                    <form action="proses-member.php" method="post">
                    Nama 
                    <input type="text" name="nama_member" 
                    class="form-control mb-2" required/>

                    Alamat
                    <input type="text" name="alamat" 
                    class="form-control mb-2" required/>

                    Jenis Kelamin
                    <select name="jenis_kelamin" class="form-control mb-2"
                    required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    Telepon
                    <input type="text" name="tlp" 
                    class="form-control mb-2" required/>

                    <button type="submit" 
                    class=" btn btn-success btn-block"
                    name="simpan_member">
                        Simpan
                    </button>
                </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>