<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            M<span></span><i class="fa-solid fa-face-smile" style="color: #74C0FC;"></i><i class="fa-solid fa-face-angry" style="color: #d62929;"></i></span>dboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                // Get the current page
                $currentPage = basename($_SERVER['PHP_SELF']);

                // Define the menu items
                $menuItems = [
                    "home.php" => "Home",
                    "favorite_quotes.php" => "Favorite Quotes",
                    "logout.php" => "Logout"
                ];

                // Loop through the menu items and check if they match the current page
                foreach ($menuItems as $page => $label) {
                    $activeClass = ($currentPage === $page) ? 'active' : '';
                    echo "<li class='nav-item'>
                              <a class='nav-link $activeClass' href='$page'>$label</a>
                          </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
