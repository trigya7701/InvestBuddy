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
   
    
    <link rel="stylesheet" href="../css/footer.css"> 

    <title>InvestBuddy | Home</title>
   

</head>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-image: linear-gradient(290deg, #104694,#0a2e65);
  color:  #F8F9FA;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color:  #F8F9FA;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>
</head>
<body>
<?php

session_start();
?>

<?php include('../components/navbar.php'); ?>

<div class="about-section">
  <h1>About Us Page</h1>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>

</div>

<h2  class="my-2 " style="text-align:center">Our Team</h2>
<div class="row px-4">
  <div class="column">
    <div class="card">
      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-fluid mx-auto py-3 " alt="Harsh" width="174" height="100">
      <div class="container">
        <h2>Harsh Shah</h2>
        <p class="title">CEO & Founder</p>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <p>Email : hrs3@somaiya.edu</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-fluid mx-auto py-3 " alt="Trigya" width="174" height="100">
      <div class="container">
        <h2>Trigya Roy</h2>
        <p class="title">CEO & Founder</p>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <p>Email : trigya.roy@somaiya.edu</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="https://bootdey.com/img/Content/avatar/avatar7.png"  class="img-fluid mx-auto py-3 " alt="Dhruva" width="174" height="100">
      <div class="container">
        <h2>Dhruva Biradar</h2>
        <p class="title">CEO & Founder</p>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <p>Email : dhruva.b@somaiya.edu</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>
<?php include('../components/footer.php'); ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
</html>
