<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include("home.php"); ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white text-center">Daftar Member</h4>
            </div>

            <div class="card-body">
                <!--kotak pencarian data member-->
                <form action="list-member.php" method="get">
                    <input type="text" name="search" 
                    class="form-control mb-2"
                    placeholder="Masukkan Keyword" required/>
                </form>
                <ul class="list-group">
                    <?php
                    include("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pada saat load halaman ini
                        # akan mengecek apakah ada data dengan method 
                        # get yang bernama search

                        $search = $_GET["search"];
                        $sql = "select * from pelanggan where id_member like '%$search%'
                        or nama_member like '%$search%'
                        or alamat like '%$search%'
                        or jenis_kelamin like '%$search%'  
                        or tlp like '%$search%' ";
                    }else{
                        $sql = "select * from member";
                    }

                    //eksekusi perintah sql
                    $query = mysqli_query ($connect, $sql);
                    while($member = mysqli_fetch_array($query)) { ?>

                    <li class="list-group-item">
                        <div class="row">
                            <!--bagian data member-->
                            <div class="col-lg-8 col-md-10">
                                <h5>Nama : <?php echo $member["nama_member"] ?></h5>
                                <h6>Id : <?php echo $member["id_member"] ?></h6>
                                <h6>Alamat: <?php echo $member["alamat"] ?></h6>
                                <h6>Jenis kelamin : <?=$member["jenis_kelamin"]?></h6>
                                <h6>Kontak: <?php echo $member["tlp"] ?></h6>
                            </div>
                            <!--bagian tombol-->
                            <div class="col-lg-4 col-md-2">
                            <a href="form-member.php?id_member=<?=$member["id_member"]?>">
                                <button class="btn btn-info btn-block">
                                    Edit
                                </button>
                                </a>
                                <div class="card-footer">
                                    <a href="delete-member.php?id_member=<?=$member["id_member"]?>"
                                    onClick="return confirm('Apakah Anda Yakin?')">
                                </div>
                                <button class="btn btn-block btn-danger">
                                    Hapus
                                </button>
                                    </a>
                            </div>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                    
                </ul>
            </div>

            <div class="card-footer">
                <a href="form-member.php">
                    <button class="btn btn-success">Tambah Data Member</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>