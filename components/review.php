
<?php

include_once('../pages/db_connect.php');

mysqli_begin_transaction($conn);
mysqli_autocommit($conn, FALSE);

try {
   
    $sqlSelectFeedback="SELECT * FROM `feedback` ORDER BY `f_time` DESC LIMIT 3";
    $resultSelectFeedback=mysqli_query($conn,$sqlSelectFeedback)?:throw new Exception(mysqli_error($conn));

   // $rowSelectStartups = mysqli_fetch_assoc($resultSelectStartups) ?: throw new Exception('Query Failed');

    mysqli_commit($conn);

} catch (\Throwable $th) {
    //throw $th;
    mysqli_rollback($conn);
}


?>



<section class="review-investor">

    <h5 class="pt-2 px-5 text-center ">There are many reasons to invest</h5>
    <h2 class=" pb-3 px-5 text-center">Here's what our members say !!</h2>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php

            $flag=true;

            while($rowSelectFeedback=mysqli_fetch_assoc($resultSelectFeedback)){
                if($flag){
                    
                    echo '  <div class="carousel-item active">

                   <div class=" testimonial card mx-auto mb-2" style="max-width: 640px;">
                        
                           
                           
                                <div class="card-body px-5 py-3">
                                    <h5 class="card-title mx-3 "><em>'.$rowSelectFeedback['f_email'].'</em></h5>
                                    <p class="card-text my-3">"'.$rowSelectFeedback['f_desc'].'"</p>
    
                                </div>
                            
                       
                    </div>
    
                </div>';

                }
                else{

                    echo ' <div class="carousel-item">
                    <div class=" testimonial card mx-auto mb-2" style="max-width: 640px;">
                      
                                <div class="card-body px-5 py-3">
                                    <h5 class="card-title  mx-3"><em>'.$rowSelectFeedback['f_email'].'</em></h5>
                                    <p class="card-text my-3">"'.$rowSelectFeedback['f_desc'].'"</p>
    
                                </div>
                           
                    </div>
                </div';

                }
                $flag=false;
            }


            ?>
          


           

            

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


   
</section>