<nav class="navbar navbar-expand-md navbar-dark bg-primary justify-content-center">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <a class="navbar-brand" href="<?php echo ROOT; ?>">Weelde real estate</a>
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item"><a class="nav-link <?php //echo (url == "test01") ? 'active' : ''; ?>" href="?url=test01">Test 01</a></li> -->
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <?php if (!isset($_SESSION["logged_in"])) { ?>
                <li class="nav-item"><a class="nav-link <?php echo (url == "login") ? 'active' : ''; ?>" href="?url=login">Login</a></li>
            <?php } else if (isset($_SESSION["logged_in"])){ ?>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo $_SESSION['logged_in']['first_name']. ' ' . $_SESSION['logged_in']['last_name']; ?> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="?url=dashboard">Dashboard</a>
                        <a class="dropdown-item" href="?url=logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                        <form id="logout-form" action="?url=logout" method="POST" style="display: none;"></form>
                    </div>
                </li>
            <?php } ?>

        </ul>
    </div>
</nav> 