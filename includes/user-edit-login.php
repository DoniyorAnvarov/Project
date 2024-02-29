<?

include_once("./db.php");

$setLogin = setLogin($_POST["login"]);

if ($setLogin) {
  header("Location:/?route=edit");
} else {
  header("Location:/?route=404");
}