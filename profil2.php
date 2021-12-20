<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo'<script>window.location="login2.php"</script>';
    }

    $quer = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC" );
    $o = mysqli_fetch_object($quer);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User | BokingFutsal</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="home.php">Futsal Dream League Soccer</a></h1>
            <ul>
                <li><a href="home.php">Dashboard</a></li>
                <li><a href="profil2.php">Profil</a></li>
                <li><a href="boking-lapangan.php">Boking Lapangan</a></li>
                <li><a href="keluar2.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $o->category_name ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $o->category_telp ?>"required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $o->category_addres ?>"required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $o->email ?>"required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama   = ucwords($_POST['nama']);
                        $hp     = $_POST['hp'];
                        $alamat = ucwords($_POST['alamat']);
                        $email  = $_POST['email'];

                        $update = mysqli_query($conn,"UPDATE tb_category SET
                                    category_name = '".$nama."',
                                    category_telp = '".$hp."',
                                    category_addres = '".$alamat."',
                                    email = '".$email."'
                                    WHERE category_id = '".$o->category_id."' ");
                        if($update){
                            echo'<script>alert("Ubah Data Berhasil")</script>';
                            echo'<script>window.location="profil2.php"</script>';
                        }else{
                            echo'gagal'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Pasword" class="btn">
                </form>
                <?php
                    if(isset($_POST['ubah_password'])){
                        $pass1   = $_POST['pass1'];
                        $pass2   = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo'<script>alert("Konfirmasi Password Baru tidak sesuai!")</script>';
                        }else{
                            $u_pass = mysqli_query($conn,"UPDATE tb_category SET
                                    password = '".$pass1."'
                                    WHERE category_id = '".$o->category_id."' ");
                            if($u_pass){
                                echo'<script>alert("Ubah Data Berhasil")</script>';
                                echo'<script>window.location="profil2.php"</script>';
                            }else{
                                echo'gagal'.mysqli_error($conn);
                            }
                        }                       
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- content -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2021 - Boking Futsal - </small>
        </div>
    </footer>
</body>
</html>