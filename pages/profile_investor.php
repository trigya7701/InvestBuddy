<?php

session_start();

if(!isset($_SESSION["user_id"]) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_role']) )
{
    
    header("Location:../pages/signin.php");
}
else{
    //Write logic if signed in using startup and try to access investor page

    if($_SESSION['user_role']!=="Investor"){
        header("Location:profile_startup.php");
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/profileInvestor.css">
    <title>InvestBuddy | Profile</title>
</head>

<body>


  

    <!-- Navbar  -->


    <?php include('../components/navbar.php'); ?>


    <!-- Profile Investor -->
    <?php include('../components/profileInvestor.php'); ?>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

</html>