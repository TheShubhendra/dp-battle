<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>--->

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
        <span style="font-size:90%;"><?php 
        echo $_SESSION["name"];
        ?></span></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
              <li class="navbar-iten">
                <a class="nav-link" href="index.php">Home</a>
              </li>
                <li class="nav-item">
                    <a href="create.php" class="nav-link">Create Battle</a>
                </li>
                <li class="nav-item">
                    <a href="viewbattle.php" class="nav-link">View Battle</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>

    </nav>
