<?

function db()
{

  $dbhost = "127.0.0.1";
  $dbname = "gr1230dupay";
  $dblogin = "root";
  $dbpass = "";

  $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dblogin, $dbpass);

  return $dbh;
}

function userReg($login, $pass, $name, $dirPhoto)
{
  $login = strip_tags($login);
  $pass = password_hash($pass, PASSWORD_BCRYPT);
  $name = strip_tags($name);
  $db = db();
  $query = "INSERT INTO `users`(`user_login`, `user_pass`, `user_name`) VALUES (?,?,?)";
  $pdoStat = $db->prepare($query);
  $result = $pdoStat->execute([$login, $pass, $name]);

  if ($result) {
    $userId = $db->lastInsertId();
    $query = "INSERT INTO `images`(`user_id`, `img_path`, `img_select`) VALUES (?,?,?)";
    $imgState = $db->prepare($query);
    $result = $imgState->execute([$userId, $dirPhoto, 1]);
  }
  return $result;
}

function userAuth($login, $pass)
{
  $login = strip_tags($login);
  $db = db();
  $query = "SELECT * FROM `users` INNER JOIN images USING(user_id) WHERE `user_login`=?";
  $pdoStat = $db->prepare($query);
  $pdoStat->execute([$login]);
  $user = $pdoStat->fetch(PDO::FETCH_ASSOC);

  if ($login == $user["user_login"] && password_verify($pass, $user["user_pass"])) {
    session_start();
    $_SESSION["id"] = $user["user_id"];

    return true;
  }

  return false;
}

function userInfo()
{
  session_start();
  $db = db();
  $query = "SELECT `user_login`, `user_name`, images.img_path FROM `users` INNER JOIN images USING(user_id) WHERE user_id=? AND images.img_select=1";
  $pdoStat = $db->prepare($query);
  $pdoStat->execute([$_SESSION["id"]]);
  $result = $pdoStat->fetch(PDO::FETCH_ASSOC);
  // var_dump($pdoStat);
  return $result;
}

// userInfo();

function addUserPhotos($path)
{
  session_start();
  $userId = $_SESSION["id"];
  $db = db();
  $query = "INSERT INTO `images`(`user_id`, `img_path`, `img_select`) VALUES (?,?,?)";
  $pdoStat = $db->prepare($query);
  $result = $pdoStat->execute([$userId, $path, 0]);
  return $result;
}

function getPhotos()
{
  session_start();
  $userId = $_SESSION["id"];
  $db = db();
  $query = "SELECT * FROM `images` WHERE `user_id`=?";
  $pdoStat = $db->prepare($query);
  $pdoStat->execute([$userId]);
  $result = $pdoStat->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function setPhotos($imgId)
{
  session_start();
  $userId = $_SESSION["id"];
  $db = db();
  $query = "UPDATE `images` SET `img_select`=0 WHERE `img_select`=1 AND `user_id`=?";
  $pdoStat = $db->prepare($query);
  $result = $pdoStat->execute([$userId]);

  if ($result) {
    $query = "UPDATE `images` SET `img_select`=1 WHERE `img_id`=? AND `user_id`=?";
    $pdoStat = $db->prepare($query);
    $result = $pdoStat->execute([$imgId, $userId]);
    return $result;
  }

  return $result;
}

function delPhotos($imgId)
{
  session_start();
  $userId = $_SESSION["id"];
  $db = db();
  $query = "SELECT * FROM `images` WHERE `img_id`=? AND `user_id`=?";
  $pdoStat = $db->prepare($query);
  $pdoStat->execute([$imgId, $userId]);
  $result = $pdoStat->fetch(PDO::FETCH_ASSOC);

  if ($result["img_select"] != 1 && $result) {
    $result = unlink(".{$result['img_path']}");
    $query = "DELETE FROM `images` WHERE `img_id`=? AND `user_id`=? AND `img_select`=0";
    $pdoStat = $db->prepare($query);
    $result = $pdoStat->execute([$imgId, $_SESSION["id"]]);
    return $result;
  } else {
    return false;
  }
}

function setLogin($login) {
  session_start();
  $userId = $_SESSION["id"];
  $db = db();
  $query = "UPDATE `users` SET `user_login`=? WHERE `user_id`=?";
  $pdoStat = $db->prepare($query);
  $result = $pdoStat->execute([$login, $userId]);
  return $result;
}

function setName($name) {
  session_start();
  $userId = $_SESSION["id"];
  $db = db();
  $query = "UPDATE `users` SET `user_name`=? WHERE `user_id`=?";
  $pdoStat = $db->prepare($query);
  $result = $pdoStat->execute([$name, $userId]);
  return $result;
}