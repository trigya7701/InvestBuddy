<!-- If aldready signeed in dont show this apage -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../css/authenticate.css">

    <title>InvestBuddy | Investor-Sign Up</title>
</head>

<body>

    <?php

    include_once('db_connect.php');
    $full_name_error = '';
    $email_id_error = '';
    $password_error = '';
    $phone_error = '';
    $address_error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['investor_signup'])) {





        $full_name = $_POST['full_name'];
        $email_id = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];



        if ($full_name == '' || !preg_match("^[a-zA-Z\s]+$^", $full_name)) {
            $full_name_error = "* Please enter a valid name . ";
        }

        if ($email_id == '' || !preg_match("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$^", $email_id)) {
            $email_id_error = "* Please enter a valid email id";
        }

        if ($password == '' ||  strlen($password) < 8 || strlen($password) > 20) {
            $password_error = "* Password Length out of range , enter between 8-20 .";
        }

        if ($phone == '' || !preg_match("^\d{10}$^", $phone)) {
            $phone_error = "* Please enter a valid phone number .";
        }

        if ($address == '' || strlen($address < 8)) {
            $address_error = "* Please enter a valid address.";
        }

        if ($full_name_error == '' && $email_id_error == '' && $password_error == '' && $phone_error == '' && $address_error == '') {


            //Database logic

            mysqli_begin_transaction($conn);
            mysqli_autocommit($conn, FALSE);
            try {
                $transaction = true;

                $sqlInsertUsers = "INSERT INTO `users`(`user_email`, `user_password`, `user_role`) VALUES ('$email_id','$password','Investor')";
                $sqlInsertInvestors = "INSERT INTO `investors`(`investor_name`, `investor_email`,`investor_phone`, `investor_address`)VALUES ('$full_name','$email_id','$phone','$address')";

                $resultInsertUsers = mysqli_query($conn, $sqlInsertUsers) ?: throw new Exception("Query Failed");
                $resultInsertInvestors = mysqli_query($conn, $sqlInsertInvestors) ?: throw new Exception("Query Failed");

                $sqlSelectInvestors = "SELECT `investor_id` FROM `investors` WHERE investor_email='$email_id'";
                $resultSelectInvestors = mysqli_query($conn, $sqlSelectInvestors) ?: throw new Exception("Query Failed");


                $rowSelectInvestors = mysqli_fetch_assoc($resultSelectInvestors);
                $investor_id = $rowSelectInvestors['investor_id'];


                $sqlUpdateUsers = "UPDATE `users` SET`role_id`='$investor_id' WHERE user_email='$email_id'";
                $resultUpdateInvestors = mysqli_query($conn, $sqlUpdateUsers) ?: throw new Exception("Query Failed");

                mysqli_commit($conn);

                echo '<div class="toast show align-items-center text-white bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="d-flex">
                    <div class="toast-body">
                     Registered successfully !!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                </div>';
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
        } else {

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







    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">


        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        The best offer <br />
                        <span style="color: hsl(218, 81%, 75%)">for your business</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Temporibus, expedita iusto veniam atque, magni tempora mollitia
                        dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                        ab ipsum nisi dolorem modi. Quos?
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">

                            <h4 class="text-center">Join as a Investor</h4>
                            <form action="signup_investor.php" method="POST">



                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example1">Full name</label>
                                    <input type="text" id="form3Example1" class="form-control" name="full_name" required />
                                    <p class="error"> <?php echo $full_name_error; ?></p>

                                </div>


                                <!-- Email input -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example3">Email address</label>
                                    <input type="email" id="form3Example3" class="form-control" name="email" required />
                                    <p class="error"> <?php echo $email_id_error; ?></p>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" class="form-control" name="password" required />
                                    <p class="error"> <?php echo $password_error; ?></p>
                                </div>

                                <!-- Phone input -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example5">Phone Number</label>
                                    <input type="number" id="form3Example5" class="form-control" name="phone" required />
                                    <p class="error"> <?php echo $phone_error; ?></p>
                                </div>

                                <!-- Phone input -->
                                <div class="form-outline mb-2">
                                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address" required></textarea>
                                    <p class="error"> <?php echo $address_error; ?></p>
                                </div>


                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4" name="investor_signup">
                                    Sign up
                                </button>

                                <!--Login buttons -->
                                <div class="text-center">

                                    <a href="signup_startup.php">
                                        <p>or Sign up as Startup</p>
                                    </a>
                                    <a href="signin.php">
                                        <p>Have Account ? Sign in</p>
                                    </a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
</body>




</html>