<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>E-commerce Login Page</title>
</head>
<body>
    <!-- first child-->
    <div class="d-flex justify-content-center my-5">
  <div class="card shadow-lg p-3 w-100" style="max-width: 600px; border-radius: 20px;">
    <div class="card-body text-center">
      <h5 class="card-title mb-4">Login Page</h5>
      <form action="http://localhost/E-commerce1/Includes/login.php" method="POST">
        <div class="d-flex align-items-center mb-3">
          <label for="gmail" class="me-3 mb-0" style="width: 130px;">Gmail</label>
          <input type="email" class="form-control" id="gmail" placeholder="user@gmail.com" name="gmail" required>
        </div>
        <div class="d-flex align-items-center mb-3">
          <label for="password" class="me-3 mb-0" style="width: 130px;">Password</label>
          <input type="password" id="password" class="form-control" name="password" placeholder="••••••••" required>
        </div>
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary w-100" name="login-submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

    <!-- Bootstrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>