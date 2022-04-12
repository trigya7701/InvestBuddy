<nav class="navbar navbar-expand-lg   navbar-theme ">
    <div class="container-fluid">
        <a class="navbar-brand navbar-content" href="../pages/home.php">InvestBuddy</a>

        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-toggle-btn"><i class="fa-solid fa-bars btn-light"></i></span>
        </button>
        <div class="collapse navbar-collapse navbar-header" id="navbarSupportedContent">



            <form class="d-flex navbar-form" action="../pages/search_startup.php" method="get">
                <div class="input-group input-group-sm mb-6">

                    <input type="text" class="form-control" placeholder="Search Startups" name="query"
                        aria-label="Search Startups" aria-describedby="button-addon2">
                    <button class="btn btn-warning " type="submit" id="button-addon2">Search</button>

                </div>
            </form>


            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active navbar-content" aria-current="page" href="../Pages/home.php">Home</a>

                </li>


                <li class="nav-item">
                    <a class="nav-link navbar-content" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight" href="">Find Investor</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar-content" href="../Pages/about.php">About Us</a>
                </li>


                <?php

                if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

                    echo ' <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle navbar-content " href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Hi ,' . $_SESSION['user_email'] . '
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light mx-4 px-2" aria-labelledby="navbarLightDropdownMenuLink">
                      <li><a class="dropdown-item" href="../pages/profile.php">My Profile</a></li>
                      <li><a class="dropdown-item" href="../pages/logout.php">Logout</a></li>
                    
                    </ul>
                  </li>';
                } else {
                    echo ' <li class="nav-item">
                        <a class="nav-link navbar-content" href="../pages/signin.php">Login</a>
                        </li>';
                }

                ?>






            </ul>

        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Offcanvas right</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="../pages/search_investor.php" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="query" placeholder="Find Investor" aria-label="Recipient's username"
                    aria-describedby="button-addon2">
                <button class="btn btn-outline-info" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
    </div>
</div>