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
<?php
  require_once "functions.php";
  dbConnect();
  ?>
<div class="container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">M<span></span><i class="fa-solid fa-face-smile" style="color: #74C0FC;"></i><i class="fa-solid fa-face-angry" style="color: #d62929;"></i></span>dboard</a>
        </div>
    </nav>
    
    <!-- Login Form -->
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 300px;">
            <h3 class="text-center mb-4">Log In</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="login-form">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" name="login" value="1" class="btn btn-primary w-100">Log In</button>
</form>

<?php  
dbConnect();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Secure query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $userres = $stmt->get_result();

    if ($userres && $userres->num_rows > 0) {
        $userData = $userres->fetch_assoc();
        $db_pass = $userData['password'];

        if (password_verify($password, $db_pass)) {
            echo "<div class='alert alert-success mt-3'>Login successful</div>";
            echo "$userData";
            $_SESSION['username'] = $userData['username'];
            $_SESSION['userid'] = $userData['id']; ?>
            <script>
            location.replace("home.php");
            </script>
            <?php
        } else {
            echo "<div class='alert alert-danger mt-3'>Incorrect password</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-3'>User does not exist</div>";
    }
}
?>

        </div>
    </div>  

</div> 
<?php include '../includes/footer.php'; ?>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-KsvDIEfZAEHWO4C1T6mG2L9Ku46tbj/HUMe1lgmXZSmxWlaAeUpTQ8LKh6TOjFtJ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGtoi9KpK3E5l6b13K8KVpKp1pXA38lJz9uoxRmXA8Cg0TktZn3ka7bylWr" crossorigin="anonymous"></script>
</body>
</html>
