<?php
session_start();
include "./layout/header.php";


?>

<div class="card" style="width: 18rem; margin-left:511px">
  <img src="<?=$_SESSION['img'];?>" class="card-img-top" alt="...">
   <div class="card-body">
    <h5 class="card-title"><?='name :'.$_SESSION['username']?></h5>
    <h5 class="card-title"><?='email :'.$_SESSION['email']?></h5>
    <h5 class="card-title"><?='password :' .$_SESSION['pass']?></h5>
    <p class="card-text">here is your data .</p>
    <a href="logout.php" class="btn btn-warning">logout</a>
    <a href="login.php" class="btn btn-primary">login</a>
  </div>
</div>

<?php include "./layout/footer.php"; ?>
