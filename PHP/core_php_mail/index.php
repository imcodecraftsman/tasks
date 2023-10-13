<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test Mail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
  <form action="index_operations.php" method="post">
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Fill Name">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="form-group">
          <label for="posistions">Select Positions</label>
          <select class="form-control" id="posistions" name="posistions">
            <option value="">Select Positions</option>
            <option value="Position 1">Position 1</option>
            <option value="Position 2">Position 2</option>
            <option value="Position 3">Position 3</option>
            <option value="Position 4">Position 4</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="form-check form-check-inline">
        <input type="radio" name="gender" value="Male">
        <label class="form-check-label">Male</label>
        <input type="radio" name="gender" value="Female">
        <label class="form-check-label">Female</label>
        <input  type="radio" name="gender" value="Secret">
        <label class="form-check-label">Secret</label>
      </div>
    </div>
    <div class="row mt-4">
      <div class="checkbox">
        <label><input type="checkbox"> I confirm that all data are correct</label>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-12 text-center">
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>

<script type="text/javascript"></script>