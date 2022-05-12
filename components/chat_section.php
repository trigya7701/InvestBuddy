<?php
include_once('../pages/db_connect.php');
$email_id = $_SESSION['user_email'];


?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['chat_search2'])) {
    $chat_email=$_POST['chat_email'];
    $chatExists = false;
    $chat_id;
    $sender_email = $email_id;
    $reciever_email = $chat_email;

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
                $_SESSION['live_chat']  = $rowSelectChats['chat_id'];
            }
        }

        if(!$chatExists){
            $chat_name = $sender_email . $reciever_email;

            
            $sqlInsertChats = "INSERT INTO `chats`( `chat_name`,  `user1_email`, `user2_email`)
            VALUES ('$chat_name','$sender_email','$reciever_email')";
               $resultInsertChats = mysqli_query($conn, $sqlInsertChats) ?: throw new Exception(mysqli_error($conn));

               $sqlSelectChats2 = "SELECT * FROM `chats` WHERE chat_name='$chat_name'";
               $resultSelectChats2 = mysqli_query($conn, $sqlSelectChats2) ?: throw new Exception(mysqli_error($conn));

               while ($rowSelectChats2 = mysqli_fetch_assoc($resultSelectChats2)) {
                $_SESSION['live_chat'] = $rowSelectChats2['chat_id'];
               }
        }
        $_SESSION['live_chat_user']=$chat_email;
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        echo $th;
    }
}

?>



