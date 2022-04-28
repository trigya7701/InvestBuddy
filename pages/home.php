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
    <link rel="stylesheet" href="../css/slider.css">
    <link rel="stylesheet" href="../css/startuplist.css">
    <link rel="stylesheet" href="../css/services.css">

    <link rel="stylesheet" href="../css/review.css">
    
    <link rel="stylesheet" href="../css/footer.css"> 

    <title>InvestBuddy | Home</title>
    <style>

    </style>

</head>

<body>

    <?php

    session_start();
    ?>

    <!-- Navbar  -->

    <?php include('../components/navbar.php'); ?>

    <?php

            if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
                echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
           Welcome Back !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    }
    ?>

    <!-- Slider -->



    <?php include('../components/slider.php'); ?>


    <!-- Startup Card -->

    <?php include('../components/startuplist.php'); ?>

    <!-- Services -->
    <?php include('../components/services.php'); ?>


    <!-- Testimonials-->

    <?php include('../components/review.php'); ?>






    <!-- Footer -->
    <?php include('../components/footer.php'); ?>



</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>


</html>