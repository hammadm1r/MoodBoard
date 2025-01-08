
<?php
ini_set('session.save_path', 'C:/xampp/tmp');
session_start();
function dbConnect()
{
    global $conn;
    $dbServer = "127.0.0.1";
    $username = "hammadm1r";
    $password = "@Strongpass123";
    $dbName = "moodboard";
    $conn = new mysqli($dbServer, $username, $password, $dbName);

    if ($conn->ping()) {
        // printf ("Our connection is ok!\n");
    } else {
        printf("Error: %s\n", $conn->error);
    }

    if ($conn->connect_error) {
        die("Error: " . $conn->connect_error);
    }
    // echo '<h1 style="color: green;">Connected to DB!</h1>';
}

function redirect_to($location)
{
    header('Location:' . $location);
}

function is_auth()
{
    return isset($_SESSION['userid']);
}

function check_auth()
{
    if (!is_auth()) {
        redirect_to("/login.php?logged_in=false");
    }
}