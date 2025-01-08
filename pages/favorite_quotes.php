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
check_auth();
$userId = $_SESSION['userid'];  // Assuming you store the user ID in session
$query = "SELECT * FROM quotes WHERE user_id = ?"; // Adjust according to your database schema
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container">
<?php include '../includes/header.php'; ?>
<div class="container mt-4">
    <div class="text-center">
        <h2>Favorite Quotes</h2>
    </div>

    <?php if ($result->num_rows > 0): ?>
    <div class="mt-4 row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-lg-4 col-md-6 col-sm-8 text-center p-2 border d-flex flex-column align-items-center">
                <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                    <p class="mb-0">  Mood: <?php echo htmlspecialchars($row['mood']); ?></p>
                </div>
                <p><?php echo htmlspecialchars($row['quote']); ?></p>
                <footer class="blockquote-footer">
                  Saved At: <?php echo htmlspecialchars($row['saved_at']); ?> </footer>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p class="text-center mt-4">You don't have any favorite quotes yet.</p>
<?php endif; ?>
<?php include '../includes/footer.php'; ?>
</div>
</body>
</html>