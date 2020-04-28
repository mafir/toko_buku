<?php
session_start();
// digunakan sebagai tanda kalau kita akan menggunakan session pada halaman ini
// harus diletkkan pada baris pertama
include("config.php");

// tampung data username dan passwordnya
$username=$_POST["username"];
$password=$_POST["password"];

if(isset($_POST["login_castomer"])){
    $sql = "select * from castomer where username = '$username' and password = '$password'";
    // eksekusi query
    $query = mysqli_query($connect, $sql);
    $jumlah =  mysqli_num_rows($query);
    // digunakan untuk menghitung jumlah data hasil dari query

    if($jumlah > 0){
        // jika jumlah lebih dari nol, artinya terdapat data admin yang sesuai dengan username dan password yang di inputkan
        // ini blok kode jika login berhasil
        $admin = mysqli_fetch_array($query);

        $_SESSION["id_castomer"] = $admin["id_castomer"];
        $_SESSION["nama"] = $admin["nama"];

        header("location:buku.php");
    }else{
        // jika jumlahnya nol, artinya tidak ada data admin yang sesuai dengan username dan password yang diinputkan
        // ini blok kode jika loginnya gagal / salah
        header("location:login_castomer.php");
    }
}

if(isset($_GET["logout"])) {
    session_destroy();
    header("location:login_castomer.php");
}
 ?>