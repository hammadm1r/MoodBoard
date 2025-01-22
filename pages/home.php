
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
?>
<div class="container">
    <?php include '../includes/header.php'; ?>

    <!-- Main Content -->
    <h1 class='mt-4'>Welcome to M</span><i class="fa-solid fa-face-smile" style="color: #74C0FC;"></i><i class="fa-solid fa-face-angry" style="color: #d62929;"></i></span>dBoard, <?php echo $_SESSION['username']; ?></h1>


    
    <p>Enter your mood and let AI craft personalized quotes that resonate with your feelings. Whether you're happy, thoughtful, or seeking motivation, we've got you covered.<i class="fa-solid fa-face-smile text-warning"></i></p>

    <!-- Mood Input -->
    <div class="d-flex justify-content-center align-items-center my-4">
    <div class="d-flex align-items-center space-x-2">
        <label for="mood" class="font-weight-bold me-2">Mood:</label>
        <input type="text" id="mood" placeholder="Enter Your Mood" class="form-control" style="width: 200px;" />
        <button type="button" id="submitMood" class="btn btn-primary ms-2">Submit</button>
    </div>
</div>
<div id="suggestions" class="row h-full">
<?php
    if (isset($suggestions) && !empty($suggestions)) {
        foreach ($suggestions as $suggestion) {
            echo "<div class='col-lg-4 col-md-6 col-sm-8 text-center p-2 border'>$suggestion</div>";
        }
    }
    ?>
</div>
<div class="">
<?php include '../includes/footer.php'; ?>
</div>
<script>
    const addHandler = (item, mood) => {
    console.log("Item:", item);
    console.log("Mood:", mood);

    fetch('save_quote.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ quote: item, mood: mood })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Quote saved successfully!');
        } else {
            alert('Failed to save the quote. Try again.');
        }
    })
    .catch(err => console.error('Error:', err));
};
    document.getElementById('submitMood').addEventListener('click', () => {
    const mood = document.getElementById('mood').value.trim();
    if (!mood) {
        alert('Please enter your mood!');
        return;
    }

    const suggestions = document.getElementById('suggestions');
    suggestions.innerHTML = '<p class="text-center">Loading...</p>';

    fetch('process_mood.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mood })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        suggestions.innerHTML = '';
        data.Quotes.forEach(item => {
            // Create suggestion card
            const div = document.createElement('div');
            div.className = 'col-lg-4 col-md-6 col-sm-8 text-center p-2 border';

            // Add inner HTML
            div.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <p>${mood}</p>
                    <button class="btn btn-primary">+</button>
                </div>
                <p>${item}</p>
            `;

            // Add event listener to button
            const button = div.querySelector('button');
            button.addEventListener('click', () => addHandler(item, mood));

            // Append the suggestion to the container
            suggestions.appendChild(div);
        });
    })
    .catch(err => {
        console.error('Error:', err);
        suggestions.innerHTML = '<p class="text-center text-danger">Failed to load suggestions. Please try again later.</p>';
    });
});
</script>

</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-KsvDIEfZAEHWO4C1T6mG2L9Ku46tbj/HUMe1lgmXZSmxWlaAeUpTQ8LKh6TOjFtJ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGtoi9KpK3E5l6b13K8KVpKp1pXA38lJz9uoxRmXA8Cg0TktZn3ka7bylWr" crossorigin="anonymous"></script>
</body>
</html>
