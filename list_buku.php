<?php
session_start();
if(!isset($_SESSION["id_customer"])){
    header("location:login_customer.php");
}
include("config.php");
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Toko Buku</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        Detail = (item) => {
            document.getElementById('kode_buku').value = item.kode_buku;
            document.getElementById('judul').innerHTML = item.judul;
            document.getElementById('penulis').innerHTML = "penulis: " + item.penulis;
            document.getElementById('harga').innerHTML = "harga: " + item.harga;
            document.getElementById('stok').innerHTML = "stok: " + item.stok;
            document.getElementById('jumlah_beli').value = "1";
            document.getElementById('jumlah_beli').max = item.stok;

            document.getElementById('image').src = "image/" + item.image;
        }
    </script>

</head>
<body>
  <nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top">
      <a href="#">
          <img src="book.png" width="90" alt="">
      </a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
          <span class="navbar navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="menu">
          <ul class="navbar-nav">
              <li class="nav-item"><a href="list_buku.php" class="nav-link">Beranda</a></li>
              <li class="nav-item"><a href="transaksi.php" class="nav-link">Order</a></li>
              <li class="nav-item"><a href="cart.php" class="nav-link">Cart (<?php echo count($_SESSION["cart"])?>)</a></li>
              <li class="nav-item"><a href="proses_login_customer.php?logout=true" class="nav-link">
                      <?php echo $_SESSION["nama"];?> Logout</a></li>
          </ul>
      </div>
  </nav>

    <div class="container">
        <?php
            if(isset($_POST["cari"])){
                //query jika mencari
                $cari = $_POST["cari"];
                $sql = "select * from buku where judul like '%$cari%' or penulis like '%$cari%'";
            }else {
                //query jika tidak mencari
                $sql = "select * from buku";
            }

            //eksekusi perintah SQL-nya
            $query = mysqli_query($connect, $sql);
        ?>
        <!-- slide -->
        <div class="carousel slide" data-ride="carousel" id="slide">
            <ul class="carousel-indicators">
                <li data-target="#slide" data-slide-to="0" class="active"></li>
                <li data-target="#slide" data-slide-to="1"></li>
                <li data-target="#slide" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="slide1.jpg" width="100%" height="500" alt="">
                </div>
                <div class="carousel-item">
                    <img src="slide2.jpg" width="100%" height="500" alt="">
                </div>
                <div class="carousel-item">
                    <img src="slide3.jpg" width="100%" height="500" alt="">
                </div>
            </div>

            <a href="#slide" data-slide="prev" class="carousel-control-prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a href="#slide" data-slide="next" class="carousel-control-next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <div></div>
        <!-- start card -->
        <form action="buku.php" method="post">
            <input type="text" name="cari" class="form-control" placeholder="Pencarian...">
        </form>
        <div class="row">
            <?php foreach ($query as $buku): ?>
            <div class="card col-md-4">
                <img src="<?php echo 'image/'.$buku['image']?>" class="card-img-top" alt="Foto Buku" width="200" height="350px" />
                <div class="card-header bg-info text-white">
                    <h4><?php echo $buku["judul"] ?></h4>
                </div>
                <div class="card-body">
                    <h5>Rp <?php echo $buku["harga"] ?></h5>
                    <h5>Stok <?php echo $buku["stok"] ?> </h5>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-success" onclick='Detail(<?php echo json_encode($buku); ?>)' data-toggle="modal" data-target="#largemodal">
                        Info lebih
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- end card -->
    </div>

    <div class="modal fade" id="largemodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4>Info Buku</h4>
                    <span class="close" data-dismiss="modal">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <!-- untuk gambar -->
                            <img style="width:100%; height: auto;" id="image">
                        </div>
                        <div class="col-6">
                            <h4 id="judul"></h4>
                            <h4 id="penulis"></h4>
                            <h4 id="stok"></h4>
                            <h4 id="harga"></h4>

                            <form action="proses_cart.php" method="post">
                                <input type="hidden" name="kode_buku" id="kode_buku">
                                Jumlah Beli
                                <input type="number" name="jumlah_beli" id="jumlah_beli" class="form-control" min="1">
                                <button type="submit" name="add_to_cart" class="btn btn-success">
                                    Tambahkan ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>