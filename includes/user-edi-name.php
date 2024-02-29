<?

include_once("./db.php");

$setName = setName($_POST["name"]);

if ($setName) {
  header("Location:/?route=edit");
} else {
  header("Location:/?route=404");
}