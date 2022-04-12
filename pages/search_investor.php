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
    <link rel="stylesheet" href="../css/search.css">


    <title>InvestBuddy | Fininvestors</title>
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
    include_once('db_connect.php');

    $query = $_GET['query'];
    ?>
    <section class="search  p-5">

        <h2 class="mx-5 my-2">Search results for <em>"<?php echo $query;  ?>"</em></h2>


        <?php

        mysqli_begin_transaction($conn);
        mysqli_autocommit($conn, FALSE);

        try {

            $sqlSearchInvestor = "SELECT * FROM `investors` WHERE MATCH(`investor_name`, `investor_email`, 
                                `investor_address`, `investor_interest`, `investor_linkedin`, `investor_twitter`,
                                `investor_facebook`, `investor_instagram`, `investor_company`, `investor_startup_domain`)
                                against('$query')";
            $resultSearchInvestor = mysqli_query($conn, $sqlSearchInvestor) ?: throw new Exception(mysqli_error($conn));

            $rowCountInvestor = mysqli_num_rows($resultSearchInvestor);

            if ($rowCountInvestor == 0) {
                echo '<div class="container mt-3">
                    <div class="mt-4 p-5 bg-light text-black rounded">
                        
                        <div class="mb-3">
                            <h2>Your search - <em>"' . $query . '" </em>- did not match any documents.</h2>
                            <p>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                            </p>
    
                        </div>
    
                       
                    </div>
                </div>';
            } else {
                while ($rowSearchInvestor = mysqli_fetch_assoc($resultSearchInvestor)) {
                    $url = "view_profile_investor.php?query=" . $rowSearchInvestor['investor_email'];
                    echo ' <div class="card mx-5 mt-4 search-card">
                        <div class="card-body">
                        <h1 class="card-title">' . $rowSearchInvestor['investor_name'].'</h1>

             
                <h4 class="card-text my-2">Address : ' .$rowSearchInvestor['investor_address'] . '</h4>
                <h4 class="card-text my-2">Phone    : ' . $rowSearchInvestor['investor_phone'] . '
                <span class="mx-3">Email id :' . $rowSearchInvestor['investor_email'] . '</span>
               

                    <a href="' . $url . '" class="btn btn-info">View More</a>
            </div>
        </div>';
                }
            }

            mysqli_commit($conn);
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;

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




    </section>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>


</html>