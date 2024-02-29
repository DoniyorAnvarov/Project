<?

include_once('./db.php');

// var_dump($_POST);
// var_dump($_FILES);

$photo = $_FILES["photo"];
$rand_name = md5(time());
$photoExt = pathinfo($photo["name"], PATHINFO_EXTENSION);
$photoName = is_uploaded_file($photo["tmp_name"]) ? "{$_POST['login']}-$rand_name.$photoExt" : "default.png";

// var_dump($photoExt);
// var_dump($photoName);

$dirNamePhoto = "./img/users/$photoName";

$userReg = userReg($_POST["login"], $_POST["pass"], $_POST["name"], $dirNamePhoto);

if ($userReg && is_uploaded_file($photo["tmp_name"])) {
  move_uploaded_file($photo["tmp_name"], ".$dirNamePhoto");
}

header("Location:/");