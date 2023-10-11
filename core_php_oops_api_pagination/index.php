<?php

class Post
{
    public $api = 'https://jsonplaceholder.typicode.com/posts';
    public $data = [];
    public $limit = 10;
    public $records = [];
    public $limitedData = [];

    function __construct()
    {
        $this->data = json_decode(file_get_contents($this->api),true);
    }

    public function getTotalNumberOfPages()
    {
        return ceil(count($this->data) / $this->limit);
    }

    public function getPostData(int $pageNumber){
        
        $this->records = array_chunk($this->data, $this->limit);
        $count = 1;
        for ($i=0; $i < count($this->records); $i++) { 
            if($count === ($pageNumber)){
                $this->limitedData = $this->records[$i];
            }
            $count++;
        }
        return $this->limitedData;
    }

}



$postObject = new Post();
$postPageCount = $postObject->getTotalNumberOfPages();
$value = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
$postsData = $postObject->getPostData($value);


?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>API Posts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
 
<div class="container">
  <h2>Posts</h2>
  <?php  
        foreach ($postsData as $post) {
  ?>
  <div class="panel panel-primary">
    <div class="panel-heading"><?php echo $post['id'].' ==> '.$post['title']; ?></div>
    <div class="panel-body"><?php echo $post['body']; ?></div>
  </div>
 <?php  } ?>


<div class="row mt-4">
    <div class="col-md-12 text-center">
        <ul class="pagination">
            <li class="page-item <?php echo ($value == 1) ? 'disabled' : '' ?>">
              <a class="page-link" href="index.php?page_no=<?php echo $value-1; ?>">Previous</a>
            </li>
            <?php 
                for ($i=0; $i < $postPageCount; $i++) { ?>
                    <li class="<?php echo ($value == ($i+1)) ? 'active' : '' ?>"><a href="index.php?page_no=<?php echo $i+1; ?>"><?php echo ($i+1); ?></a></li>
            <?php } ?>
            <li class="page-item <?php echo ($value == $postPageCount) ? 'disabled' : '' ?>">
              <a class="page-link" href="index.php?page_no=<?php echo $value+1; ?>">Next</a>
            </li>
        </ul>
    </div>
</div>


</div>

</body>
</html>

