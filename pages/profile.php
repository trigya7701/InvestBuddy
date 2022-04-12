<?php
    session_start();
?>
<?php
if(isset($_SESSION["user_id"]) && isset($_SESSION['user_email']))
{
    include_once('db_connect.php');
    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);

    try {
       
        $user_id=$_SESSION["user_id"];
        $sqlSelectUsers = "SELECT * FROM `users` WHERE user_id='$user_id'";
        $resultSelectUsers = mysqli_query($conn, $sqlSelectUsers)?:throw new Exception("Query Failed");

        $rowSelectUsers = mysqli_fetch_assoc($resultSelectUsers);

      

        mysqli_commit($conn);

        if($rowSelectUsers['user_role']==="Investor"){
            header("Location:profile_investor.php");
        }
        else{
            header("Location:profile_startup.php");
        }

       

       
        
      } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);

        header("Location:home.php");
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
else
{
    header("Location:../pages/signin.php");
}
?>