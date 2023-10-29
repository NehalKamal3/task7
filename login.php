<?php
  include 'data.php';
include "./layout/header.php";
if(isset($_SESSION['email'] )){


}

$error = null; $emailerror=null; $passerror=null;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset($_POST['log'])){

    $email =$_POST['email'];
    $pass =$_POST['password'];

    foreach($users_data as $user) {
    if($user['email'] == $email && $user['pass'] == $pass){
      //  $_SESSION['username']=$username;
        $_SESSION['pass']=$pass;
        $_SESSION['email']=$email;

    header("location:site.php");

    }else{

        $error='wrong email or password';
    }

}
}



if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/" , $email)){
    $emailerror ="please enter a valid email";
     }


  if(strlen(trim($pass)) < 7){
    $passerror ="password must be not less than 8 numbers";
 }
 
 
 if(empty( $pass  ||   $email ) ){
   
    $error= "please fill all data";  
  
  }

}




?>
<form method="post"  class="form-control"  enctype="multipart/form-data"  style="width:433px ;margin-left:488px; padding-bottom:77px" >

<?php if(isset($error) && !empty($error)  ):
   echo "<div class='alert alert-danger' role='alert'>$error</div>";
endif;
 ?>  
   
                <div class="mb-1 w-100 h-55"   >
       
      <input type="email" name="email" class="form-control"  placeholder="email"    aria-describedby="emailHelp">
      <?php  if(isset($emailerror) && !empty($emailerror)  ): 
        echo "<div class='alert alert-danger' role='alert'>$emailerror</div>";
      endif;
        ?>
                </div>
                <div class="mb-3  w-100 ">
               
                  <input type="text" name="password" placeholder="password"  class="form-control" >
                  <?php  if(isset($passerror) && !empty($passerror)  ): 
        echo "<div class='alert alert-danger' role='alert'>$passerror</div>";
                  endif;
        ?>
                </div>
               

                <button type="submit" name="log" class="btn btn-primary">login</button>
                <a href="logout.php" class="btn btn-warning">logout</a>
                <?php if(isset($_SESSION['email'])):?>
                    <a href="profile.php" class="btn btn-light">profile</a>
              <?php  endif;?>
        
   
            </form>
             
    

  <?php include "./layout/footer.php"; ?>