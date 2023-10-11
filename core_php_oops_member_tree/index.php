<?php
require_once 'database.php';
$db = new Database();
    $conn = $db->getConnection();
?>


<?php
function buildMemberTree($members, $parentId = 0) {
    $result = "<ul>";
    foreach ($members as $member) {
        if ($member['ParentId'] == $parentId) {
            $result .= "<li>" . $member['Name'];
            $result .= buildMemberTree($members, $member['id']);
            $result .= "</li>";
        }
    }
    $result .= "</ul>";
    return $result;
}

// get members
$query = "SELECT * FROM members"; 
$stmt = $conn->query($query);
$members = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $members[] = $row;
}


?>




<!DOCTYPE html>
<html>
<head>
    <title>Member Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <button id="addMemberButton" class="btn btn-primary">Add Member</button>

    <div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberModalLabel">Add Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="memberForm">
                        <div class="form-group">
                            <label for="parent">Parent:</label>
                            <select id="parent" name="parent" class="form-control">
                                    <?php

                                    $query = "SELECT * FROM members";
                                    $stmt = $conn->query($query);

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['Name'] . "</option>";
                                    }
                                    ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="saveChangesButton" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <ul id="memberList">
        <?php echo buildMemberTree($members); ?>
    </ul>

    <script>
        $(document).ready(function(){

            $("#addMemberButton").click(function(){
                $("#memberModal").modal("show");
            });


            $("#saveChangesButton").click(function(){
                var parent = $("#parent").val();
                var name = $("#name").val();

                if (name == '') {
                    alert("Enter the name");
                }

                $.ajax({
                    url: "save_member.php",
                    type: "POST",
                    data: { parent: parent, name: name },
                    success: function(response){
                        $("#memberList").html(response);
                        $("#memberForm")[0].reset();
                        $("#memberModal").modal("hide");
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>
