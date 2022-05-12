<?php
include_once('../pages/db_connect.php');

$email_id = $_GET['query'];

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


    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['send'])){
        $message=$_POST['message'];
        $chatId=$_POST['chat_id'];
        $email=$_SESSION['user_email'];
        //echo $message;
       // echo $chatId;

        mysqli_begin_transaction($conn);
        try {

            $sqlInsertPosts="INSERT INTO `posts`(`post_message`,  `user_email`, `chat_id`) 
                            VALUES ('$message','$email','$chatId')";
            $sqlInsertPosts=mysqli_query($conn,$sqlInsertPosts)?:throw new Exception(mysqli_error($conn));
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

                            if ($rowSelectInvestors['investor_profile'] !== NULL) {
                                echo  ' <img src="../profile-images/' . $rowSelectInvestors['investor_profile'] . '" alt="Admin"
                                class="rounded-circle" width="150">';
                            } else {
                                echo ' <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                            class="rounded-circle" width="150">';
                            }
                            ?>

                            <div class="mt-3">
                                <h4><?php echo $rowSelectInvestors['investor_name']; ?></h4>

                                <p class="text-muted font-size-sm">
                                    <?php echo $rowSelectInvestors['investor_address']; ?></p>

                                <?php

                                if (isset($_SESSION['user_email']) && $_SESSION['user_email'] != $email_id) {
                                    //  echo '<button class="btn btn-outline-info">Message</button>';
                                    $chatExists = false;
                                    $chat_id;

                                    $sender_email = $_SESSION['user_email'];
                                    $reciever_email = $email_id;
                                    mysqli_begin_transaction($conn);

                                    try {

                                        $sqlSelectChats = "SELECT * FROM `chats` WHERE 
                                                            ( user1_email='$sender_email' AND user2_email='$reciever_email')
                                                            OR (user1_email='$reciever_email' AND user2_email='$sender_email')";
                                        $resultSelectChats = mysqli_query($conn, $sqlSelectChats) ?: throw new Exception(mysqli_error($conn));

                                        $numSelectChat = mysqli_num_rows($resultSelectChats);
                                        if ($numSelectChat == 1) {
                                            $chatExists = true;


                                            while ($rowSelectChats = mysqli_fetch_assoc($resultSelectChats)) {
                                                $chat_id = $rowSelectChats['chat_id'];
                                            }
                                        }
                                    } catch (\Throwable $th) {
                                        //throw $th;

                                        mysqli_rollback($conn);
                                        echo $th;
                                    }



                                    echo '  
                                        <button type="submit" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Message
                                            </button>
                                        
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">' . $email_id . '</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                         ';
                                    if ($chatExists) {


                                        mysqli_begin_transaction($conn);
                                        try {

                                            $sqlSelectPosts = "SELECT * FROM `posts` WHERE chat_id='$chat_id' ORDER BY post_time ASC";
                                            $resultSelectPosts = mysqli_query($conn, $sqlSelectPosts) ?: throw new Exception(mysqli_error($conn));

                                            $numSelectPosts = mysqli_num_rows($resultSelectPosts);
                                            if ($numSelectPosts == 0) {
                                                echo '<div class="card m-3 bg-warning">
                                                <div class="card-body text-dark">
                                                Type Something to start your conversation.
                                                </div>
                                            </div>';
                                            } else {

                                                while ($rowSelectPosts = mysqli_fetch_assoc($resultSelectPosts)) {


                                                    echo '
                                                    <div class="card card-stats mx-4 my-2 ">
                                                        <div class="card-body   ">
                                                            <p class="text-start m-0 p-0"><strong>' . $rowSelectPosts['user_email'] . '</strong></p>
                                                            <p class="text-start m-0 p-0">' . $rowSelectPosts['post_message'] . '</p>
                                                            <p class="text-end m-0 p-0"><small>' . $rowSelectPosts['post_time'] . '</small></p>

                                                        </div>
                                                    </div>';
                                                }
                                            }
                                        } catch (\Throwable $th) {
                                            //throw $th;
                                            mysqli_rollback($conn);
                                            echo $th;
                                        }
                                    } else {
                                        mysqli_begin_transaction($conn);

                                        try {
                                            $chat_name = $sender_email . $reciever_email;


                                            $sqlInsertChats = "INSERT INTO `chats`( `chat_name`,  `user1_email`, `user2_email`)
                                         VALUES ('$chat_name','$sender_email','$reciever_email')";
                                            $resultInsertChats = mysqli_query($conn, $sqlInsertChats) ?: throw new Exception(mysqli_error($conn));

                                            $sqlSelectChats2 = "SELECT * FROM `chats` WHERE chat_name='$chat_name'";
                                            $resultSelectChats2 = mysqli_query($conn, $sqlSelectChats2) ?: throw new Exception(mysqli_error($conn));

                                            while ($rowSelectChats2 = mysqli_fetch_assoc($resultSelectChats2)) {
                                                $chat_id = $rowSelectChats2['chat_id'];
                                            }
                                        } catch (\Throwable $th) {
                                            //throw $th;
                                            mysqli_rollback($conn);
                                            echo $th;
                                        }
                                    }
                                    echo '</div>
                                            <form action="" method="post">
                                                <div class="modal-footer">

                                                
                                                
                                                    <div class="input-group mb-3">

                                                    <input type="hidden"  name="chat_id" value="' . $chat_id . '">
                                                        <input type="text" class="form-control" placeholder="Send Message" name="message" aria-label="Recipients username" aria-describedby="button-addon2">
                                                        <button class="btn btn-primary" type="submit"  name="send" id="button-addon2" >Send</button>
                                                    
                                                    </div>
                                                    
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                     ';
                                } else {
                                    echo '<button class="btn btn-info disabled">Message</button>';
                                }


                                ?>

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
                                </svg>Website</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectInvestors['investor_website']) ? 'Not Linked' : $rowSelectInvestors['investor_website']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="fa-brands fa-linkedin"></i> Linked In</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectInvestors['investor_linkedin']) ? 'Not Linked' : $rowSelectInvestors['investor_linkedin']; ?></span>
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
                                class="text-secondary"><?php echo empty($rowSelectInvestors['investor_twitter']) ? 'Not Linked' : $rowSelectInvestors['investor_twitter']; ?></span>
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
                                class="text-secondary"><?php echo empty($rowSelectInvestors['investor_instagram']) ? 'Not Linked' : $rowSelectInvestors['investor_instagram']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-facebook mr-2 icon-inline text-primary">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>Facebook</h6>
                            <span
                                class="text-secondary"><?php echo empty($rowSelectInvestors['investor_facebook']) ? 'Not Linked' : $rowSelectInvestors['investor_facebook']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">


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
                                    <h6 class="d-flex align-items-center mb-3"><i
                                            class="material-icons text-info mr-2">Personal Info</i></h6>





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
                                    <h6 class="d-flex align-items-center mb-3"><i
                                            class="material-icons text-info mr-2">Investment Info</i></h6>





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