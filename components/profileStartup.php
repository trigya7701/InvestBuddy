<?php
include_once('../pages/db_connect.php');

$user_id = $_SESSION['user_id'];
$email_id = $_SESSION['user_email'];

mysqli_begin_transaction($conn);
mysqli_autocommit($conn, FALSE);
try {
    $transaction = true;

    $sqlSelectStartup = "SELECT * FROM `startups` WHERE startup_email='$email_id'";
    $resultSelectStartup = mysqli_query($conn, $sqlSelectStartup) ?: throw new Exception('Query Failed');

    $rowSelectStartup = mysqli_fetch_assoc($resultSelectStartup) ?: throw new Exception('Query Failed');



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



?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal1'])) {

    $website = $_POST['website'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];

    $founder = $_POST['founder'];
    $founded_in = $_POST['founded_in'];
    $revenue = $_POST['revenue'];
    $net_profit = $_POST['net_profit'];
    $company_size = $_POST['company_size'];
    $recent_funding = $_POST['recent_funding'];
    $domain = $_POST['domain'];




    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {


        $sqlUpdateStartup = "UPDATE `startups` SET `startup_linkedin`='$linkedin',
                            `startup_twitter`='$twitter',`startup_facebook`='$facebook',
                            `startup_instagram`='$instagram',`startup_website`='$website',
                            `startup_founder`='$founder',`startup_founded_in`='$founded_in',
                            `startup_revenue`='$revenue',`startup_net_profit`='$net_profit',
                            `startup_size`='$company_size',`startup_recent_funding`='$recent_funding',
                            `startup_domain`='$domain'
                            WHERE`startup_email`='$email_id'";

        $resultUpdateStartup = mysqli_query($conn, $sqlUpdateStartup) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        // echo $th;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal2'])) {

    $company_name = $_POST['company_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $valuation = $_POST['valuation'];






    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {

        $sqlUpdateStartup2 = "UPDATE `startups` SET `startup_name`='$company_name',
                            `startup_phone`='$phone',`startup_address`='$address',
                            `startup_valuation`='$valuation'
                            WHERE`startup_email`='$email_id'";

        $resultUpdateStartup2 = mysqli_query($conn, $sqlUpdateStartup2) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal3'])) {

    $about = $_POST['about'];

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {
        $about = mysqli_real_escape_string($conn, $about);

        $sqlUpdateStartup3 = "UPDATE `startups` SET `startup_about`='$about'
                           WHERE`startup_email`='$email_id'";


        $resultUpdateStartup3 = mysqli_query($conn, $sqlUpdateStartup3) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal4'])) {

    $history = $_POST['history'];

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {
        $history = mysqli_real_escape_string($conn, $history);

        $sqlUpdateStartup4 = "UPDATE `startups` SET `startup_history`='$history'
                           WHERE`startup_email`='$email_id'";


        $resultUpdateStartup4 = mysqli_query($conn, $sqlUpdateStartup4) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal5'])) {

    $problem_solution = $_POST['problem_solution'];

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {
        $problem_solution = mysqli_real_escape_string($conn, $problem_solution);

        $sqlUpdateStartup5 = "UPDATE `startups` SET `startup_problem_solution`='$problem_solution'
                           WHERE`startup_email`='$email_id'";


        $resultUpdateStartup5 = mysqli_query($conn, $sqlUpdateStartup5) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
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

if (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal6']) && isset($_FILES['product_image']))) {

    $img_name = $_FILES['product_image']['name'];
    $img_size = $_FILES['product_image']['size'];
    $tmp_name = $_FILES['product_image']['tmp_name'];
    $error = $_FILES['product_image']['error'];


    try {

        if ($error === 0) {
            if ($img_size > 125000) {
                throw new Exception("Sorry, your file is too large.");
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);


                    //database logic
                    mysqli_begin_transaction($conn);
                    mysqli_autocommit($conn, FALSE);

                    $sqlInsertImage = "INSERT INTO `startup_images`(`user_id`, `startup_email`, `image_url`) 
                                    VALUES ('$user_id','$email_id','$new_img_name')";
                    $resultInsertImage = mysqli_query($conn, $sqlInsertImage) ?: throw new Exception(mysqli_error($conn));
                    mysqli_commit($conn);

                    echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                            <div class="toast-body">
                      Image Uploaded !!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>';
                } else {
                    throw new Exception("You can't upload files of this type");
                }
            }
        } else {
            throw new Exception("Errpr");
        }
    } catch (\Throwable $th) {

        //throw $th;
        mysqli_rollback($conn);
        //  echo $th;
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

if (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-delete-img']))) {

    $image_url = $_POST['product_image'];
    //echo $image_url;
    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);

    try {

        $sqlDeleteImage = "DELETE FROM `startup_images` WHERE image_url='$image_url'";
        $resultDeleteImage = mysqli_query($conn, $sqlDeleteImage) ?: throw new Exception(mysqli_error($conn));


        $file_path =  "../uploads/" . $image_url;
        unlink($file_path) ?: throw new Exception("Error");
        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
        Image Deleted !!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>';
    } catch (\Throwable $th) {
        //throw $th;
        mysqli_rollback($conn);
        //echo $th;
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

if (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal7']) && isset($_FILES['document']))) {

    $document_name = $_FILES['document']['name'];
    $document_size = $_FILES['document']['size'];
    $tmp_name = $_FILES['document']['tmp_name'];
    $document_error = $_FILES['document']['error'];


    //  echo $document_name;



    try {

        if ($document_error === 0) {
            if ($document_size > 1250000000) {
                throw new Exception("Sorry, your file is too large.");
            } else {
                $document_ex = pathinfo($document_name, PATHINFO_EXTENSION);
                $document_ex_lc = strtolower($document_ex);

                $allowed_exs = array("pdf");

                if (in_array($document_ex_lc, $allowed_exs)) {
                    $new_document_name = uniqid("PDF-", true) . '.' . $document_ex_lc;
                    $document_upload_path = '../documents/' . $new_document_name;
                    move_uploaded_file($tmp_name, $document_upload_path);


                    //database logic
                    mysqli_begin_transaction($conn);
                    mysqli_autocommit($conn, FALSE);

                    $sqlInsertDocument = "INSERT INTO `startup_documents`(`user_id`, `startup_email`, `startup_document`) 
                                    VALUES ('$user_id','$email_id','$new_document_name')";
                    $resultInsertDocument = mysqli_query($conn, $sqlInsertDocument) ?: throw new Exception(mysqli_error($conn));
                    mysqli_commit($conn);

                    echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                            <div class="toast-body">
                      Document Uploaded !!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>';
                } else {
                    throw new Exception("You can't upload files of this type");
                }
            }
        } else {
            throw new Exception("Error");
        }
    } catch (\Throwable $th) {

        //throw $th;
        mysqli_rollback($conn);
        // echo $th;
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

if (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-delete-document']))) {

    $document = $_POST['document'];
    //echo $image_url;
    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);

    try {

        $sqlDeleteDocument = "DELETE FROM `startup_documents` WHERE startup_document='$document'";
        $resultDeleteDocument = mysqli_query($conn, $sqlDeleteDocument) ?: throw new Exception(mysqli_error($conn));


        $file_path =  "../documents/" . $document;
        unlink($file_path) ?: throw new Exception("Error");
        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
        Document  Deleted !!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>';
    } catch (\Throwable $th) {
        //throw $th;
        mysqli_rollback($conn);
        //echo $th;
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


if (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal8']) && isset($_FILES['profile_image']))) {

    $profile_img_name = $_FILES['profile_image']['name'];
    $profile_img_size = $_FILES['profile_image']['size'];
    $tmp_name = $_FILES['profile_image']['tmp_name'];
    $error = $_FILES['profile_image']['error'];
    //echo $profile_img_name;

    try {

        if ($error === 0) {
            if ($profile_img_size > 125000) {
                throw new Exception("Sorry, your file is too large.");
            } else {
                $profile_img_ex = pathinfo($profile_img_name, PATHINFO_EXTENSION);
                $profile_img_ex_lc = strtolower($profile_img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($profile_img_ex_lc, $allowed_exs)) {
                    $profile_new_img_name = uniqid("LOGO-", true) . '.' . $profile_img_ex_lc;
                    $profile_img_upload_path = '../profile-images/' . $profile_new_img_name;



                    //database logic
                    mysqli_begin_transaction($conn);
                    mysqli_autocommit($conn, FALSE);

                    $sqlUpdateStartupLogo = "UPDATE `startups` SET `startup_logo`='$profile_new_img_name'
                    WHERE`startup_email`='$email_id'";
                    $resultUpdateStarupLogo = mysqli_query($conn, $sqlUpdateStartupLogo) ?: throw new Exception(mysqli_error($conn));

                    mysqli_commit($conn);
                    move_uploaded_file($tmp_name, $profile_img_upload_path);

                    echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                            <div class="toast-body">
                      Profile Image Updated !!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>';
                } else {
                    throw new Exception("You can't upload files of this type");
                }
            }
        } else {
            throw new Exception("Errpr");
        }
    } catch (\Throwable $th) {

        //throw $th;
        mysqli_rollback($conn);
        // echo $th;
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

if (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-delete-profile-img']))) {

    $profile_image_url = $_POST['profile_image'];
    // echo $profile_image_url;
    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);

    try {

        $sqlDeleteProfileImage = "UPDATE `startups` SET `startup_logo`= NULL
        WHERE`startup_email`='$email_id'";
        $resultDeleteProfileImage = mysqli_query($conn, $sqlDeleteProfileImage) ?: throw new Exception(mysqli_error($conn));


        $file_path =  "../profile-images/" . $profile_image_url;

        unlink($file_path) ?: throw new Exception("Error");
        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
        Image Deleted !!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>';
    } catch (\Throwable $th) {
        //throw $th;
        mysqli_rollback($conn);
        //echo $th;
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


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-modal_chart'])) {

    $revenue = $_POST['revenue'];
    $net_profit = $_POST['net_profit'];
    $year = $_POST['year'];

    mysqli_begin_transaction($conn);
    mysqli_autocommit($conn, FALSE);


    try {


        $sqlInsertStartupChart = "INSERT INTO `startup_analysis`(`s_revenue`, `s_net_profit`, `s_year`, `user_id`) VALUES ('$revenue','$net_profit','$year','$user_id')";


        $resultInsertStartupChart = mysqli_query($conn, $sqlInsertStartupChart) ?: throw new Exception(mysqli_error($conn));

        mysqli_commit($conn);

        echo '<div class="toast show align-items-center text-white bg-info border-0 mt-2 mx-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
            <div class="toast-body">
          Details Updated !!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>';
    } catch (\Throwable $th) {
        //throw $th;

        mysqli_rollback($conn);
        //echo $th;
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





<div class="container">
    <div class="main-body">


        <div class="row gutters-sm mt-5">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">


                            <button type="button" class="btn btn-light " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fa-solid fa-pencil"></i></button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">



                                                <div class="mb-3">
                                                    <label for="recipient-website" class="col-form-label">Website
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-website" value="<?php echo $rowSelectStartup['startup_website']; ?>" placeholder="<?php echo $rowSelectStartup['startup_website']; ?>" name="website">

                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Linked In
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-name" value="<?php echo $rowSelectStartup['startup_linkedin']; ?>" placeholder="<?php echo $rowSelectStartup['startup_linkedin']; ?>" name="linkedin">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-twiiter" class="col-form-label">Twitter :
                                                    </label>
                                                    <input type="text" class="form-control" id="recipient-twitter" value="<?php echo $rowSelectStartup['startup_twitter']; ?>" placeholder="<?php echo $rowSelectStartup['startup_twitter']; ?>" name="twitter">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-instagram" class="col-form-label">Instagram
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-instagram" value="<?php echo $rowSelectStartup['startup_instagram']; ?>" placeholder="<?php echo $rowSelectStartup['startup_instagram']; ?>" name="instagram">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-facebook" class="col-form-label">Facebook
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-facebook" value="<?php echo $rowSelectStartup['startup_facebook']; ?>" placeholder="<?php echo $rowSelectStartup['startup_facebook']; ?>" name="facebook">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-founder" class="col-form-label">Founder
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-founder" value="<?php echo $rowSelectStartup['startup_founder']; ?>" placeholder="<?php echo $rowSelectStartup['startup_founder']; ?>" name="founder">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-founded_in" class="col-form-label">Founded In
                                                        :</label>
                                                    <input type="number" class="form-control" id="recipient-founded_in" value="<?php echo $rowSelectStartup['startup_founded_in']; ?>" placeholder="<?php echo $rowSelectStartup['startup_founded_in']; ?>" name="founded_in">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-revenue" class="col-form-label">Revenue
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-revenue" value="<?php echo $rowSelectStartup['startup_revenue']; ?>" placeholder="<?php echo $rowSelectStartup['startup_revenue']; ?>" name="revenue">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-net_profit" class="col-form-label">Net Profit
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-net_profit" value="<?php echo $rowSelectStartup['startup_net_profit']; ?>" placeholder="<?php echo $rowSelectStartup['startup_net_profit']; ?>" name="net_profit">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-company_size" class="col-form-label">Company
                                                        Size
                                                        :</label>
                                                    <input type="number" class="form-control" id="recipient-company_size" value="<?php echo $rowSelectStartup['startup_size']; ?>" placeholder="<?php echo $rowSelectStartup['startup_size']; ?>" name="company_size">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-recent_funding" class="col-form-label">Recent
                                                        Funding
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-recent_funding" value="<?php echo $rowSelectStartup['startup_recent_funding']; ?>" placeholder="<?php echo $rowSelectStartup['startup_recent_funding']; ?>" name="recent_funding">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-domain" class="col-form-label">Domain

                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-domain" value="<?php echo $rowSelectStartup['startup_domain']; ?>" placeholder="<?php echo $rowSelectStartup['startup_domain']; ?>" name="domain">

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="btn-modal1">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>


                        <div class="d-flex flex-column align-items-center text-center">
                            <?php

                            if ($rowSelectStartup['startup_logo'] !== NULL) {

                                echo  ' <img src="../profile-images/' . $rowSelectStartup['startup_logo'] . '" alt="Admin"
                                        class="rounded-circle" width="150">';
                            } else {
                                echo ' <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                        class="rounded-circle" width="150">';
                            }
                            ?>
                            <div class="mt-3">
                                <h4><?php echo $rowSelectStartup['startup_name']; ?></h4>

                                <p class="text-muted font-size-sm"> <?php echo $rowSelectStartup['startup_address']; ?>
                                </p>
                                <form action="" method="POST">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button type="button" class="btn btn-outline-info btn-sm " data-bs-toggle="modal" data-bs-target="#exampleModal8" data-bs-whatever="@mdo"> Edit Profile <i class="fa-solid fa-pencil"></i></button>

                                        <input class="form-control form-control-sm" type="hidden" value="<?php echo $rowSelectStartup['startup_logo']; ?>" name="profile_image" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                        <button type="submit" class="btn btn-info btn-sm" name="btn-delete-profile-img">Delete Profile Pic <i class="fa-solid fa-trash-can mx-1"></i></button>



                                    </div>
                                </form>

                                <div class="modal fade" id="exampleModal8" tabindex="-1" aria-labelledby="exampleModalLabel8" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel8">Update Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="formFileSm1" class="form-label">Small file
                                                            input example</label>
                                                        <input class="form-control form-control-sm" id="formFileSm1" type="file" name="profile_image" required>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="btn-modal8">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>Website</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_website']) ? 'Not Linked' : $rowSelectStartup['startup_linkedin']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="fa-brands fa-linkedin"></i> Linked In</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_linkedin']) ? 'Not Linked' : $rowSelectStartup['startup_linkedin']; ?></span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                    </path>
                                </svg>Twitter</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_twitter']) ? 'Not Linked' : $rowSelectStartup['startup_twitter']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>Instagram</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_instagram']) ? 'Not Linked' : $rowSelectStartup['startup_instagram']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>Facebook</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_facebook']) ? 'Not Linked' : $rowSelectStartup['startup_facebook']; ?></span>
                        </li>
                    </ul>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-people-group"></i></span>Founder
                            </h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_founder']) ? 'Not Linked' : $rowSelectStartup['startup_founder']; ?></span>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>Founded
                                in </h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_founded_in']) ? 'Not Linked' : $rowSelectStartup['startup_founded_in']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-magnifying-glass-dollar"></i></span>Revenue</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_revenue']) ? 'Not Linked' : $rowSelectStartup['startup_revenue']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-chart-line"></i></span>Net Profit
                            </h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_net_profit']) ? 'Not Linked' : $rowSelectStartup['startup_net_profit']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-user-group"></i></span>Company Size
                            </h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_size']) ? 'Not Linked' : $rowSelectStartup['startup_size']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-sack-dollar"></i></span>Recent
                                Funding</h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_recent_funding']) ? 'Not Linked' : $rowSelectStartup['startup_recent_funding']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><span class="m-1"><i class="fa-solid fa-briefcase"></i></span>Domain
                            </h6>
                            <span class="text-secondary"><?php echo empty($rowSelectStartup['startup_domain']) ? 'Not Linked' : $rowSelectStartup['startup_domain']; ?></span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">


                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Company Name
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-name" value="<?php echo $rowSelectStartup['startup_name']; ?>" placeholder="<?php echo $rowSelectStartup['startup_name']; ?>" name="company_name" required>

                                                </div>



                                                <div class="mb-3">
                                                    <label for="recipient-phone" class="col-form-label">Phone
                                                        :</label>
                                                    <input type="number" class="form-control" id="recipient-phone" value="<?php echo $rowSelectStartup['startup_phone']; ?>" placeholder="<?php echo $rowSelectStartup['startup_phone']; ?>" name="phone" required>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Address :</label>
                                                    <textarea class="form-control" id="message-text" value="<?php echo $rowSelectStartup['startup_address']; ?>" placeholder="<?php echo $rowSelectStartup['startup_address']; ?>" name="address" required></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="recipient-valuation" class="col-form-label">Valuation
                                                        :</label>
                                                    <input type="text" class="form-control" id="recipient-valuation" value="<?php echo $rowSelectStartup['startup_valuation']; ?>" placeholder="<?php echo $rowSelectStartup['startup_valuation']; ?>" name="valuation" required>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="btn-modal2">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Company Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_name']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_phone']; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_address']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Valuation</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $rowSelectStartup['startup_valuation']; ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>



                <div class="row gutters-sm">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    About
                                </button>

                            </h2>

                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">


                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">About
                                                                    :</label>
                                                                <textarea class="form-control" id="message-text" name="about"></textarea>
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="btn-modal3">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo empty($rowSelectStartup['startup_about']) ? 'No Information Available Currently' : $rowSelectStartup['startup_about']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    History
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal4" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">


                                                            <div class="mb-3">
                                                                <label for="message-history" class="col-form-label">History :</label>
                                                                <textarea class="form-control" id="message-history" name="history"></textarea>
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="btn-modal4">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo empty($rowSelectStartup['startup_history']) ? 'No Information Available Currently' : $rowSelectStartup['startup_history']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Problem & Solution
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal5" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel5" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">


                                                            <div class="mb-3">
                                                                <label for="message-problem_solution" class="col-form-label">Problem & Solution :</label>
                                                                <textarea class="form-control" id="message-problem_solution" name="problem_solution"></textarea>
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="btn-modal5">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo empty($rowSelectStartup['startup_problem_solution']) ? 'No Information Available Currently' : $rowSelectStartup['startup_problem_solution']; ?>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    Product Images
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal6" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel6" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">


                                                            <div class="mb-3">
                                                                <label for="formFileSm" class="form-label">Small file
                                                                    input example</label>
                                                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="product_image">
                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="btn-modal6">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                    mysqli_begin_transaction($conn);
                                    mysqli_autocommit($conn, FALSE);


                                    try {

                                        $sqlSelectImage = "SELECT * FROM `startup_images` WHERE user_id='$user_id'";
                                        $resultSelectImage = mysqli_query($conn, $sqlSelectImage) ?: throw new Exception(mysqli_error($conn));

                                        $numSelectImage = mysqli_num_rows($resultSelectImage);

                                        if ($numSelectImage != 0) {
                                            echo '<div class="row row-cols-1 row-cols-md-2 g-4">';
                                            while ($rowSelectImage = mysqli_fetch_assoc($resultSelectImage)) {

                                                echo '<div class="col">
                                                    <div class="card">
                                                    <img src="../uploads/' . $rowSelectImage['image_url'] . '" class="img-fluid  card-img-top  img-thumbnail" alt="...">
                                                        <form action="" method="POST">
                                                        <input class="form-control form-control-sm" type="hidden" value="' . $rowSelectImage['image_url'] . '" name="product_image" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                                        <button type="submit" class="btn btn-outline-info btn-sm m-2" name="btn-delete-img">Delete<i class="fa-solid fa-trash-can mx-1"></i></button>
                                                        </form>


                                                    
                                                    </div>
                                                </div>';
                                            }
                                            echo '</div>';
                                        }
                                    } catch (\Throwable $th) {
                                        //throw $th;
                                        echo $th;
                                    }


                                    ?>



                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                    Documents
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">

                                <div class="accordion-body">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal7" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel7" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">


                                                            <div class="mb-3">
                                                                <label for="formFileSm1" class="form-label">Small file
                                                                    input example</label>
                                                                <input class="form-control form-control-sm" id="formFileSm1" type="file" name="document">
                                                            </div>



                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="btn-modal7">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <?php

                                    mysqli_begin_transaction($conn);
                                    mysqli_autocommit($conn, FALSE);


                                    try {

                                        $sqlSelectDocument = "SELECT * FROM `startup_documents` WHERE user_id='$user_id'";
                                        $resultSelectDocument = mysqli_query($conn, $sqlSelectDocument) ?: throw new Exception(mysqli_error($conn));

                                        $numSelectDocument = mysqli_num_rows($resultSelectDocument);

                                        if ($numSelectDocument != 0) {
                                            echo '<div class="row row-cols-1 row-cols-md-2 g-4">';
                                            while ($rowSelectDocument = mysqli_fetch_assoc($resultSelectDocument)) {

                                                echo '<div class="col">
                                                <div class="card">
                                                
                                                <iframe src="../documents/' . $rowSelectDocument['startup_document'] . '" height="300px">
                                                </iframe>
                                                <form action="" method="POST">
                                                <input class="form-control form-control-sm" type="hidden" value="' . $rowSelectDocument['startup_document'] . '" name="document" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                                <button type="submit" class="btn btn-outline-info btn-sm m-2" name="btn-delete-document">Delete<i class="fa-solid fa-trash-can mx-1"></i></button>
                                                </form>

                                                    


                                                
                                                </div>
                                            </div>';
                                            }
                                            echo '</div>';
                                        }
                                    } catch (\Throwable $th) {
                                        //throw $th;
                                        echo $th;
                                    }




                                    ?>





                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                    Company Performance
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSix">

                                <div class="row accordion-body ">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal_chart" data-bs-whatever="@fat"><i class="fa-solid fa-pencil"></i></button>

                                        <div class="modal fade" id="exampleModal_chart" tabindex="-1" aria-labelledby="exampleModalLabel_chart" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">

                                                            <div class="row mb-3">
                                                                <label for="year" class="col-sm-2 col-form-label">Year</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" class="form-control" id="year" placeholder="eg. 2020" name="year" required>
                                                                </div>
                                                            </div>


                                                            <div class="row mb-3">
                                                                <label for="revenue" class="col-sm-2 col-form-label">Revenue</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" class="form-control" id="revenue" placeholder="eg. 1200000" name="revenue" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="profit" class="col-sm-2 col-form-label">Profit</label>
                                                                <div class="col-sm-10">
                                                                    <input type="pasnumber" class="form-control" id="profit" placeholder="eg. 1200000" name="net_profit" required>
                                                                </div>
                                                            </div>




                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="btn-modal_chart">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <?php

                                    mysqli_begin_transaction($conn);
                                    mysqli_autocommit($conn, FALSE);
                                    $chart_data = '';
                                    $chartDataPresent=true;

                                    try {

                                        $sqlSelectChart = "SELECT * FROM `startup_analysis` WHERE user_id='$user_id'";
                                        $resultSelectChart = mysqli_query($conn, $sqlSelectChart) ?: throw new Exception(mysqli_error($conn));

                                        $numSelectChart = mysqli_num_rows($resultSelectChart);

                                        if ($numSelectChart != 0) {
                                            echo '<table class="table table-striped table-light table-bordered table-hover mt-2">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Revenue (in INR)</th>
                                                <th scope="col">Profit (in INR)</th>
                                              </tr>
                                            </thead>
                                            <tbody>';
                                            $count=1;
                                            while ($rowSelectChart = mysqli_fetch_assoc($resultSelectChart)) {
                                                $chart_data .= "{ year:'" . $rowSelectChart["s_year"] . "', profit:" . $rowSelectChart["s_net_profit"] . ",  revenue:" . $rowSelectChart["s_revenue"] . "}, ";
                                                echo ' <tr>
                                                <th scope="row">'.$count.'</th>
                                                <td>'.$rowSelectChart["s_year"] .'</td>
                                                <td>'.$rowSelectChart["s_revenue"].'</td>
                                                <td>'.$rowSelectChart["s_net_profit"].'</td>
                                              </tr>';
                                              $count++;
                                            }
                                            echo '  </tbody>
                                            </table>';
                                            $chart_data = substr($chart_data, 0, -2);
                                        }
                                        else{
                                            echo 'No Information Available Currently ';
                                            $chartDataPresent=false;
                                        }
                                    } catch (\Throwable $th) {
                                        //throw $th;
                                        echo $th;
                                    }
                                    // echo $chart_data;



                                    ?>
                                    

                                </div>

                                



                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
    <?php

       if($chartDataPresent){
           echo '<h3 class="text-center text-uppercase">Performance Analysis</h3>
           <div class="row">
               
               <div class="col-lg-6 col-sm-12">
               <div class="shadow p-3 mb-5 bg-light rounded"><div id="chart" ></div> </div>                    
               </div>
               <div class="col-lg-6 col-sm-12">
               <div class="shadow p-3 mb-5 bg-light rounded"> <div id="chart_bar" ></div> </div>                        
               </div>
           </div>';
       }


    ?>

    
    
</div>
