<?php 

    include 'includes/db.php';
    $task = $_REQUEST['task'];
    session_start();

    if ($task == 'session_unset') {
       session_destroy();
    }

    if ($task == 'login_user') {

            $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);

            $sQuery = "SELECT * FROM `mst_users` WHERE `Email` = '$user_name' AND `Password` = '$password'";
            $rQuery = mysqli_query($conn,$sQuery);
            $aQuery = mysqli_fetch_array($rQuery,MYSQLI_BOTH);
            $nQuery = mysqli_num_rows($rQuery); 

            if ($nQuery != 0)
            {   
                // $d_arr = [
                //     "id" => 0,
                //     "price" => 0,
                //     "count" => 0,
                //     "user_id" => $aQuery['Id']
                // ];

                // $_SESSION['cart'][] = $d_arr;
                $_SESSION['user_id'] = $aQuery['Id'];
                echo "Success";
            }else{
                echo "Fail";
            }

    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    if ($task == 'signup_user') {

        $name = mysqli_real_escape_string($conn,$_POST['first_name'])." ". mysqli_real_escape_string($conn,$_POST['last_name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $mobile_number = mysqli_real_escape_string($conn,$_POST['mobile_number']);
        $user_role = mysqli_real_escape_string($conn,$_POST['user_role']);
        $password = randomPassword();
        $dLastUpdated = date('Y-m-d H:i:s');

        $iQuery = "INSERT INTO `mst_users` (`Name`,`Email`,`MobileNumber`,`Password`,`UserRole`,`LastUpdated`) VALUES ('$name','$email','$mobile_number','$password','$user_role','$dLastUpdated')";

        echo (mysqli_query($conn,$iQuery)) ? "Insert" : "Fail";
    }
    

    if ($task == "insert_product_infromation") {

        $product_name = mysqli_real_escape_string($conn, $_REQUEST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_REQUEST['product_price']);
        $product_description = mysqli_real_escape_string($conn, $_REQUEST['product_description']);
        $last_updated = date("Y-m-d H:i:s");
        $target_dir = 'product_images/';
        $target_file = $target_dir.basename($_FILES['product_image']['name']);


        $insert_product_qry = "INSERT INTO `products` (`ProductName`, `ProductDescription`, `ProductPrice`, `ProductImagePath`, `LastUpdated`) VALUES ('$product_name','$product_description','$product_price','$target_file','$last_updated')";
        $file_upload_result = move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);

        if ($file_upload_result) {
           echo mysqli_query($conn,$insert_product_qry) ? "Insert" : "Fail";
        }
        
    }


    if ($task == "get_product_details") {

        $product_id = $_REQUEST['id'];

        $select_product_qry = "SELECT * FROM `products` WHERE `id` = $product_id";
        $select_product_qry_result = mysqli_query($conn,$select_product_qry);
        $select_product_qry_rows = mysqli_fetch_array($select_product_qry_result,MYSQLI_BOTH);
        if ($select_product_qry_rows) {
            echo $result = $select_product_qry_rows['Id'].'~'.$select_product_qry_rows['ProductName'].'~'.$select_product_qry_rows['ProductDescription']."~".$select_product_qry_rows['ProductPrice'];
        }else{
            echo "Fail" ;
        }
        
    }

    if ($task == "update_product_information") {

        $product_id = $_REQUEST['product_id'];
        $product_name = mysqli_real_escape_string($conn, $_REQUEST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_REQUEST['product_price']);
        $product_description = mysqli_real_escape_string($conn, $_REQUEST['product_description']);
        $last_updated = date("Y-m-d H:i:s");

        $update_product_qry = "UPDATE `products` SET `ProductName` = '$product_name' , `ProductPrice` = '$product_price', `ProductDescription` = '$product_description', `LastUpdated` = '$last_updated' where `Id` = $product_id";
        if (mysqli_query($conn,$update_product_qry)) {
            echo "Update";
        }else{
            echo "Fail" ;
        }
        
    }

    if ($task == "delete_product") {

        $product_id = $_REQUEST['id'];
        $product_query = "DELETE FROM `products` WHERE `Id` = $product_id";

        if (mysqli_query($conn,$product_query)) {
            echo"Success";
        }else{
            echo "Fail";
        }
        
    }

    if ($task == 'add_product_details_to_cart') {

        $ProductId = mysqli_real_escape_string($conn,$_REQUEST['id']);
        $ProductPrice = mysqli_real_escape_string($conn,$_REQUEST['pprice']);
        $ProductCount = 1;
        $alert = false;
        // session_unset(); die();
        if (!isset($_SESSION['cart'])) {

            $d_arr = array(
                "id" => $ProductId,
                "price" => $ProductPrice,
                "count" => $ProductCount,
            );

            $_SESSION['cart'][] = $d_arr;

        }
        else
        {   
            $flag = 0;
            for ($iii=0; $iii < count($_SESSION['cart']); $iii++) 
            {
                 if ($_SESSION['cart'][$iii]['id'] == $ProductId) 
                 {  
                    $alert = true;
                    $flag = 1;
                 }
            } 


            if ($flag == 0) {
                $d_arr = array(
                        "id" => $ProductId,
                        "price" => $ProductPrice,
                        "count" => $ProductCount,
                    );
                 $_SESSION['cart'][] = $d_arr;
                 $alert = false;
            }

            //  $flag= 0;
            // for ($iii=0; $iii < count($_SESSION['cart']); $iii++) 
            // {
            //      if ($_SESSION['cart'][$iii]['id'] == $ProductId) 
            //      {
            //         $_SESSION['cart'][$iii]['count'] += $ProductCount;
            //          $flag = 1;
            //      }
            // } 

            // if($flag == 0)
            // {
            //     $d_arr = array(
            //             "id" => $ProductId,
            //             "name" => $ProductName,
            //             "description" => $ProductDescription,
            //             "price" => $ProductPrice,
            //             "count" => $ProductCount
            //         );
            //      $_SESSION['cart'][] = $d_arr;
            // }
        }


        $TotalCount = 0;
        for ($jjj=0; $jjj < count($_SESSION['cart']); $jjj++) 
        {
            $TotalCount += $_SESSION['cart'][$jjj]['count'];
        }

        echo $TotalCount."~".$alert;
    }



    if ($task == 'increment_count') {

        $ProductId = mysqli_real_escape_string($conn,$_REQUEST['id']);
        $ProductCount = mysqli_real_escape_string($conn,$_REQUEST['count']);

        for ($iii=0; $iii < count($_SESSION['cart']); $iii++) { 

            if ($_SESSION['cart'][$iii]['id'] === $ProductId) {
                $_SESSION['cart'][$iii]['count'] = $ProductCount + 1;
            }

        }

        echo json_encode($_SESSION['cart']);
    }



    if ($task == 'decrement_count') {

        $ProductId = mysqli_real_escape_string($conn,$_REQUEST['id']);
        $ProductCount = mysqli_real_escape_string($conn,$_REQUEST['count']);
        $cart;
        for ($iii=0; $iii < count($_SESSION['cart']); $iii++) { 

            if ($_SESSION['cart'][$iii]['id'] === $ProductId) {

                if ($ProductCount != 0) {
                    $_SESSION['cart'][$iii]['count'] = (--$ProductCount);
                    $cart = $_SESSION['cart'];
                }

            }

        }

        echo json_encode($cart);
    }


    if ($task == 'delete_product_from_cart') {

        $ProductId = mysqli_real_escape_string($conn,$_REQUEST['id']);
        $result;
        for ($iii=0; $iii < count($_SESSION['cart']); $iii++) { 
            if ($_SESSION['cart'][$iii]['id'] === $ProductId) {
                $key = array_search($_SESSION['cart'][$iii]['id'], array_column($_SESSION['cart'], 'id'));
                array_splice($_SESSION['cart'], $key, 1);
                $result = true;
            }
        }

        echo ($result) ? true : false;
    }

?>
