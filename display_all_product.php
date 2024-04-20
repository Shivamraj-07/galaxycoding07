<!-- connecting files -->
<?php
   include('includes/connect.php');
   include('./functions/common_functions.php');
   session_start();



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display All Products</title>
  <!-- bootstrap css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- fontawsome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css file link -->
  <link rel="stylesheet" href="..\phpcode\style.css">
  <style>
    .logo{ 
    width: 5%;
    height: 7%;
    border-radius: 50%;
}

  </style>

</head>

<body>
  <!-- nav bar -->
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color: rgba(252, 188, 12);">
      <img src="./images/shoplogo - Copy.jpg" alt="" class="logo" style="height: 100px; width: 100px; border-radius: 50%">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href=" index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="display_all_product.php">Products</a>
          </li>
          <?php
        if(isset($_SESSION['username']))
         {
         echo "<li class='nav-item'>
             <a class='nav-link' href='./users_area/profile.php'>My Account</a>
         </li>";
            }else{
              echo "<li class='nav-item'>
                <a class='nav-link' href='./users_area/user_regrastation.php'>Register</a>
            </li>";
         
       }
   ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="card.php"><i class="fa-solid fa-cart-shopping"></i>
              <sup> 
                <?php  
               
                card_item_number(); 
                ?>
               </sup>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Total Price : ₹ <?php total_card_price();?> /-</a>
          </li>

         

        </ul>
        <form class="d-flex" action="search_product.php" method="get">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
          
    

          <input type="submit"  value="Search" class ="btn btn-outline-light" name="search_data_product">


        </form>
      </div>
    </nav>

    <!-- second class -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">

      
        <?php



        if(!isset($_SESSION['username'])){

          echo " <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome Guest</a>
  
          </li>";
         }else{
 
          echo " <li class='nav-item'>
            <a class='nav-link' href=''>Welcome ".$_SESSION['username']."</a>
          </li>";
 
         }
        if(!isset($_SESSION['username'])){

         echo " <li class='nav-item'>
           <a class='nav-link' href='./users_area/user_login.php'>Login</a>
         </li>";
        }else{

         echo " <li class='nav-item'>
           <a class='nav-link' href='./users_area/logout.php'>Logout</a>
         </li>";

        }



       ?>
      </ul>

    </nav>
    <!-- Third class -->
    <div class="bg-warning">
      <h3 class="text-center">GALAXY SHOPPING</h3>
  
    </div>
    <div class="">
      <hr>
      <p class="text-center">Communication Is The Heart Of E-commwerce And Community </p>
      </p>
      <hr>
    </div>
  


    <!-- fourth child -->
    <div class="row px-5">
      <div class="col-md-10">
        <!-- Products -->

        <div class="row">
          <!-- feteching products -->
          <?php
                get_all_products();
                get_unique_category();
                get_unique_brand();
          ?>
          
          <!-- <div class="col-md-4 mb-2">
            <div class="class card">
              <img src="images\apple.jpg" alt=" images not found" class="card-img-top">
              <div class=" card-body">
                <h5 class=" card-title">card title</h5>
                <p class="class-text"> asdfggh</p>
                <a href="" class="btn btn-info"> Add To Cart </a>
                <a href="" class="btn btn-secondary"> View More </a>
              </div>
            </div>
          </div> -->
        </div>
      </div>


      <div class="col-md-2  p-0 " style='background-color: rgb(254,235 ,193 );''>

        <!-- sidenav -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item  text-center" style='background-color: rgb(252, 188, 12);'>
            <a href="#" class="nav-link text-light">
              <h4> Delivery Brands </h4>
            </a>

          </li>
          <!-- Brands names -->
          <?php
                 getbrands();

 
           ?>

          <!-- categories -->
          <ul class="navbar-nav me-auto">
            <li class="nav-item  text-center" style='background-color: rgb(252, 188, 12);'>
              <a href="#" class="nav-link text-light">
                <h4>Categories</h4>
              </a>

            </li>
            <?php
               getcategory();
           ?>

          </ul>
          <!-- 90colomn end last div  -->
      </div>
      <!-- 91row end last div  -->
    </div>


    <!-- last child -->

    <!-- includes footer -->
    <?php
    include('.\includes\footer.php');
    
 
 
 ?>
    
    <!-- bootstrap js link -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"></script>

</body>

</html>