<div class="container my-2">

    <div class="messaging my-2">
        <div class="inbox_msg">
            <div class="inbox_people">
                <form action="" method="post">
                    <div class="headind_srch d-flex flex-row justify-content-around">
                        <div class="recent_heading">
                            <h4>My Chats</h4>

                        </div>

                        <div class="input-group input-group-sm mb-3 ">
                            <input type="text" class="form-control" placeholder="Search Chat" name="search_chat"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary btn-outline-info" type="submit" name="chat_search"
                                id="button-addon2">Search</button>
                        </div>


                    </div>
                </form>
                <div class="inbox_chat">
                    <div class="chat_list ">
                        <?php

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['chat_search'])) {
                            $search_chat = $_POST['search_chat'];
                            mysqli_begin_transaction($conn);

                            try {

                                $sqlSearchStartupChat = "SELECT * FROM `startups` WHERE MATCH( `startup_name`, `startup_email`, `startup_address`, 
                                `startup_valuation`,`startup_founder`,`startup_about`,
                               `startup_history`,`startup_problem_solution`,`startup_net_profit`,
                               `startup_revenue`,`startup_recent_funding`,`startup_domain`,
                               `startup_website`,`startup_linkedin`,`startup_twitter`,
                               `startup_facebook`,`startup_instagram`)
                               against('$search_chat')";
                                $resultSearchStartupChat = mysqli_query($conn, $sqlSearchStartupChat) ?: throw new Exception(mysqli_error($conn));

                                $rowCountStartupChat = mysqli_num_rows($resultSearchStartupChat);

                                if ($rowCountStartupChat != 0) {
                                    while ($rowSearchStartupChat = mysqli_fetch_assoc($resultSearchStartupChat)) {
                                        if($rowSearchStartupChat['startup_email']!=$email_id){
                                        echo '<div class="chat_people">
                                    
                                
                               
                                    <div class="chat_ib">
                                        <h5 class="text-black-50">' . $rowSearchStartupChat['startup_email']  . ' <span>
    
                                        
                                        <form action="" method="post">
    
                                        <input type="hidden"  name="chat_email" value="' . $rowSearchStartupChat['startup_email'] . '">
                                            
                                        <button class="btn btn-outline-info btn-sm  " type="submit"  name="chat_search2" > Start  <i class="fa-regular fa-comment-dots"></i></button>
                                        </form>
                                        </span>
                                        </h5>
                                       
                                    </div>
                                </div>
                                <hr>';}
                                    }
                                }


                                $sqlSearchInvestorChat = "SELECT * FROM `investors` WHERE MATCH(`investor_name`, `investor_email`, 
                               `investor_address`, `investor_interest`, `investor_linkedin`, `investor_twitter`,
                               `investor_facebook`, `investor_instagram`, `investor_company`, `investor_startup_domain`)
                               against('$search_chat')";
                                $resultSearchInvestorChat = mysqli_query($conn, $sqlSearchInvestorChat) ?: throw new Exception(mysqli_error($conn));

                                $rowCountInvestorChat = mysqli_num_rows($resultSearchInvestorChat);

                                if ($rowCountInvestorChat != 0) {
                                    while ($rowSearchInvestorChat = mysqli_fetch_assoc($resultSearchInvestorChat)) {
                                        if($rowSearchInvestorChat['investor_email']!=$email_id){
                                        echo '<div class="chat_people">
                                    
                                
                               
                                    <div class="chat_ib">
                                        <h5 class="text-black-50">' . $rowSearchInvestorChat['investor_email']  . ' <span>
    
                                        
                                        <form action="" method="post">
                                        <input type="hidden"  name="chat_email" value="' .$rowSearchInvestorChat['investor_email'] . '">
                                            <button class="btn btn-outline-info btn-sm  " type="submit"  name="chat_search2" > Start  <i class="fa-regular fa-comment-dots"></i></button>
                                        </form>
                                        </span>
                                        </h5>
                                       
                                    </div>
                                </div>
                                <hr>';}
                                    }
                                }
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

                        <?php

                        mysqli_begin_transaction($conn);

                        try {

                            $sqlSelectChats = "SELECT * FROM `chats` WHERE user1_email='$email_id' OR user2_email='$email_id'";
                            $resultSelectChats = mysqli_query($conn, $sqlSelectChats) ?: throw new Exception(mysqli_error($conn));

                            $numSelectChats = mysqli_num_rows($resultSelectChats);

                            if ($numSelectChats == 0) {
                                echo '<div class="chat_people">
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                    <p>Test, which is a new approach to have all solutions
                                        astrology under one roof.</p>
                                </div>
                            </div>';
                            } else {
                                while ($rowSelectChats = mysqli_fetch_assoc($resultSelectChats)) {

                                    if ($rowSelectChats['user1_email'] != $email_id) {
                                        $chat_name = $rowSelectChats['user1_email'];
                                    } else {
                                        $chat_name = $rowSelectChats['user2_email'];
                                    }
                                    $chat_id = $rowSelectChats['chat_id'];
                                    echo '<div class="chat_people">
                                    
                                
                               
                                <div class="chat_ib">
                                    <h5>' . $chat_name . ' <span>

                                    
                                    <form action="" method="post">

                                    <input type="hidden"  name="chat_id" value="' . $chat_id . '">
                                    <input type="hidden"  name="chat_name" value="' . $chat_name . '">

                                    <button class="btn btn-outline-info btn-sm  " type="submit"  name="chat" > View  <i class="fa-regular fa-comment-dots"></i></button>
                                    </form>
                                    </span>
                                    </h5>
                                   
                                </div>
                            </div>
                            <hr>';
                                }
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                            mysqli_rollback($conn);
                            echo $th;
                        }
                        ?>






                    </div>


                </div>
            </div>
            <div class="mesgs">



                <?php
             
                $chatId;
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['chat'])) {

                    $chatId = $_POST['chat_id'];
                    $chatName = $_POST['chat_name'];
                    $_SESSION['live_chat'] = $chatId;
                    $_SESSION['live_chat_user']=$chatName;

                    echo '<div class="d-grid gap-3 mb-2">
                    <div class="p-2 bg-light border"><h5><i class="material-icons text-info ">' .  $chatName . '</i></h5></div>
                    
                  </div>';

                    mysqli_begin_transaction($conn);

                    try {
                        $sqlSelectPosts = "SELECT * FROM `posts` WHERE chat_id='$chatId' ORDER BY post_time ASC";
                        $resultSelectPosts = mysqli_query($conn, $sqlSelectPosts) ?: throw new Exception(mysqli_error($conn));

                        $numSelectPosts = mysqli_num_rows($resultSelectPosts);

                        echo '<div class="msg_history">';
                        while ($rowSelectPosts = mysqli_fetch_assoc($resultSelectPosts)) {

                            if ($rowSelectPosts['user_email'] != $email_id) {

                                echo ' <div class="incoming_msg  mx-3 my-2">
                              
                                <div class="received_msg ">
                                    <div class="received_withd_msg">
                                        <p>' . $rowSelectPosts['user_email'] . '</p>
                                        <p>' . $rowSelectPosts['post_message'] . '</p>
                                        <span class="time_date"> ' . $rowSelectPosts['post_time'] . '</span>
                                    </div>
                                </div>
                            </div>';
                            } else {

                                echo ' <div class="outgoing_msg mx-3 my-2">
                               
                                <div class="sent_msg ">
                                <p class="bg-info">' . $rowSelectPosts['user_email'] . '</p>
                                    <p class="bg-info">' . $rowSelectPosts['post_message'] . '</p>
                                    <span class="time_date"> ' . $rowSelectPosts['post_time'] . '</span>
                                </div>
                            </div>';
                            }
                        }
                        echo '</div>';
                    } catch (\Throwable $th) {
                        //throw $th;
                        mysqli_rollback($conn);
                        echo $th;
                    }
                } else if (isset($_SESSION['live_chat'])) {
                    mysqli_begin_transaction($conn);
                    $chat = $_SESSION['live_chat'];

                    try {
                        $sqlSelectPosts = "SELECT * FROM `posts` WHERE chat_id='$chat' ORDER BY post_time ASC";
                        $resultSelectPosts = mysqli_query($conn, $sqlSelectPosts) ?: throw new Exception(mysqli_error($conn));

                        $numSelectPosts = mysqli_num_rows($resultSelectPosts);

                        

                        echo '<div class="msg_history">';
                        
                        while ($rowSelectPosts = mysqli_fetch_assoc($resultSelectPosts)) {

                            if ($rowSelectPosts['user_email'] != $email_id) {

                                echo ' <div class="incoming_msg  mx-3 my-2">
                              
                                <div class="received_msg ">
                                    <div class="received_withd_msg">
                                        <p>' . $rowSelectPosts['user_email'] . '</p>
                                        <p>' . $rowSelectPosts['post_message'] . '</p>
                                        <span class="time_date"> ' . $rowSelectPosts['post_time'] . '</span>
                                    </div>
                                </div>
                            </div>';
                            } else {

                                echo ' <div class="outgoing_msg mx-3 my-2">
                               
                                <div class="sent_msg ">
                                <p class="bg-info">' . $rowSelectPosts['user_email'] . '</p>
                                    <p class="bg-info">' . $rowSelectPosts['post_message'] . '</p>
                                    <span class="time_date"> ' . $rowSelectPosts['post_time'] . '</span>
                                </div>
                            </div>';
                            }
                        }
                        echo '</div>';
                       
                    } catch (\Throwable $th) {
                        //throw $th;
                        mysqli_rollback($conn);
                        echo $th;
                    }
                }


                ?>


                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {

                    $message = $_POST['message'];
                    $chatId = $_POST['chat_id'];
                    //echo $chatId;

                    mysqli_begin_transaction($conn);
                    try {

                        $sqlInsertPosts = "INSERT INTO `posts`(`post_message`,  `user_email`, `chat_id`) 
                                            VALUES ('$message','$email_id','$chatId')";
                        $sqlInsertPosts = mysqli_query($conn, $sqlInsertPosts) ?: throw new Exception(mysqli_error($conn));
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




                <div class="type_msg">

                    <form action="" method="post">

                        <div class="input-group mb-3 my-2">
                            <input type="hidden" name="chat_id" value="<?php echo $chatId ?>">
                            <input type="text" class="form-control" placeholder="Send Message" name="message"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <?php

                            if (isset($_SESSION['live_chat'])) {
                                echo '<button class="btn btn-primary" type="Submit" name="send"  id="button-addon2">Send</button>';
                            } else {
                                echo '<button class="btn btn-primary disabled" type="Submit" name="send"  id="button-addon2">Send</button>';
                            }

                            ?>

                        </div>
                    </form>

                </div>
            </div>
        </div>




    </div>
</div>