<?php
session_start();
if (!isset($_SESSION["id_castomer"])) {
  header("location:login_castomer.php");
}
// memanggil file config.php agar tidak perlu membuat koneksi baru
include("config.php");
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Toko Buku</title>
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>
     <script type="text/javascript">
       Add = () => {
         document.getElementById('action').value = "insert";
         document.getElementById('id_castomer').value = "";
         document.getElementById('nama').value = "";
         document.getElementById('alamat').value = "";
         document.getElementById('kontak').value = "";
         document.getElementById('username').value = "";
         document.getElementById('password').value = "";
       }

       Edit = (item) => {
         document.getElementById('action').value = "update";
         document.getElementById('id_castomer').value = item.id_customer;
         document.getElementById('nama').value = item.nama;
         document.getElementById('alamat').value = item.alamat;
         document.getElementById('kontak').value = item.kontak;
         document.getElementById('username').value = item.username;
         document.getElementById('password').value = item.password;
       }
     </script>
   </head>
   <body>
     <?php
     // membuat perintah sql utk menampilkan data siswa
     if (isset($_POST["cari"])) {
       // query jika pencarian
       $cari = $_POST["cari"];
       $sql = " select * from castomer where nisn like '%$cari%' or nama like '%$cari%' or kelas like '%$cari%' or jenis_kelamin like '%$cari%'";
     }else {
       // query jika tidak mencari
     $sql = " select * from castomer";
     }


     // eksekusi perintah sql nya
     $query = mysqli_query($connect, $sql);
   ?>
<div class="container">
<nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top">
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
                        <li class="nav-item"><a href="castomer.php" class="nav-link">Castomer</a></li>
                        <li class="nav-item">
                          <a href="proses_login_castomer.php?logout=true" class="nav-link">
                            <?php echo $_SESSION["nama"]; ?>
                            Logout
                          </a>
                        </li>
                    </ul>
            </div>
        </nav>
        <br>
        <br>
        <br>
        <br>
        <br>
  <!-- start card -->
  <div class="card">
    <div class="card-header bg-danger text-white">
      <h4>Data Castomer</h4>
    </div>
    <div class="card-body">
      <form  action="castomer.php" method="post">
        <input type="text" name="cari"
        class="form-control" placeholder="pencarian...">
      </form>
      <table class="table" border="1">
        <thead>
            <tr>
              <th>id_castomer</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Ussername</th>
              <th>Password</th>
              <th>Option</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($query as $castomer): ?>
             <tr>
              <td><?php echo $castomer["id_castomer"];
              //nama "siswa" harus sama yg di database
              ?></td>
              <td><?php echo $castomer["nama"]; ?></td>
              <td><?php echo $castomer["kontak"]; ?></td>
              <td><?php echo $castomer["alamat"]; ?></td>
              <td><?php echo $castomer["username"]; ?></td>
              <td><?php echo $castomer["password"]; ?></td>


              <td>
                <button data-toggle="modal" data-target="#modal_castomer" type="button"
                class="btn btn-sm btn-success" onclick='Edit(<?php echo json_encode($castomer);?>)'>
                 Edit </button>
              <a href="proses_crud_castomer.php?hapus=true&id_castomer=<?php echo $castomer["id_castomer"];?>"
                onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                <button type="button" class="btn btn-sm btn-info">
                hapus
              </button>
              </a>
              </td>
            <?php endforeach; ?>
          </tr>
        </tbody>
      </table>
      <button data-toggle="modal" data-target="#modal_castomer"
      type="button" class="btn btn-sm btn-warning" onclick="Add()">
      Tambah Data
    </button>
    </div>
  </div>
  <!-- end card -->

  <!-- form modal -->
  <div class="modal fade" id="modal_castomer">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses_crud_castomer.php" method="post" enctype="multipart/form-data">
        <div class="modal-header bg-danger text-white">
          <h4>Form Daftar Buku</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" id="action">
          customer
          <input type="number" name="id_castomer" id="id_castomer"
          class="form-control" required />
          Nama
          <input type="text" name="nama" id="nama"
          class="form-control" required />
          Kontak
          <input type="text" name="kontak" id="kontak"
          class="form-control" required />
          Alamat
          <input type="text" name="alamat" id="alamat"
          class="form-control" required />
          Ussername
          <input type="text" name="username" id="username"
          class="form-control" required />
          Password
          <input type="password" name="password" id="password"
          class="form-control" required />


      </div>
      <div class="modal-footer">
        <button type="submit" name="save_castomer" class="btn btn-primary">
          Simpan</button>
      </div>
      </form>
    </div>

  </div>
  </div>
  <!-- end form modal -->
</div>
   </body>
 </html>