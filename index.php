<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodBoard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">M<span></span><i class="fa-solid fa-face-smile" style="color: #74C0FC;"></i><i class="fa-solid fa-face-angry" style="color: #d62929;"></i></span>dboard</a>
      </div>
    </nav>

    <!-- Welcome Section -->
    <div class="d-flex flex-column align-items-center justify-content-center vh-100 text-center">
      <h1 class="display-4">Welcome to MoodBoard</h1>
      <h6 class="mb-4">Unleash Your Creativity. Share Your Vision. Inspire the World.</h6>
      <p class="mb-5 w-75">
        MoodBoard is your personal canvas where ideas come to life. Whether you're brainstorming, designing, or simply seeking inspiration, MoodBoard offers a platform to:
        <br><br>
        <ul class="list-unstyled">
          <li>Create stunning visual boards for your projects and passions.</li>
          <li>Collaborate with others to bring your ideas to life.</li>
          <li>Discover and explore creative works shared by our vibrant community.</li>
        </ul>
      </p>
      
      <!-- Buttons -->
      <div>
        <a href="pages/login.php" class="btn btn-primary">Log In</a>
        <a href="pages/signup.php" class="btn btn-secondary">Sign Up</a>
      </div>
    </div>
    <?php include(__DIR__ . '/includes/footer.php'); ?>

  </div>
</body>
</html>
