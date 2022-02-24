<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Paket</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include("home.php")?>
    <div class="container">
       <div class="card">
           <div class="card-header bg-dark">
               <h4 class="text-white">
                   Form Paket
               </h4>
           </div>

           <div class="card-body">
               <?php
               if (isset($_GET["id_paket"])) {
                   # form utk edit
                   $id_paket = $_GET["id_paket"];
                   $sql = "select * from paket
                   where id_paket = '$id_paket'";

                   include "connection.php";
                   # eksekusi SQL
                   $hasil = mysqli_query($connect, $sql);

                   # konversi ke array
                   $paket = mysqli_fetch_array($hasil);
                   ?>
                   <form action="proses-paket.php" method="post"
                    enctype="multipart/form-data">

                   Jenis
                   <select name="jenis" class="form-control mb-2"
                   required>
                        <option value="<?=$paket["jenis"]?>" selected>
                            <?=$paket["jenis"]?>
                        </option>
                        <option value="kiloan">Kiloan</option>
                        <option value="selimut">Selimut</option>
                        <option value="bed_cover">Bed Cover</option>
                        <option value="kaos">Kaos</option>
                   </select>

                   Harga
                   <input type="text" name="harga"
                   class="form-control mb-2" required
                   value="<?=$paket["harga"]?>">

                   Image <br>
                   <img src="image/<?=$paket["image"]?>" 
                   width="300" />
                   <input type="file" name="image"
                   class="form-control mb-2">

                   <button type="submit" 
                   class="btn btn-info btn-block" 
                   name="update_paket">
                   Simpan
                   </button>
                    </form>
                   <?php
               } else {
                   # form utk insert
                   ?>
                   <form action="proses-paket.php" method="post"
                    enctype="multipart/form-data">

                   Jenis
                   <select name="jenis" class="form-control mb-2"
                   required>
                        <option value="kiloan">Kiloan</option>
                        <option value="selimut">Selimut</option>
                        <option value="bed_cover">Bed Cover</option>
                        <option value="kaos">Kaos</option>
                   </select>

                   Harga
                   <input type="text" name="harga"
                   class="form-control mb-2" required>

                   Image
                   <input type="file" name="image"
                   class="form-control mb-2" required>

                   <button type="submit" 
                   class="btn btn-info btn-block" name="simpan_paket">
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