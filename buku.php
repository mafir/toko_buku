<?php

// memanggil file config.php
// agar tidak perlu membuat koneksi baru

include("config.php");
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>data buku</title>
     <link rel="stylesheet" href="assets/css/bootstrap.css">
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script type="text/javascript">
     Add = () => {
       document.getElementById('action').value = "insert";
       document.getElementById('kode_buku').value = "";
       document.getElementById('judul').value = "";
       document.getElementById('penulis').value = "";
       document.getElementById('tahun').value = "";
       document.getElementById('harga').value = "";
       document.getElementById('stok').value = "";
     }

     edit = (item) => {
       document.getElementById('action').value = "update";
       document.getElementById('kode_buku').value = item.kode_buku;
       document.getElementById('judul').value = item.judul;
       document.getElementById('penulis').value = item.penulis;
       document.getElementById('tahun').value = item.tahun;
       document.getElementById('harga').value = item.harga;
       document.getElementById('stok').value = item.stok;

     }
     </script>
   </head>
   <body>
     <?php

     if (isset($_POST["cari"])) {
       // query jika pencarian
       $cari = $_POST["cari"];
       $sql = "select * from buku where kode_buku like '%$cari' or judul like
       '%$cari%' or penulis like '%$cari%' or tahun like '%$cari%' or harga like
       '%$cari%' or stok like '%$cari%'";
     }else{
       // query jika tidak mencari
       $sql = "select * from buku";
     }
     // membuat perintah SQL untuk menampilkan data siswa

     // eksekusi perintah SQL nya
     $query = mysqli_query($connect, $sql);
      ?>
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

      <div class="container">
      
        <nav class="navbar navbar-expand-md bg-success navbar-dark fixed-top">
            <a href="#">
                <img src="book.png" width="90" alt="">
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                <span class="navbar navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="buku.php" class="nav-link">Beranda</a></li>
                        <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                        <li class="nav-item"><a href="customer.php" class="nav-link">Customer</a></li>
                    </ul>
            </div>
        </nav>
        <br>
        <div class="card">
          <div class="card-header bg-info text-white">
            <h4>Data buku</h4>
          </div>
          <div class="card-body">
            <form action="buku.php" method="post">
              <input type="text" name="cari" class="form-control"
              placeholder="pencarian...">

            </form>
            <table class="table" border="1">
              <thead>
                <tr>
                  <th>kode_buku</th>
                  <th>judul</th>
                  <th>penulis</th>
                  <th>tahun</th>
                  <th>harga</th>
                  <th>stok</th>
                  <th>image</th>
                  <th>option</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query as $buku): ?>
                  <tr>
                    <td><?php echo $buku ["kode_buku"]; ?></td>
                    <td><?php echo $buku ["judul"]; ?></td>
                    <td><?php echo $buku ["penulis"]; ?></td>
                    <td><?php echo $buku ["tahun"]; ?></td>
                    <td><?php echo $buku ["harga"]; ?></td>
                    <td><?php echo $buku ["stok"]; ?></td>
                    <td>
                      <img src="<?php echo 'image/'.$buku['image']; ?>" alt="foto buku"
                      width="200" />
                    </td>
                    <td>
                      <button data-toggle="modal" data-target="#modal_buku"
                      type="button" class="btn btn-sm btn-info"
                      onclick='edit(<?php echo json_encode($buku); ?>)'>
                        edit
                      </button>
                      <a href="proses_crud_buku.php?hapus=true&kode_buku=<?php echo $buku["kode_buku"]; ?>"
                        onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                        <button type="button" class="btn btn-sm btn-danger">
                          hapus
                        </button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <button data-toggle="modal" data-target="#modal_buku" type="button"
            class="btn btn-sm btn-success"
            onclick="Add()">
              tambah data
            </button>
          </div>
        </div>
        <!-- end card -->

        <!-- form modal -->
        <div class="modal fade" id="modal_buku">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="proses_crud_buku.php"
              method="post" enctype="multipart/form-data">
                <div class="modal-header bg-danger text-white">
                  <h4>Form buku</h4>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="action" id="action">
                  kode_buku
                  <input type="number" name="kode_buku" id="kode_buku"
                  class="form-control" required />
                  judul
                  <input type="text" name="judul" id="judul"
                  class="form-control" required />
                  penulis
                  <input type="text" name="penulis" id="penulis"
                  class="form-control" required />
                  tahun
                  <input type="text" name="tahun" id="tahun"
                  class="form-control" required />
                  harga
                  <input type="text" name="harga" id="harga"
                  class="form-control" required />
                  stok
                  <input type="text" name="stok" id="stok"
                  class="form-control" required />
                  image
                  <input type="file" name="image" id="image"
                  class="form-control">
                </div>
                <div class="modal-footer">
                  <button type="submit" name="save_buku" class="btn btn-primary">
                  simpan
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end form modal -->
      </div>
   </body>
 </html>