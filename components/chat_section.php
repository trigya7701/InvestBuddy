<?php
include_once('../pages/db_connect.php');
$email_id = $_SESSION['user_email'];


?>




<div class="container my-2">

    <div class="messaging my-2">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>My Chats</h4>
                    </div>

                </div>
                <div class="inbox_chat">
                    <div class="chat_list ">

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
                    $_SESSION['live_chat']=$chatId;
                    // echo $chatId;

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
                } else if(isset($_SESSION['live_chat'])) 
                {
                    mysqli_begin_transaction($conn);
                    $chat=$_SESSION['live_chat'];

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

                        $message=$_POST['message'];
                        $chatId=$_POST['chat_id'];
                        //echo $chatId;

                        mysqli_begin_transaction($conn);
                        try {
                
                            $sqlInsertPosts="INSERT INTO `posts`(`post_message`,  `user_email`, `chat_id`) 
                                            VALUES ('$message','$email_id','$chatId')";
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




                <div class="type_msg">

                <form action="" method="post">
                   
                        <div class="input-group mb-3 my-2">
                        <input type="hidden"  name="chat_id" value="<?php echo $chatId ?>">
                            <input type="text" class="form-control" placeholder="Send Message" name="message" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <?php

                            if(isset($_SESSION['live_chat'])){
                                echo '<button class="btn btn-primary" type="Submit" name="send"  id="button-addon2">Send</button>';
                            }
                            else{
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