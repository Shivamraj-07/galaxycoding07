<!-- connecting files -->

<?php
   include('./includes/connect.php');
   include('./functions/common_functions.php');
  session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Card Details for Payment</title>
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
      .card_image{
         width: 80px;
         height: 80px;
         object-fit: contain;
        
    }
</style>
</head>

<body>
  <!-- nav bar -->
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: rgba(252, 188, 12);">
      <img src="./images/shoplogo - Copy.jpg" alt="" class="logo"   style="height: 100px; width: 100px; border-radius: 50%;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="display_all_product.php" target="_blank">Products</a>
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
        <form class="d-flex"  action=""  method="get">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
         
         <input type="submit"  value="search" class ="btn btn-outline-light" name="search_data_product">

        </form>
        
       </div>
      </div>
    </nav>
    <!-- calling card function -->
    <?php
    
    card();
    ?>
    

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

    <!-- fourth child card details -->
    <div class="container">
        <div class="row">
            <form action="" method="post">
            <table class="table table-bordered text-center">
               
               <tbody>
                <!-- php code for display dynamic data -->
                 <?php
                    
                 global $con;
                 $get_ip_address=getIPaddress();
                 $total_price= 0;
                 $card_query="select * from `card_details` where ip_address= '$get_ip_address'";
                 $result=mysqli_query($con , $card_query);
                 $result_count=mysqli_num_rows($result);
                 if( $result_count>0)
                 {
                    echo "<thead>
                      <tr>
                         <th>Product Title</th>
                         <th>Product Image </th>
                         <th>Quantity</th>
                         <th>Total Price</th>
                         <th>Remove</th>
                         <th colspan='2'>Operation</th>
                      </tr>
                    </thead>";
         while($row=mysqli_fetch_array($result))
                 {
               
           $product_id=$row['product_id'];
           $select_products="select * from `products` where   product_id='$product_id'";
                   $result_products=mysqli_query($con,$select_products);
                   while($row_product_price=mysqli_fetch_array($result_products))
                   {
                     $product_price=array($row_product_price['product_price']);
                     $price_table=$row_product_price['product_price'];
                     $product_title=$row_product_price['product_title'];
                     $product_image2=$row_product_price['product_image2'];


                     $products_values=array_sum($product_price);
                     $total_price+=$products_values;
               


                 ?>
                <tr>
                    <td> <?php echo $product_title ?> </td>
                    <td> <img src='./admin_area/product_images/<?php echo $product_image2 ?>' alt="" class="card_image"></td>
                    <td><input type="text" name="quantity" class="form-input w-80" id=""></td>
                    <?php

                    $get_ip_address=getIPaddress();
                    if(isset($_POST['update_card']))
                    {
                        $quantity=$_POST['quantity'];
                        $update_card="update `card_details` set quantity= $quantity where ip_address='$get_ip_address'";
                        $result_products_quantity=mysqli_query($con, $update_card);

                        $total_price= $total_price* $quantity;

                    }

                // echo  $total_price;

                    ?>
                    <td>₹<?php echo  $price_table ?>/-</td>
                    <td> <input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    <td>
                        <!-- <button class="bg-secondary px-5 border-0 py-1 text-light">
                            Updatates
                        </button> -->
                        <input type="submit" value="Update Card" class="bg-secondary px-5 border-0 py-1 text-light" name="update_card"> 
                        <!-- <button class="bg-secondary px-5 border-0 py-1 text-light">
                            Remove
                        </button> -->
                        <input type="submit" value="Remove Card" class="bg-secondary px-5 border-0 py-1 text-light" name="remove_card"> 
                    </td>
    
                  
                </tr>
                <?php

            }
          }
        }
        else{
          echo "<h2 class='text-center text-danger'>The Card is Empty ....!</h2>";
        }
        ?>
               </tbody>
            </table>
            <!-- total amount -->
            <div class="d-flex mb-5" >
              <?php

              $get_ip_address=getIPaddress();
             
              $card_query="select * from `card_details` where ip_address= '$get_ip_address'";
              $result=mysqli_query($con , $card_query);
              $result_count=mysqli_num_rows($result);
              if( $result_count>0)
              {
               echo " <h4 class='px-4'> Grand Total Amount  ₹<strong class='text-info'>
               $total_price/-</strong>
                </h4>
                <input type='submit' value='Continue Shopping' class='bg-secondary px-5 border-0 py-1 text-light' name='continue_shopping'>
              
                <button class='bg-secondary px-5 border-0 py-2 text-light'><a href='./users_area/checkout.php' class='text-light text-decoration-none' > Checkout Payment </button></a> ";
              }
              else{
               echo "<input type='submit' value='Continue Shopping' class=' px-5 border-0 py-1 text-light' style='background-color: rgb(252, 188, 12);' name='continue_shopping'>";
              }
              if(isset($_POST['continue_shopping']))
              {
                echo "<script>window.open('index.php','_self')</script>";
              }

              ?>
                
            </div>
        </div>
    </div>
</form>

<!-- function for removing card -->


<?php

function remove_card_item()
{
   global $con;
   if(isset($_POST['remove_card']))
   {
    foreach($_POST['removeitem'] as $remove_id)
    {
          echo $remove_id;
          $delete_query="Delete from `card_details` where product_id=$remove_id";
          $run_query= mysqli_query($con,$delete_query);
          if(delete_query)
          {
            echo "<script>alert ('Item Deleted Sucessfully....')</script>";
           echo "<script>window.open('card.php', '_self')</script>";


          }
    }
   }
}
    echo $remove_item= remove_card_item();
?>

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


