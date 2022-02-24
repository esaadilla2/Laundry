<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
</head>
<body>
<?php include("home.php")?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white text-center">Form Transaksi</h4>
            </div>

            <div class="card-body">
                <form action="proses-transaksi.php" method="post">
                    <!--memilih nama member lewat nama-->
                    Pilih Data Member
                    <select name="id_member" class="form-control mb-2" required>
                    <?php
                    include "connection.php";
                    $sql="select * from member";
                    $hasil= mysqli_query($connect,$sql);
                    while ($member = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?=($member["id_member"])?>">
                            <?=($member["nama_member"])?>
                        </option>
                        <?php
                    }
                    ?>
                    </select>

                    <!--tgl transaksi auto-->
                    Tanggal Transaksi
                    <input type="text" name="tgl"
                    class="form-control mb-2" readonly
                    value="<?=(date("Y-m-d H:i:s"))?>"/>

                    <!--batas waktu-->
                    Batas waktu
                    <input type="date" name="batas_waktu" 
                    class="form-control mb-2">

                    <!--pilih user-->
                    Pilih Data User
                    <select name="id_user" class="form-control mb-2" required>
                    <?php
                    include "connection.php";
                    $sql="select * from user";
                    $hasil= mysqli_query($connect,$sql);
                    while ($user = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?=($user["id_user"])?>">
                            <?=($user["nama_user"])?>
                        </option>
                        <?php
                    }
                    ?>
                    </select>

                    <!--pilih mobil lewat merk mobil-->
                    Pilih Paket
                    <select name="id_paket" class="form-control mb-2" required>
                    <?php
                    include "connection.php";
                    $sql= "select * from paket";
                    $hasil = mysqli_query($connect,$sql);
                    while ($paket = mysqli_fetch_array($hasil)) {
                        ?>
                        <option value="<?=($paket["id_paket"])?>">
                            <?=($paket["jenis"].", Harga = ".$paket["harga"]."/kg")?>
                        </option>
                        <?php
                    }
                    ?>
                    </select>

                    <!--jumlah yang mau di laundry-->
                    Jumlah Laundry
                    <input type="text" name="qty" 
                    class="form-control mb-2">

                    <button type="submit" class="btn btn-success btn-block">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>