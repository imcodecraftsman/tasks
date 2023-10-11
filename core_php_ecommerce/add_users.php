<?php 

    include 'includes/header.php';
    
?>

<div class="container mt-3">
    <div class="row mt-4">
        <div class="col-xs-12">
              <div class="add-card">
                <h1>Create User</h1>
                  <form id="form_submit" method="post" autocomplete="off">
                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter User First Name." required="true">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter User Last Name." required="true">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter User Email Id" required="true">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="number" name="mobile_number" id="mobile_number" class="form-control" placeholder="Enter User Mobile Number." required="true">
                                </div>
                            </div>
                            <div class="col-lg-4">  
                                <div class="form-group">
                                    <label for="user_role">User Role</label>
                                    <select name="user_role" id="user_role" class="form-control" required="true">
                                        <option value="">Select User Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Client</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group text-center" > 
                                    <input type="hidden" id="user_id" name="user_id">
                                    <input type="hidden" id="task" name="task" value="signup_user">
                                    <input type="submit" name="submit" class="btn btn-success" value="SUBMIT">
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                    </form>
              </div>
        </div>
    </div>
<!--     <div class="row mt-4">
        <div class="col-xs-12">
            <div class="card">
              <div class="card-header bg-primary text-white">Product Details</div>
              <div class="card-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:264px;">Action</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 

                        $item_query = "SELECT * FROM `products` ORDER BY `LastUpdated` DESC";
                        $item_query_result = mysqli_query($conn,$item_query);

                            while ($item_query_result_row = mysqli_fetch_array($item_query_result,MYSQLI_BOTH)) {

                                $Id = $item_query_result_row['Id'];
                                $ProductName = $item_query_result_row['ProductName'];
                                $ProductDescription = $item_query_result_row['ProductDescription'];
                                $ProductPrice = $item_query_result_row['ProductPrice'];
                                $LastUpdated = date("d-m-Y H:m:s", strtotime($item_query_result_row['LastUpdated']));

                        ?>

                            <tr>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info edit_record" alt='<?php echo $Id; ?>'>Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger delete_record" alt='<?php echo $Id; ?>'>Delete</a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success add_to_cart" alt='<?php echo $Id; ?>'>Add To Cart</a>
                                </td>
                                <td><?php echo $ProductName; ?></td>
                                <td><?php echo $ProductDescription; ?></td>
                                <td><?php echo $ProductPrice; ?></td>
                                <td><?php echo $LastUpdated; ?></td>
                            </tr>

                        <?php } ?>
                        </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div> -->
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
        $('#name').val(result[1].trim());
        $('#product_description').val(result[2].trim());
        $('#email').val(result[3].trim());
    }); 
});


</script>