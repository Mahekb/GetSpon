<?php
$target_dir = "Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    
    $uploadOk = 1;
  } else {
    
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Sorry, only JPG, JPEG and PNG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>


<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
 if($check !== false) {
 $uploadOk = 1;
 } else {
 echo '<div class="alert alert-danger">File is not an image.</div>';
 $uploadOk = 0;
 }
}
if (file_exists($target_file)) {
 echo '<div class="alert alert-danger">Sorry, file already exists.</div>';
 $count=1;
 $uploadOk = 0;
 }
 if ($_FILES["fileToUpload"]["size"] > 500000) {
 echo '<div class="alert alert-danger">Sorry, your file is too large.</div>';
 $uploadOk = 0;
 }
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
 echo '<div class="alert alert-danger">Sorry, only JPG, JPEG, PNG & GIF files are
allowed.</div>';
 $uploadOk = 0;
}
if ($uploadOk == 0) {
 echo '<div class="alert alert-danger">Sorry, your file was not uploaded.</div>';
} else {
 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
 // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
 echo '<div class="alert alert-success">Sucess, your file uploaded.</div>';
 } else {
 echo '<div class="alert alert-danger">Sorry, your file was not uploaded.</div>';
 }
 // $url='uploads/'.$_FILES["fileToUpload"]["name"];
 $url=$target_file;
 $GLOBALS['url']=$url;
}
