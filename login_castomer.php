<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Castomer</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container" c>
      <div class="card">
        <div class="card-header" >
          <h4>Login Castomer</h4>
        </div>
        <div class="card-body">
          <form action="proses_login_castomer.php" method="post">
            Username
            <input type="text" name="username" class="form-control" required />
            Password
            <input type="text" name="password" class="form-control" required />
            <button type="submit" name="login_castomer" class="btn btn-block btn-primary">
              Login
            </button>
              </form>

        </div>
      </div>
    </div>
  </body>
</html>