<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include("home.php")?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white text-center">Form User</h4>
            </div>

            <div class="card-body">
                <?php
                if(isset($_GET["id_user"])){
                    include("connection.php");

                    # mengakses data user dari id user yg terkirim
                    $id_user = $_GET["id_user"];
                    $sql = "select * from user where id_user = '$id_user'";

                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);

                    #konversi hasil query ke bentuk array
                    $user = mysqli_fetch_array($hasil);
                ?>

                <!--untuk edit data user-->
                <form action="proses-user.php" method="post">
                    Nama 
                    <input type="text" name="nama_user" 
                    class="form-control mb-2" required 
                    value="<?=($user["nama_user"])?>"/>

                    Username
                    <input type="text" name="username" 
                    class="form-control mb-2" required 
                    value="<?=($user["username"])?>"/>

                    Password
                    <input type="password" name="password" 
                    class="form-control mb-2"/>

                    Role
                    <select name="role" class="form-control mb-2"
                    required>
                        <option value="<?=$user["role"]?>" selected>
                            <?=$user["role"]?>
                        </option>
                        <option value="Admin">Admin</option>
                        <option value="Kasir">Kasir</option>
                    </select>

                    <button type="submit" 
                    class=" btn btn-success btn-block"
                    name="edit_user">
                        Simpan
                    </button>
                </form>
                <?php
                }else{
                    //untuk insert data
                    ?>
                    <form action="proses-user.php" method="post">
                    Nama 
                    <input type="text" name="nama_user" 
                    class="form-control mb-2" required/>

                    Username
                    <input type="text" name="username" 
                    class="form-control mb-2" required/>

                    Password
                    <input type="password" name="password" 
                    class="form-control mb-2"/>

                    Role
                    <select name="role" class="form-control mb-2"
                    required>
                        <option value="Admin">Admin</option>
                        <option value="Kasir">Kasir</option>
                    </select>

                    <button type="submit" 
                    class=" btn btn-success btn-block"
                    name="simpan_user">
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