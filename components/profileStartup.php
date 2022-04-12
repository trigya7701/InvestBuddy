<?php
include_once('../pages/db_connect.php');

$user_id = $_SESSION['user_id'];
$email_id = $_SESSION['user_email'];

mysqli_begin_transaction($conn);
mysqli_autocommit($conn, FALSE);
try {
    $transaction = true;

    $sqlSelectStartup = "SELECT * FROM `startups` WHERE startup_email='$email_id'";
    $resultSelectStartup = mysqli_query($conn, $sqlSelectStartup) ?: throw new Exception('Query Failed');

    $rowSelectStartup = mysqli_fetch_assoc($resultSelectStartup) ?: throw new Exception('Query Failed');



    mysqli_commit($conn);
} catch (\Throwable $th) {
    //throw $th;

    mysqli_rollback($conn);
    echo '<div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
               Something went wrong !! Please try again.
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>';
}



?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal1'])) {

    $website = $_POST['website'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];

    $founder = $_POST['founder'];
    $founded_in = $_POST['founded_in'];
    $revenue = $_POST['revenue'];
    $net_profit = $_POST['net_profit'];
    $company_size = $_POST['company_size'];
    $recent_funding = $_POST['recent_funding'];




    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {

        $sqlUpdateStartup = "UPDATE `startups` SET `startup_linkedin`='$linkedin',
                            `startup_twitter`='$twitter',`startup_facebook`='$facebook',
                            `startup_instagram`='$instagram',`startup_website`='$website',
                            `startup_founder`='$founder',`startup_founded_in`='$founded_in',
                            `startup_revenue`='$revenue',`startup_net_profit`='$net_profit',
                            `startup_size`='$company_size',`startup_recent_funding`='$recent_funding' 
                            WHERE`startup_email`='$email_id'";

        $resultUpdateStartup = mysqli_query($conn, $sqlUpdateStartup) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        // echo $th;
        echo '<div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                      <div class="toast-body">
                       Something went wrong !! Please try again.
                      </div>
                      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                  </div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal2'])) {

    $company_name = $_POST['company_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $valuation = $_POST['valuation'];






    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {

        $sqlUpdateStartup2 = "UPDATE `startups` SET `startup_name`='$company_name',
                            `startup_phone`='$phone',`startup_address`='$address',
                            `startup_valuation`='$valuation'
                            WHERE`startup_email`='$email_id'";

        $resultUpdateStartup2 = mysqli_query($conn, $sqlUpdateStartup2) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
        echo '<div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                      <div class="toast-body">
                       Something went wrong !! Please try again.
                      </div>
                      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                  </div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal3'])) {

    $about = $_POST['about'];

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {
        $about = mysqli_real_escape_string($conn, $about);

        $sqlUpdateStartup3 = "UPDATE `startups` SET `startup_about`='$about'
                           WHERE`startup_email`='$email_id'";


        $resultUpdateStartup3 = mysqli_query($conn, $sqlUpdateStartup3) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        echo $th;
        echo '<div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                      <div class="toast-body">
                       Something went wrong !! Please try again.
                      </div>
                      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                  </div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal4'])) {

    $history = $_POST['history'];

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {
        $history = mysqli_real_escape_string($conn, $history);

        $sqlUpdateStartup4 = "UPDATE `startups` SET `startup_history`='$history'
                           WHERE`startup_email`='$email_id'";


        $resultUpdateStartup4 = mysqli_query($conn, $sqlUpdateStartup4) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
        echo '<div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                      <div class="toast-body">
                       Something went wrong !! Please try again.
                      </div>
                      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                  </div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal5'])) {

    $problem_solution = $_POST['problem_solution'];

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {
        $problem_solution = mysqli_real_escape_string($conn, $problem_solution);

        $sqlUpdateStartup5 = "UPDATE `startups` SET `startup_problem_solution`='$problem_solution'
                           WHERE`startup_email`='$email_id'";


        $resultUpdateStartup5 = mysqli_query($conn, $sqlUpdateStartup5) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
        echo '<div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                      <div class="toast-body">
                       Something went wrong !! Please try again.
                      </div>
                      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                  </div>';
    }
}



?>





<div class="container">
    <div class="main-body">


        <div class="row gutters-sm mt-5">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">


                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i
                                    class="fa-solid fa-pencil"></i></button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">

                                                <div class="mb-3">
                                                    <label for="recipient-website" class="col-form-label">Website
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-website"
                                                        name="website">

                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Linked In
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-name"
                                                        name="linkedin">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-twiiter" class="col-form-label">Twitter :
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient-twitter"
                                                        name="twitter">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-instagram" class="col-form-label">Instagram
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-instagram"
                                                        name="instagram">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-facebook" class="col-form-label">Facebook
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-facebook"
                                                        name="facebook">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-founder" class="col-form-label">Founder
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-founder"
                                                        name="founder">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-founded_in" class="col-form-label">Founded In
                                                        :</label>
                                                    <input type="number" class="form-control" id="recipient-founded_in"
                                                        name="founded_in">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-revenue" class="col-form-label">Revenue
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-revenue"
                                                        name="revenue">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-net_profit" class="col-form-label">Net Profit
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-net_profit"
                                                        name="net_profit">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-company_size" class="col-form-label">Company
                                                        Size
                                                        :</label>
                                                    <input type="number" class="form-control"
                                                        id="recipient-company_size" name="company_size">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-recent_funding" class="col-form-label">Recent
                                                        Funding
                                                        :</label>
                                                    <input type="text" class="form-control"
                                                        id="recipient-recent_funding" name="recent_funding">

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        name="btn-modal1">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>


                        <div class="d-flex flex-column align-items-center text-center">
                            <?php

                            if ($rowSelectStartup['startup_logo'] !== NULL) {
                                echo $rowSelectStartup['startup_logo'];
                            } else {
                                echo ' <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                        class="rounded-circle" width="150">';
                            }
                            ?>
                            <div class="mt-3">
                                <h4><?php echo $rowSelectStartup['startup_name']; ?></h4>

                                <p class="text-muted font-size-sm"> <?php echo $rowSelectStartup['startup_address']; ?>
                                </p>

                                <button class="btn btn-outline-info">Message</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-globe mr-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>Website</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_website']) ? 'Not Linked' : $rowSelectStartup['startup_linkedin']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-globe mr-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>Linked In</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_linkedin']) ? 'Not Linked' : $rowSelectStartup['startup_linkedin']; ?></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-twitter mr-2 icon-inline text-info">
                                    <path
                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                    </path>
                                </svg>Twitter</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_twitter']) ? 'Not Linked' : $rowSelectStartup['startup_twitter']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-instagram mr-2 icon-inline text-danger">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>Instagram</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_instagram']) ? 'Not Linked' : $rowSelectStartup['startup_instagram']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-facebook mr-2 icon-inline text-primary">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>Facebook</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_facebook']) ? 'Not Linked' : $rowSelectStartup['startup_facebook']; ?></span>
                        </li>
                    </ul>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-people-group"></i></span>Founder
                            </h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_founder']) ? 'Not Linked' : $rowSelectStartup['startup_founder']; ?></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>Founded
                                in </h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_founded_in']) ? 'Not Linked' : $rowSelectStartup['startup_founded_in']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i
                                        class="fa-solid fa-magnifying-glass-dollar"></i></span>Revenue</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_revenue']) ? 'Not Linked' : $rowSelectStartup['startup_revenue']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-chart-line"></i></span>Net Profit
                            </h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_net_profit']) ? 'Not Linked' : $rowSelectStartup['startup_net_profit']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-user-group"></i></span>Company Size
                            </h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_size']) ? 'Not Linked' : $rowSelectStartup['startup_size']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-sack-dollar"></i></span>Recent
                                Funding</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectStartup['startup_recent_funding']) ? 'Not Linked' : $rowSelectStartup['startup_recent_funding']; ?></span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">


                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#exampleModal2" data-bs-whatever="@fat"><i
                                    class="fa-solid fa-pencil"></i></button>

                            <div class="modal fade" id="exampleModal2" tabindex="-1"
                                aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Company Name
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-name"
                                                        name="company_name" required>

                                                </div>



                                                <div class="mb-3">
                                                    <label for="recipient-phone" class="col-form-label">Phone
                                                        :</label>
                                                    <input type="number" class="form-control" id="recipient-phone"
                                                        name="phone" required>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Address :</label>
                                                    <textarea class="form-control" id="message-text" name="address"
                                                        required></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-valuation" class="col-form-label">Valuation
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-valuation"
                                                        name="valuation" required>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        data-bs-dismiss="modal" name="btn-modal2">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Company Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_name']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_phone']; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_address']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Valuation</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_valuation']; ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>



                <div class="row gutters-sm">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    About
                                </button>

                            </h2>

                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal3" data-bs-whatever="@fat"><i
                                                class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal3" tabindex="-1"
                                            aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">


                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">About
                                                                    :</label>
                                                                <textarea class="form-control" id="message-text"
                                                                    name="about"></textarea>
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="btn-modal3">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo empty($rowSelectStartup['startup_about']) ? 'No Information Available Currently' : $rowSelectStartup['startup_about']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    History
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal4" data-bs-whatever="@fat"><i
                                                class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal4" tabindex="-1"
                                            aria-labelledby="exampleModalLabel4" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">


                                                            <div class="mb-3">
                                                                <label for="message-history"
                                                                    class="col-form-label">History :</label>
                                                                <textarea class="form-control" id="message-history"
                                                                    name="history"></textarea>
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="btn-modal4">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo empty($rowSelectStartup['startup_history']) ? 'No Information Available Currently' : $rowSelectStartup['startup_history']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Problem & Solution
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingThree">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal5" data-bs-whatever="@fat"><i
                                                class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal5" tabindex="-1"
                                            aria-labelledby="exampleModalLabel5" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">


                                                            <div class="mb-3">
                                                                <label for="message-problem_solution"
                                                                    class="col-form-label">Problem & Solution :</label>
                                                                <textarea class="form-control"
                                                                    id="message-problem_solution"
                                                                    name="problem_solution"></textarea>
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="btn-modal5">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo empty($rowSelectStartup['startup_problem_solution']) ? 'No Information Available Currently' : $rowSelectStartup['startup_problem_solution']; ?>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFour">
                                    Product Images
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingFour">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-light btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                    </div>
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFive">
                                    Documents
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingFive">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-light btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                    </div>
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>