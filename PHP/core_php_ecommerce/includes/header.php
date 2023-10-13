<?php 

    include 'includes/db.php';
    include 'includes/session.php';

    $sQuery = "SELECT * FROM `mst_users` WHERE `Id` = ".$_SESSION['user_id'];
    $rQuery = mysqli_query($conn,$sQuery);
    $aQuery = mysqli_fetch_array($rQuery,MYSQLI_BOTH);
    $UserName = $aQuery['Name'];
    $UserRole = ($aQuery['UserRole'] == 1) ? 'Admin' : 'User';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Innovins Tasks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="includes/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    .card{
      box-shadow: 0px 3px 24px #D7DDDF;
      border-radius: 0.5rem;
      height: 240px;
    }

    .fa-shopping-cart{
      font-size: 1.6rem;
    }

    .count{
          font-size: 0.9rem;
          font-weight: 900;
          position: absolute;
          border-radius: 100%;
          background: #dc3545;
          padding: 0.1rem;
          top: 10px;
          right: 15px;
          width: 20px;
    }

    .form-group label{
      font-weight: bolder;
    }

    .add-card{
        padding: 24px 24px;
        border-radius: 8px;
        box-shadow: 5px 5px 12px 4px #e9e9e9;
    }

    .add-card > h3{
        text-align: center;
    }

    .product_card{
            padding: 16px 16px;
            width: 424px;
            margin-left: 16px;
            background: #fbfbfb;
            box-shadow: 5px 5px 15px rgb(0 0 0 / 25%);
            border-radius: 5px;
            border: 3px solid #0d6efd;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Innovins Tasks</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Products</a>
        </li>
        <?php if ($UserRole == 'Admin') { ?>
            <li class="nav-item">
              <a class="nav-link" href="add_product.php">Add Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_users.php">Add User</a>
            </li>
        <?php } ?>
       
<!--         <li class="nav-item">
          <a class="nav-link" href="V.php">V</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="VI.php">VI</a>
        </li> -->
      </ul>
      <div class="d-flex">
        <a href="javascript:void(0)" class="btn btn-sm btn-danger logout"><i class="fa fa-sign-out" aria-hidden="true">Log Out</i></a>
        &nbsp; &nbsp;
          <?php 
            $TotalCount = 0;
            if (!empty($_SESSION['cart'])) {
              for ($iii=0; $iii < count($_SESSION['cart']); $iii++) 
              {
                  $TotalCount += $_SESSION['cart'][$iii]['count'];
              }
            }
          ?>
          <a href="cart.php" class="fa fa-shopping-cart btn btn-primary"><span class="count"><?php echo $TotalCount; ?></span></a>

      </div>
    </div>
  </div>
</nav>

<h1 class="text-center mt-4"> Welcome, <?php echo $UserName." (".$UserRole.")"; ?></h1>
<script src="includes/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  
  $('.logout').click(function () {
       if (confirm("Are you sure, you want to logout")) 
       {
            var jqxhrn = $.get("index_db_operations.php?task=session_unset", function() {}).done(function(data) {
                window.location.reload(true);
            });

       }else{

            return false;
       }
    })


</script>