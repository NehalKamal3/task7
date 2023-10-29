<?php  
include "../layout/header.php"; 
session_start();?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
<body cz-shortcut-listen="true">
<?php

$errors = [];
$allowed_ext = ['png' , 'jpg' , 'jpeg','webp'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_FILES['images'])  ) {
        $count = count($_FILES['images']['size']);

        if($_FILES['images']['error'][0] != 4) {

            $file   = $_FILES['images'];

            $name  = $file['name'];
            $tmp   = $file['tmp_name'];
            $size  = $file['size'];
            $root  = '../uploads/multi/';
            // $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
            for($i = 0 ; $i < $count ; $i++) {
                $expload = explode('.', $name[$i]);
                $end = end($expload);
                $ext = strtolower($end);
             
                if($size[$i] < 2097152) {
                    if(in_array($ext, $allowed_ext)) {
                        
                        move_uploaded_file($tmp[$i], $root . uniqid() . $name[$i]);
                          // $images =$root.uniqid().$name[$i];
 
                    }else{
                        $errors['type'] = "the file( $name[$i] ) must be of type [png , jpg, jpeg,webp] ";
                    }
                } else {
                    $errors["size$i"] = "file size is too big, max is 2 miga not $size[$i] on file name $name[$i]";
                }
                
            }
        } else {
            $errors['choose'] = 'please choose file';
        }


    }  if(isset($_POST['upload']) && empty($errors)):     
        ?>
        <div class="alert alert-success" role="alert">
          files uploaded succesfully—check it out!
        </div>
        <?php  endif;
}



?>


<?php if(! empty($errors)) : ?>
  <?php foreach($errors as $error) : ?>

    <div class="alert alert-danger">
      <?= $error ?>
    </div>

  <?php endforeach ?>
<?php endif ?>


  <form method="post" enctype="multipart/form-data">
  
  <div class="custom-file">
    <input type="file" multiple class="custom-file-input" name="images[]">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <button class="btn btn-outline-secondary" name="upload" type="submit">upload</button>
  </div><button type="submit" name="out" class="btn btn-warning" style="margin-left:66px;">logout</button>
              <?php  
                
                      if(isset($_POST['out'])){
                        header("location: ../logout.php");
                
                              }
                      ?>
                    </form>         

<?php //include "../layout/footer.php";   ?>
</body>
</html>