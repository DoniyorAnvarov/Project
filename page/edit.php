<? if (isset($_SESSION["id"])) : ?>
<main class="main">
  <section class="head">
    <h2 class="head__title"><?= $userInfo["user_login"] ?></h2>
    <p class="head__date"><?= $pageDate ?></p>
  </section>
  <img src="<?= $userInfo["img_path"] ?>" alt="" class="user-img">
  <form action="./includes/user-avatar.php" method="POST" enctype="multipart/form-data" class="userForm">
    <h3>Добавить фотографию</h3>
    <input type="file" name="avatar[]" accept="image/jpeg,image/jpg,image/png" multiple>
    <button class="form__btn">Добавить</button>
  </form>
  <form action="./includes/user-edit-photos.php" method="POST" class="avatars">
    <? foreach ($getPhotos as $key => $value) : ?>
      <label class="avatars__item">
        <img src="<?= $value["img_path"] ?>" alt="" class="avatars__img">
        <input type="radio" name="ava" value="<?=$value["img_id"]?>" <?= $value["img_select"] == 1 ? "checked" : "" ?>>
        <span class="avatars__check"><i class="fas fa-check"></i></span>
        <a href="./includes/user-del-photos.php?trash=<?=$value["img_id"]?>" class="avatars__del"><i class="fas fa-trash-alt"></i></a>
      </label>
    <? endforeach; ?>
    <div class="avatars__btn">
      <button class="form__btn">Изменить фотогорафию</button>
    </div>
  </form>
  <form action="./includes/user-edit-login.php" method="POST">
      <fieldset class="setLogin">
        <legend>Изменить логин</legend>
        <input type="text" name="login" value="<?= $userInfo["user_login"] ?>">
        <button class="form__btn">Изменить логин</button>
      </fieldset>
  </form>
  <form action="./includes/user-edi-name.php" method="POST">
      <fieldset class="setLogin">
        <legend>Изменить имя</legend>
        <input type="text" name="name" value="<?= $userInfo["user_name"] ?>">
        <button class="form__btn">Изменить имя</button>
      </fieldset>
  </form>
</main>
<? else : ?>

<? header("Location:/?route=404") ?>

<? endif; ?>