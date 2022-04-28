<?php
    include_once('../pages/db_connect.php');

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);

    try {
       
        $sqlSelectStartups="SELECT * FROM `startups` ORDER BY `startup_valuation` LIMIT 6";
        $resultSelectStartups=mysqli_query($conn,$sqlSelectStartups)?:throw new Exception(mysqli_error($conn));

       // $rowSelectStartups = mysqli_fetch_assoc($resultSelectStartups) ?: throw new Exception('Query Failed');

        mysqli_commit($conn);

    } catch (\Throwable $th) {
        //throw $th;
        mysqli_rollback($conn);
    }
?>
<section class="startup">

    <h2>Most Valuable Startups</h2>

    <div class=" container ">
        <div class="row">

            <?php

            while($rowSelectStartups = mysqli_fetch_assoc($resultSelectStartups)){

                $imgurl="";
                $linkurl="../pages/view_profile_startup.php?query=".$rowSelectStartups['startup_email'];
                if($rowSelectStartups['startup_logo'] !== NULL){
                    $imgurl="../profile-images/". $rowSelectStartups['startup_logo'];
                }
                else{
                    $imgurl="../images/slider-img9.jpg";
                }
                echo  '<div class="col-lg-4 col-md-6 startup-content">
                        <div class="card" style="width: 18rem;">
                            <img src='.$imgurl.' class="card-img-top" style="height: 250px;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">'.$rowSelectStartups['startup_name'].'</h5>
                                <p >Email : '.$rowSelectStartups['startup_email'].'</p>
                                <p>Phone : '.$rowSelectStartups['startup_phone'].'</p>
                                <p >Valuation : '.$rowSelectStartups['startup_valuation'].'</p>
                                <a href="'.$linkurl.'" class="btn btn-outline-info btn-sm">View More</a>
                            </div>
                        </div>
                </div>
                
                ';

            }

        ?>




        </div>

    </div>

</section>