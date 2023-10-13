<?php 

    include 'includes/header.php';
    
?>

<div class="container mt-3">
  <div class="row mt-4">
        <div class="col-xs-12">
            <div class="card">
              <div class="card-header bg-primary text-white">Employee Information With Single Query</div>
              <div class="card-body">
                   <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Employee Code</th>
                                <th>Employee Name</th>
                                <th>Employee Salary</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 

                        $employee_details_query = "SELECT * FROM `employee` AS `T1` LEFT JOIN `employee_salary` AS `T2` ON `T1`.`Id` = `T2`.`EmployeeId` ORDER BY `T1`.`LastUpdated`";
                        $employee_details_query_result = mysqli_query($conn,$employee_details_query);

                            while ($employee_details_query_result_row = mysqli_fetch_array($employee_details_query_result,MYSQLI_BOTH)) {

                                $Code = $employee_details_query_result_row['Code'];
                                $Name = $employee_details_query_result_row['Name'];
                                $Salary = $employee_details_query_result_row['Salary'];
                                $LastUpdated = date("d-m-Y H:m:s", strtotime($employee_details_query_result_row['LastUpdated']));

                        ?>

                            <tr>
                                <td><?php echo $Code; ?></td>
                                <td><?php echo $Name; ?></td>
                                <td><?php echo $Salary; ?></td>
                                <td><?php echo $LastUpdated; ?></td>
                            </tr>

                        <?php } ?>
                        </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>

<?php 

   include 'includes/footer.php';

?>