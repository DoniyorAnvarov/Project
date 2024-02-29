<?

include_once("./db.php");

$delPhotos = delPhotos($_GET["trash"]);

if ($delPhotos) {
  header("Location:/?route=edit");
} else {
  header("Location:/?route=edit&error=3");
}