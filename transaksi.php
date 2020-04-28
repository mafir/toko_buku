<?php
    session_start();
    include("config.php");
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
    
                document.getElementById('image').src = "image/" + item.image;
            }
        </script>
    
    </head>
    <body>
      <nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top">
          <a href="#">
              <img src="book.png" width="100" alt="">
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
            <div class="card mt-3">
                <div class="card-header bg-warning">
                    <h4>Riwayat Transaksi</h4>
                </div>
                <div class="card-body">
                    <?php
                        $sql = "select * from transaksi t inner join customer c
                        on t.id_customer = c.id_customer where t.id_customer = '".$_SESSION["id_customer"]."' order by t.tgl desc";
                        $query = mysqli_query($connect,$sql);
                    ?>
    
                    <ul class="list-group">
                        <?php foreach($query as $transaksi): ?>
                        <li class="list-group-item mb-4">
                            <h6>ID Transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
                            <h6>Nama Pembeli: <?php echo $transaksi["nama"]; ?></h6>
                            <h6>Tgl. Transaksi: <?php echo $transaksi["tgl"]; ?></h6>
                            <h6>List Barang: </h6>
                            <?php
                                $sql2 = "select * from detail_transaksi d inner join buku b
                                on d.kode_buku = b.kode_buku
                                where d.id_transaksi='".$transaksi["id_transaksi"]."'";
                                $query2 = mysqli_query($connect, $sql2);
                            ?>
    
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0; foreach($query2 as $detail): ?>
                                    <tr>
                                        <td><?php echo $detail["judul"]; ?></td>
                                        <td><?php echo $detail["jumlah"]; ?></td>
                                        <td>Rp <?php echo number_format($detail["harga"]); ?></td>
                                        <td>
                                            Rp <?php echo number_format($detail["harga"] * $detail["jumlah"]); ?>
                                        </td>
                                    </tr>
                                <?php
                                $total += ($detail["harga_beli"] * $detail["jumlah"]);
                                endforeach; ?>
                                </tbody>
                            </table>
                            <h5 class="text-danger">Total: Rp <?php echo number_format($total); ?></h5>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
    </html>