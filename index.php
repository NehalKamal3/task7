<?php
include "./layout/header.php";
session_start();
//var_dump($_SESSION);
if(isset($_POST['sub'])){
//var_dump($_POST['file']);

echo '<pre>';
//var_dump($_FILES);
echo '<pre>';
//echo $_FILES['myfile']['type'][1];
//echo $_FILES['myfile']['name'];
  //move_uploaded_file($_FILES['myfile']['tmp_name'] , 'uploads/profiles'.$_FILES['myfile']['name']);


$tmp = $_FILES['myfile']['tmp_name'] ;
$url = 'uploads/profiles/'  ;

//move_uploaded_file($_FILES['myfile']['tmp_name']  ,  'uploads/profiles/'.$name) ;

 $c = count($_FILES['myfile']['name']);

for($i =0  ; $i <$c  ;$i++){

  $name =  uniqid() . $_FILES['myfile']['name'][$i];
  move_uploaded_file($_FILES['myfile']['tmp_name'][$i]  ,  'uploads/profiles/'.$name) ;
 

}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<h2  style="margin-left:522px;">welcome to home page</h2>

<form method="post" style="margin-left:399px;padding-bottom:555px;">

<button type="submit" class="btn btn-primary" name="signup" data-bs-toggle="modal" >   signup  </button>

<button style="margin-left:188px;" type="submit" class="btn btn-info" name="login" data-bs-toggle="modal">    login  </button>

<button style="margin-left:188px;" type="submit" class="btn btn-light" name="files" data-bs-toggle="modal">  multifiles  </button>

              <?php 
              if(isset($_POST['signup'])){
        header("location: register.php");

              }     if(isset($_POST['login'])){
                header("location: login.php");
        
                    
                    }     if(isset($_POST['files'])){
                      header("location: multifiles/img.php");
              
                            }
      
?>
</form>
<?php include "./layout/footer.php"; ?>
</body>
</html>