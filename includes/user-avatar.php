<?

include_once("./db.php");

// var_dump($_FILES);

$userInfoAll = userInfo();

$photos = $_FILES["avatar"];

foreach ($photos["name"] as $key => $value) {
  $rand_name = md5(time())-"$key";
  $photoExt = pathinfo($value, PATHINFO_EXTENSION);
  $photoName = "{$userInfoAll['user_login']}-$rand_name.$photoExt";
  
  $dirNamePhotos = "./img/users/$photoName";
  
  if ($value) {
    $addUserPhotos = addUserPhotos($dirNamePhotos);
  }
  
  if ($addUserPhotos) {
    move_uploaded_file($photos["tmp_name"][$key], ".$dirNamePhotos");
  }
}

header("Location:/?route=edit");