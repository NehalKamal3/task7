<?php
session_start();
  //var_dump($_SESSION);
include "./layout/header.php";
$username =null;
$email =null;
$pass =null;
$allowed_ext = ['png' , 'jpg' , 'jpeg','webp'];

$error='' ; $uerror = []; $emailerror=null; $passerror=null;$imgerror = null ;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset($_POST['signup'])){

    $username =$_POST['uname'];
    $email =$_POST['email'];
    $pass =$_POST['password'];


    $_SESSION['username']=$username;
    $_SESSION['pass']=$pass;
    $_SESSION['email']=$email;
     
    if(isset($_FILES['image']) ){

    if($_FILES['image']['error'] != 4) {
        $img=$_FILES['image'];
  $tmp = $_FILES['image']['tmp_name'] ;
  $url = 'uploads/profiles/'  ;
  $name = uniqid() . $_FILES['image']['name'];

  $imgsize = $img['size'] ;
  $imgext = explode('.', $name);
  $imgend= end($imgext);
  $ext = strtolower($imgend);

   if($imgsize < 2097152) {
  if(in_array($ext , $allowed_ext)){
    move_uploaded_file($tmp ,  $url.$name) ;
    
  }else{
    $imgerror[] = ' files muxt be of types : png , jpg , jpeg ,webp ';
  }
}else{

    $imgerror[]=' file max is 2 miga ';
}

   
}
  

}else{
    $imgerror[]='please choose file ';
}


 //header("location: profile.php");
 if(empty( $username || $pass  ||   $email ) ){
   
    $error= "please fill all data";  
  
  }

if(!preg_match("/^[a-zA-Z]+$/",$username) || strlen($username) > 33){
    $uerror= " username must be all charectars ";
    
 }

if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/" , $email)){
    $emailerror ="please enter a valid email";
     }


  if(strlen(trim($pass)) < 7){
    $passerror ="password must be more than 7 numbers";
 }

 if(empty($_FILES['image']['name'])) {
    $imgerror[] =' image is requierd ';
 }else{
    $_SESSION['img']=$url.$name;
 }

 if(empty($error || $uerror || $imgerror || $emailerror || $passerror || $imgerror  )){
 
    header('location:profile.php');
  //  die;

}}
}






?>
<!-- Button trigger modal -->
<form method="post"  class="form-control"  enctype="multipart/form-data"  style="width:433px ;margin-left:488px; padding-bottom:77px" >

<?php if(isset($error) && !empty($error)  ):
   echo "<div class='alert alert-danger' role='alert'>$error</div>";
endif;
 ?>  
   
                <div class="mb-1 w-100 h-55"   >
              
                <div class="input-group mb-3">
  <input type="text" name="uname" class="form-control" placeholder="Username" aria-label="Username"></div>
  <?php 
   if(isset($uerror) && !empty($uerror)  ): 
        echo "<div class='alert alert-danger' role='alert'>$uerror</div>";
  endif;
        ?>

      <input type="text" name="email" class="form-control"  placeholder="email"    aria-describedby="emailHelp">
      <?php  if(isset($emailerror) && !empty($emailerror)  ): 
        echo "<div class='alert alert-danger' role='alert'>$emailerror</div>";
      endif;
        ?>
                </div>
                <div class="mb-3  w-100 ">
               
                  <input type="password" name="password" placeholder="password"  class="form-control" >
                  <?php  if(isset($passerror) && !empty($passerror)  ): 
        echo "<div class='alert alert-danger' role='alert'>$passerror</div>";
                  endif;
        ?>
                </div>
               
                
                <div class="mb-3 w-100 ">
  
             <input class="form-control" type="file" name="image" placeholder="profile img" >
             <?php if(isset($imgerror) && !empty($imgerror)  ):
             foreach($imgerror as $img):
                echo "<div class='alert alert-danger' role='alert'>$img</div>";
             endforeach;
                  endif;
 ?>  
   

                  </div>

                <button type="submit" name="signup" class="btn btn-primary">sign up</button>
                <button type="submit" name="out" class="btn btn-warning">logout</button>
                <p>have account already!</p>  
                <button type="submit" name="log" class="btn btn-info" href="login.php" >login</button>

              <?php  if(isset($_POST['log'])){
                header("location: login.php");
        
                      }
                      if(isset($_POST['out'])){
                        header("location: logout.php");
                
                              }
                      ?>
            </form>
             
    

  <?php include "./layout/footer.php"; ?>