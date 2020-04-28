<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>login admin</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="">
      <div class="">
        <div class="card-header">
          <h4>Login Admid</h4>
        </div>
        <div class="card-body">
          <form action="prosses_login_admin.php" method="post">
            Username
            <input type="text" name="username" class="form-control" required />
            Password
            <input type="password" name="password" class="form-control" required />
            <button type="submit" name="login_admin" class="btn btn-block btn primary">
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
