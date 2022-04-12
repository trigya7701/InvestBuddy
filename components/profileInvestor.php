<?php
include_once('../pages/db_connect.php');

$user_id = $_SESSION['user_id'];
$email_id = $_SESSION['user_email'];

mysqli_begin_transaction($conn);
mysqli_autocommit($conn, FALSE);
try {
    $transaction = true;

    $sqlSelectInvestors = "SELECT * FROM `investors` WHERE investor_email='$email_id'";
    $resultSelectInvestors = mysqli_query($conn, $sqlSelectInvestors) ?: throw new Exception('Query Failed');

    $rowSelectInvestors = mysqli_fetch_assoc($resultSelectInvestors) ?: throw new Exception('Query Failed');



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
$linkedin_error = '';
$twitter_error = '';
$instagram_error = '';
$facebook_error = '';



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal1'])) {

    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];






    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {

        $sqlUpdateInvestors = "UPDATE `investors` SET `investor_linkedin`='$linkedin',
                                `investor_twitter`='$twitter',`investor_facebook`='$facebook',
                                `investor_instagram`='$instagram' 
                                WHERE  investor_email='$email_id'";

        $resultUpdateInvestors = mysqli_query($conn, $sqlUpdateInvestors) ?: throw new Exception('Query Failed');;

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

    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];







    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {

        $sqlUpdateInvestors2 = "UPDATE `investors` SET `investor_name`='$full_name',
                                `investor_phone`='$phone',`investor_address`='$address'
                                WHERE  investor_email='$email_id'";

        $resultUpdateInvestors2 = mysqli_query($conn, $sqlUpdateInvestors2) ?: throw new Exception(mysqli_error($conn));

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

    $company_name = $_POST['company_name'];
    $startup_domain = $_POST['startup_domain'];
    $minimum_investment = $_POST['minimum_investment'];
    $salary = $_POST['salary'];







    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {

        $sqlUpdateInvestors3 = "UPDATE `investors` SET `investor_company`='$company_name',
                                `investor_startup_domain`='$startup_domain',`investor_minimum_investment`='$minimum_investment',
                                `investor_salary`='$salary'
                                WHERE  investor_email='$email_id'";

        $resultUpdateInvestors3 = mysqli_query($conn, $sqlUpdateInvestors3) ?: throw new Exception(mysqli_error($conn));

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

    $experience = $_POST['experience'];
    $startup_invested_in = $_POST['startup_invested_in'];
    $total_amount_invested = $_POST['total_amount_invested'];
    $connections = $_POST['connections'];







    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {

        $sqlUpdateInvestors4 = "UPDATE `investors` SET `investor_experience`='$experience',
                                `investor_startup_count`='$startup_invested_in',`investor_amount_invested`='$total_amount_invested',
                                `investor_connections`='$connections'
                                WHERE  investor_email='$email_id'";

        $resultUpdateInvestors4 = mysqli_query($conn, $sqlUpdateInvestors4) ?: throw new Exception(mysqli_error($conn));

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


                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fa-solid fa-pencil"></i></button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Linked In
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="linkedin">
                                                    <p class="error"> <?php echo $linkedin_error; ?></p>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-twiiter" class="col-form-label">Twitter :
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient-twitter" name="twitter">
                                                    <p class="error"> <?php echo $twitter_error; ?></p>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-instagram" class="col-form-label">Instagram
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-instagram" name="instagram">
                                                    <p class="error"> <?php echo $instagram_error; ?></p>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-facebook" class="col-form-label">Facebook
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-facebook" name="facebook">
                                                    <p class="error"> <?php echo $facebook_error; ?></p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="btn-modal1">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="d-flex flex-column align-items-center text-center">

                            <?php

                            if ($rowSelectInvestors['investor_profile'] !== NULL) {
                                echo $rowSelectInvestors['investor_profile'];
                            } else {
                                echo ' <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                            class="rounded-circle" width="150">';
                            }
                            ?>

                            <div class="mt-3">
                                <h4><?php echo $rowSelectInvestors['investor_name']; ?></h4>

                                <p class="text-muted font-size-sm">
                                    <?php echo $rowSelectInvestors['investor_address']; ?></p>

                                <button class="btn btn-outline-info">Message</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>Linked In</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectInvestors['investor_linkedin']) ? 'Not Linked' : $rowSelectInvestors['investor_linkedin']; ?></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                    </path>
                                </svg>Twitter</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectInvestors['investor_twitter']) ? 'Not Linked' : $rowSelectInvestors['investor_twitter']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>Instagram</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectInvestors['investor_instagram']) ? 'Not Linked' : $rowSelectInvestors['investor_instagram']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>Facebook</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectInvestors['investor_facebook']) ? 'Not Linked' : $rowSelectInvestors['investor_facebook']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">


                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Full Name
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="full_name" required>

                                                </div>



                                                <div class="mb-3">
                                                    <label for="recipient-phone" class="col-form-label">Phone
                                                        :</label>
                                                    <input type="number" class="form-control" id="recipient-phone" name="phone" required>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Address :</label>
                                                    <textarea class="form-control" id="message-text" name="address" required></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="btn-modal2">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectInvestors['investor_name']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectInvestors['investor_email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectInvestors['investor_phone']; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectInvestors['investor_address']; ?>
                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

                <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-grid gap-4 d-md-flex justify-content-md-center">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Personal Info</i></h6>


                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST">
                                                        <div class="mb-3">
                                                            <label for="recipient-company" class="col-form-label">Company
                                                                :</label>
                                                            <input type="text" class="form-control" id="recipient-company" name="company_name">

                                                        </div>



                                                        <div class="mb-3">
                                                            <label for="recipient-domain" class="col-form-label">Startup
                                                                Domain
                                                                :</label>
                                                            <input type="text" class="form-control" id="recipient-domain" name="startup_domain">

                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="recipient-investment" class="col-form-label">Minimum Investment
                                                                :</label>
                                                            <input type="text" class="form-control" id="recipient-investment" name="minimum_investment">

                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-salary" class="col-form-label">Annual
                                                                Salary
                                                                :</label>
                                                            <input type="number" class="form-control" id="recipient-salary" name="salary">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="btn-modal3">Update</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Company :
                                            <span><?php echo empty($rowSelectInvestors['investor_company']) ? 'Not Linked' : $rowSelectInvestors['investor_company']; ?></span>
                                        </h6>

                                    </div>
                                </div>



                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Startup Domain :
                                            <span><?php echo empty($rowSelectInvestors['investor_startup_domain']) ? 'Not Linked' : $rowSelectInvestors['investor_startup_domain']; ?></span>
                                        </h6>

                                    </div>
                                </div>

                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Minimum Investment :
                                            <span><?php echo empty($rowSelectInvestors['investor_minimum_investment']) ? 'Not Linked' : $rowSelectInvestors['investor_minimum_investment']; ?></span>
                                        </h6>

                                    </div>
                                </div>

                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Annual Salary :
                                            <span><?php echo empty($rowSelectInvestors['investor_salary']) ? 'Not Linked' : $rowSelectInvestors['investor_salary']; ?></span>
                                        </h6>

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">

                            <div class="card-body">

                                <div class="d-grid gap-4 d-md-flex justify-content-md-center">
                                    <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Investment Info</i></h6>


                                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal4" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST">
                                                        <div class="mb-3">
                                                            <label for="recipient-experience" class="col-form-label">Experience
                                                                :</label>
                                                            <input type="number" class="form-control" id="recipient-experience" name="experience">

                                                        </div>



                                                        <div class="mb-3">
                                                            <label for="recipient-startups_invested" class="col-form-label">Startup Invested In
                                                                :</label>
                                                            <input type="number" class="form-control" id="recipient-startups_invested" name="startup_invested_in">

                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="recipient-amount_invested" class="col-form-label">Total Amount Invested
                                                                :</label>
                                                            <input type="number" class="form-control" id="recipient-amount_invested" name="total_amount_invested">

                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-connections" class="col-form-label">Connections
                                                                :</label>
                                                            <input type="number" class="form-control" id="recipient-connections" name="connections">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="btn-modal4">Update</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>


                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Experience :
                                            <span><?php echo empty($rowSelectInvestors['investor_experience']) ? 'Not Linked' : $rowSelectInvestors['investor_experience']; ?></span>
                                        </h6>

                                    </div>
                                </div>

                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Startups invested in :
                                            <span><?php echo empty($rowSelectInvestors['investor_startup_count']) ? 'Not Linked' : $rowSelectInvestors['investor_startup_count']; ?></span>
                                        </h6>

                                    </div>
                                </div>

                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Total Amount Invested :
                                            <span><?php echo empty($rowSelectInvestors['investor_amount_invested']) ? 'Not Linked' : $rowSelectInvestors['investor_amount_invested']; ?></span>
                                        </h6>

                                    </div>
                                </div>

                                <div class="card card-stats m-2">
                                    <div class="card-body">
                                        <h6>Connections :
                                            <span><?php echo empty($rowSelectInvestors['investor_connections']) ? 'Not Linked' : $rowSelectInvestors['investor_connections']; ?></span>
                                        </h6>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>