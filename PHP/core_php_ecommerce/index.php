<?php 

    include 'includes/header.php';
    $emptyProductBlock = '<div class="add-card mt-4"><h3 class="text-grey mt-1 mr-1 ml-1"><i>No Products Available in the Database</i></h3></div>';
    
?>

<div class="container mt-3">
    <div class="row mt-4">
        <?php 
            $item_query = "SELECT * FROM `products` ORDER BY `LastUpdated` DESC";
            $item_query_result = mysqli_query($conn,$item_query);
            $item_query_num_row = mysqli_num_rows($item_query_result);
            if ($item_query_num_row > 0) {

                while ($item_query_result_row = mysqli_fetch_array($item_query_result,MYSQLI_BOTH)) {
                    
                    $Id = $item_query_result_row['Id'];
                    $ProductName = $item_query_result_row['ProductName'];
                    $ProductDescription = htmlspecialchars($item_query_result_row['ProductDescription']);
                    $ProductPrice = $item_query_result_row['ProductPrice'];
                    $LastUpdated = date("d-m-Y H:m:s", strtotime($item_query_result_row['LastUpdated']));

                ?>

                <div class="product_card col-md-4 mt-4"> 
                    <div class="row">
                        <div class="col-md-5">
                            <h4 class="mt-2">Price : <i>₹ <?php echo $ProductPrice; ?></i></h4>
                        </div>
                        <div class="col-md-7">
                            <div class="product">
                                <h3><?php echo $ProductName; ?></h3>
                                <p><?php echo substr($ProductDescription, 0, 110); ?> ...</p>
                                <button class="btn btn-sm btn-primary add_to_cart" alt="<?php echo $Id."~".$ProductPrice; ?>">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!--
                <div class="col-md-4 mt-4"> 
                    <div class="product-card">
                        <h3><?php echo $ProductName; ?></h3>
                        <img class="mt-3" src="<?php echo $ProductImagePath; ?>">
                        <p class="mt-4 text-justify"><?php echo $ProductDescription; ?></p>
                        <h5 class="mt-3">Price : <i>₹ <?php echo $ProductPrice; ?></i></h5>
                    </div>
                     <div class="card">
                      <div class="card-header">
                        <h3><?php echo $ProductName; ?></h3>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">₹ <?php echo $ProductPrice; ?></h5>
                        <p class="card-text"><?php echo $ProductDescription; ?></p>
                      </div>
                      <div class="card-footer">
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm add_to_cart" alt='<?php echo $Id; ?>'>Add To Cart</a>
                      </div>
                    </div> 
                </div> -->
        <?php } }else{ echo $emptyProductBlock; } ?>
    </div>
</div>


<?php 

    include 'includes/footer.php';

?>

<script type="text/javascript">

$("#form_submit").submit(function(event) {
    if (confirm("Are you sure, you want to submit this record ?")) {
        event.preventDefault();
        var form = $('#form_submit')[0];
        var data = new FormData(form);
        jQuery.ajax(
        {
            type: "POST",
            enctype: 'multipart/form-data',
            url: "index_db_operations.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(data) 
            {   
                if (data.trim() == "Insert") 
                {
                     alert("Record Inserted Successfully ..");
                     window.location.reload(true);

                }else if(data.trim() == "Update"){

                    alert("Record Updated Successfully ..");
                    window.location.reload(true);
                     
                }else{
                    alert("error");
                }
            }
               
        });
    }else{
        return false;
    }
});

$('.delete_record').click(function () {
   if (confirm("Are you sure, you want to delete this record ?")) 
   {
    var id = this.getAttribute('alt');
    jQuery.ajax(
    {
        type: "POST",
        enctype: 'multipart/form-data',
        url: "index_db_operations.php?id="+id+"&task=delete_product",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function(data) 
        {   
            if (data.trim() == "Success") 
            {
                 alert("Record Deleted Successfully ..");
                 window.location.reload(true);
            }else{
                alert("error");
            }
        }
           
    });
   }else{
        return false;
   }
});


$('.edit_record').click(function () {
    var id = this.getAttribute('alt');
    var jqxhrn = $.get("index_db_operations.php?id="+id+"&task=get_product_details", function() {}).done(function(data) {
        var result = data.split("~");
        $('#task').empty().val('update_product_information');
        $('#product_id').val(result[0].trim());
        $('#product_name').val(result[1].trim());
        $('#product_description').val(result[2].trim());
        $('#product_price').val(result[3].trim());
    }); 
});


$('.add_to_cart').click(function (e) {

    var data = this.getAttribute('alt');
    var dataArr = data.split("~");
    var id = dataArr[0];
    var price = dataArr[1];

    var jqxhrn = $.get("index_db_operations.php?id="+id+"&pprice="+price+"&task=add_product_details_to_cart", function() {}).done(function(data) {
         // $('.count').empty().text(data.trim());
         var productData = data.split("~");
         $('.count').empty().text(productData[0].trim());
         if (productData[1]) {
            alert("Product Already In The Cart.");
            window.location.href = 'http://localhost/tasks/innovins_task/cart.php';
         }else{
            return false;
         }
    }); 

})

</script>