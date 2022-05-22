<?php

session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/profileStartup.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>InvestBuddy | Profile Startup</title>
</head>

<body>
    <!-- Navbar  -->

    <?php include('../components/navbar.php'); ?>


    <?php include('../components/viewProfileStartup.php'); ?>

    <!-- Footer -->
    <?php include('../components/footer.php'); ?>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<script>
    new Morris.Line({
        element: 'chart',
        data: [<?php echo $chart_data; ?>],
        xkey: 'year',
        ykeys: ['profit', 'revenue'],
        labels: ['Profit', 'Revenue'],
        hideHover: 'auto',
        lineColors: ['#9BA3EB', '#646FD4']

    });
    new Morris.Bar({
        element: 'chart_bar',
        data: [<?php echo $chart_data; ?>],
        xkey: 'year',
        ykeys: ['profit', 'revenue'],
        labels: ['Profit', 'Revenue'],
        barColors: ['#9BA3EB', '#646FD4'],
        hideHover: 'auto',


    });
</script>


</html>