<?php
include_once('../pages/db_connect.php');
mysqli_begin_transaction($conn);
mysqli_autocommit($conn, FALSE);
$user_id=$_SESSION['user_id'];
$email_id=$_GET['query'];
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


<div class="container">
    <div class="main-body">


        <div class="row gutters-sm mt-5">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">

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
                                   
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    <?php

                                        mysqli_begin_transaction($conn);
                                        mysqli_autocommit($conn, FALSE);


                                        try {
                                            
                                            $sqlSelectImage="SELECT * FROM `startup_images` WHERE user_id='$user_id'";
                                            $resultSelectImage=mysqli_query($conn,$sqlSelectImage)?:throw new Exception(mysqli_error($conn));

                                            $numSelectImage=mysqli_num_rows($resultSelectImage);

                                            if($numSelectImage!=0){

                                                while($rowSelectImage=mysqli_fetch_assoc($resultSelectImage)){
                                                    
                                                    echo '<div class="col">
                                                    <div class="card">
                                                      <img src="../uploads/'.$rowSelectImage['image_url'].'" class="card-img-top" alt="...">
                                                     
                                                    </div>
                                                  </div>';
                                                }
                                            }



                                        } catch (\Throwable $th) {
                                            //throw $th;
                                            echo $th;
                                        }


                                    ?>
                                    </div>
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