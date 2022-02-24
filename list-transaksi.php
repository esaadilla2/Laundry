<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penyewaan</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("home.php"); ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-white text-center">Daftar Transaksi</h4>
            </div>
        <div class="card-body">
            <ul class="list-group">
                <?php
                include "connection.php";
                $sql = "select transaksi.*, 
                member.*, user.*, transaksi.id_transaksi,
                transaksi.tgl, transaksi.batas_waktu, transaksi.total
                from
                transaksi inner join member
                on member.id_member = transaksi.id_member
                inner join user
                on transaksi.id_user = user.id_user
                order by tgl desc";

                $hasil = mysqli_query($connect, $sql);
                while ($transaksi = mysqli_fetch_array($hasil)) {
                    ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <small class="text-info">ID Transaksi</small>
                                <h5><?=($transaksi["id_transaksi"])?></h5>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <small class="text-info">Member</small>
                                <h5><?=($transaksi["nama_member"])?></h5>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <small class="text-info">User</small>
                                <h5><?=($transaksi["nama_user"])?></h5>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <small class="text-info">Tanggal Transaksi</small>
                                <h5><?=($transaksi["tgl"])?></h5>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <small class="text-info">Batas Waktu</small>
                                <h5><?=($transaksi["batas_waktu"])?></h5>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <small class="text-info">Tanggal Bayar</small>
                                <h5><?=($transaksi["tgl_bayar"])?></h5>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <small class="text-info">Paket yang dipilih</small>
                            <?php 
                            $id_transaksi = $transaksi["id_transaksi"];
                            $sql = "select * from transaksi
                            join detil_transaksi
                            on transaksi.id_transaksi = detil_transaksi.id_transaksi
                            join paket
                            on detil_transaksi.id_paket = paket.id_paket
                            where transaksi.id_transaksi = '$id_transaksi'";

                            // error yang terjadi disini :
                            // pertama, kita perlu cek klo suatu query yang kita jalankan
                            // berhasil atau tidak dengan mysqli_error($conn)
                            // dan ternyata ada kesalahan di sql kita yg merupakan kesalahan kedua

                            // sql di atas ada yang ambigu di whare statement yg akhir,
                            // kita perlu spesifikkan "id_transaksi" yg dimaksud itu
                            // milik table "transaksi" atau "detail-transaksi" karena
                            // kita melakukan join terhadap table yang memiliki nama kolom yang sama

                            $pack_result = mysqli_query($connect, $sql);
                            if (mysqli_error($connect)) {
                                var_dump(mysqli_error($connect));
                                exit(1);
                            }

                            while ($paket = mysqli_fetch_array($pack_result)) {
                            ?>
                                <h5><?=($paket["jenis"])?></h5>
                                <?php 
                            }    
                            ?>
                            </div>-->
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                    <h6>
                                        <div class="badge badge-success">
                                        Total Bayar : Rp <?=(number_format($transaksi["total"],2))?>
                                        </div>
                                    </h6>  
                                    
                                    <h6>
                                        Status :
                                        <!--
                                            Pengecekkan nya harunya hanya berupa tanggal 0000-00-00
                                            bukan dengan waktu 0000-00-00 00:00:00
                                         -->
                                        <?php if ($transaksi["tgl_bayar"] == "0000-00-00" ){?>
                                            <div class="badge badge-warning mb-2">
                                                Proses 
                                            </div>
                                            <br>
                                            <a href="proses-bayar.php?id_transaksi=<?=($transaksi["id_transaksi"])?>"
                                            onclick="return confirm('Yakin Udah Selesai? Awas lho salah pencet')">
                                            <button class="btn btn-sm btn-success">
                                                Diambil
                                            </button>
                                            </a>
                                        <?php } else {?>
                                            <div class="badge badge-success">
                                                Selesai
                                            </div>
                                        <?php } ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php 
                    } 
                    ?>
            </ul>
        </div>
    </div>
</body>
</html>