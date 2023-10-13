<?php 

    include 'includes/header.php';
    $emptyCartBlock = '<div class="d-flex flex-row justify-content-between align-items-center mt-4 rounded">
                        <div class="d-flex flex-row align-items-center"><h5 class="text-grey mt-1 mr-1 ml-1"><i>No Products In The Cart</i></h5>
                        </div>
                    </div>';

?>
<style type="text/css">
    .rounded{
            border: 1px solid rgba(0,0,0,.125);
                box-shadow: 0px 3px 24px #d7dddf;
                    padding: 0.8rem 1.6rem;
    }
    .fa{
        cursor: pointer;
    }
</style>
<div class="container mt-3">
    <div class="row mt-4">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="row mt-2">
                    <div class="col-md-3">
                        <h4>Shopping cart</h4>
                    </div>
                    <?php if (!empty($_SESSION['cart'])) { ?>
                        <div class="col-md-9">
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger clear_cart">CLEAR CART</a>
                        </div>
                    <?php } ?>
                </div>
                <div class="emptyCartBlock">
                    <?php 
                    $Grand_Total = 0;
                    if (!empty($_SESSION['cart'])) { 
                       
                            for ($iii=0; $iii < count($_SESSION['cart']); $iii++) 
                            { 
                                $ProductQuantity = $_SESSION['cart'][$iii]['count'];
                                $Id = $_SESSION['cart'][$iii]['id'];

                                $select_product_qry = "SELECT `ProductPrice`, `ProductName` FROM `products` WHERE `id` = $Id";
                                $select_product_qry_result = mysqli_query($conn,$select_product_qry);
                                $select_product_qry_row = mysqli_fetch_array($select_product_qry_result,MYSQLI_BOTH);

                                $ProductName = $select_product_qry_row['ProductName'];
                                $ProductPrice = $select_product_qry_row['ProductPrice'];
                                $ProductImagePath = $select_product_qry_row['ProductImagePath'] ?? '';

                                $ProductTotalPrice = $ProductQuantity * $ProductPrice;
                                
                             if ($ProductQuantity != 0) 
                                { 

                                ?>

                                    <div class="d-flex flex-row justify-content-between align-items-center mt-4 rounded">
                                        <div class="d-flex flex-column align-items-center product-details"><b class="font-weight-bold"> <?php echo  $ProductName; ?> </b>
                                            <small><i>Price Per Item : <?php echo $ProductPrice; ?></i></small>
                                        </div>
                                        <div class="d-flex flex-row align-items-center qty"><i class="fa fa-minus text-danger product_count_var" alt="<?php echo $_SESSION['cart'][$iii]['id']; ?>"></i>
                                            <h5 class="text-grey mt-1 mr-1 ml-1" style="padding: 0.3rem;"><?php echo $ProductQuantity; ?></h5><i class="fa fa-plus text-success product_count_var" alt="<?php echo $Id; ?>"></i>
                                        </div>
                                        <div>
                                            <h5 class="text-grey">₹ <?php echo $ProductTotalPrice; ?></h5>
                                        </div>
                                        <div class="d-flex align-items-center"><i class="fa fa-trash mb-1 text-danger delete_product" alt='<?php echo $Id; ?>'></i></div>
                                    </div>
                                
                        <?php } $Grand_Total += $ProductTotalPrice; 

                           }  if ($Grand_Total != 0) { ?>

                            <div class="row mt-3 rounded">
                                <div class="col-md-12">
                                    <div class="d-flex flex-row justify-content-between align-items-center mt-4">
                                        <div class="mt-1 pl-2">
                                            <h5 class="text-grey">Total Price</h5>
                                        </div>
                                        <div class="mt-1 mr-1">
                                            <h5 class="text-grey grandTotal">₹ <?php echo $Grand_Total; ?></h5>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mt-2" style="text-align: end;"><button class="btn btn-success ml-2 pay-button" type="button">Proceed to Pay</button></div>
                                </div>
                            </div>

                            <?php }  else { echo $emptyCartBlock; 

                        } }else{ echo $emptyCartBlock; } ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php 

   include 'includes/footer.php';

?>



<script type="text/javascript">
    
    $('.product_count_var').click(function (event) {

        var productId = this.getAttribute('alt');
        var productCountTask, productCount, incrementDecrementCountInnerText, totalPricePerProductInnerText;
        
        if (this.classList[1] == 'fa-minus') {

            productCount = Number(this.nextElementSibling.innerText.trim());
            incrementDecrementCount = this.nextElementSibling;
            productCountTask = "decrement_count";
            totalPricePerProduct = this.parentElement.nextElementSibling.firstElementChild;

        }else{

            productCount = Number(this.previousElementSibling.innerText.trim());
            totalPricePerProduct = this.parentElement.nextElementSibling.firstElementChild;
            incrementDecrementCount = this.previousElementSibling;
            productCountTask = "increment_count";
        }

        var jqxhrn = $.get("index_db_operations.php?id="+productId+"&count="+productCount+"&task="+productCountTask, function() {}).done(function(data) {

            var data = JSON.parse(data);
            var grandTotal = 0;
            var productTotalPrice;
            var totalCount = 0;
            for (var i = 0; i < data.length; i++) {

                if (Number(data[i].id) == productId)  
                {
                    incrementDecrementCount.innerText = data[i].count;
                    totalPricePerProduct.innerHTML =  "₹ "+(data[i].count * Number(data[i].price));
                }

                productTotalPrice = (data[i].count * Number(data[i].price));
                grandTotal += productTotalPrice;
                totalCount += data[i].count;
                if (data[i].count == 0) { window.location.reload(true); }
                $('.count').text(totalCount);
            }

            (totalCount == 0) ? $('.emptyCartBlock').empty().append(`<?php echo $emptyCartBlock; ?>`) : false;
            $('.grandTotal').text("₹ "+grandTotal);

        }); 


    })

    $('.clear_cart').click(function () {
       if (confirm("Are you sure, you want to clear cart, After this cart will be empty ?")) 
       {
            var jqxhrn = $.get("index_db_operations.php?task=session_unset", function() {}).done(function(data) {
                alert("Your cart has been empty");
                window.location.reload(true);
            });

       }else{

            return false;
       }
    })

    $('.delete_product').click(function () {
        var id = this.getAttribute('alt');
        var jqxhrn = $.get("index_db_operations.php?id="+id+"&task=delete_product_from_cart", function () {}).done(function (data) {
          //  console.log(data);
           if (data.trim()) 
           {
                alert("Product Removed From The Cart Successfully."); 
                location.reload();
           }else{
                alert("Error");
           }
        });
    })
</script>