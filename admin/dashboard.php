<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

  <div class="boxed"> <h1 class="heading">dashboard</h1> </div>

   <div class="box-container">


      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         
         <p>total pendings</p>
         <h3><span> Amount - ₹ </span><?= $total_pendings; ?><span>/-</span></h3>
         <a href="placed_orders.php" class="btn">see orders</a>
      
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
         
         <p>completed orders</p>
         <h3><span> Amount - ₹ </span><?= $total_completes; ?><span>/-</span></h3>
         <a href="placed_orders.php" class="btn">see orders</a>
        
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
                  <p>products added</p>
                  <h3><?= $number_of_products; ?></h3>

         <a href="products.php" class="btn">see products</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         
         <p>normal users</p>
         <h3><?= $number_of_users; ?></h3>
         <a href="users_accounts.php" class="btn">see users</a>
      </div>


      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         
         <p>new messages</p>
         <h3><?= $number_of_messages; ?></h3>
         <a href="messages.php" class="btn">see messages</a>
      </div>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>