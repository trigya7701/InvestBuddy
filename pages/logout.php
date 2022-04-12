<?php
    session_start();
?>
<?php
if(isset($_SESSION["user_id"]) && isset($_SESSION['user_email']))
{
    session_unset();
    session_destroy();
    header("Location:../pages/home.php");
}
else
{
    header("Location:../pages/signin.php");
}
?>