<aside class="menu">
  <div class="menu__reviews">
    <span class="menu__reviews_span" data-href="https://proweb.uz">
      <i class="far fa-chevron-right"></i>
    </span>
    <span class="menu__reviews_text">Оставить озыв</span>
  </div>
  <ul class="menu__list">
    <? foreach ($arrayPages as $key => $value) : 
      if (isset($value["icon"])) :
    ?>
      <li><a href="/?route=<?=$key?>" class="menu__list-link <?= $key == $route ? "active" : "" ?>"><i class="<?=$value["icon"] ?>"></i><?= $value["name"] ?></a></li>
    <? endif;
    endforeach ?>
    <!-- <li><a href="/page/contact.php" class="menu__list-link"><i class="fal fa-address-book"></i>Контакты</a></li>
    <li><a href="/page/table.php" class="menu__list-link"><i class="fas fa-times"></i>Таблица умножения</a></li>
    <li><a href="/page/calc.php" class="menu__list-link"><i class="fas fa-calculator-alt"></i>Калькулятор</a></li>
    <li><a href="/page/slide.php" class="menu__list-link"><i class="far fa-presentation"></i>Слайдер</a></li>
    <li><a href="/page/guest.php" class="menu__list-link"><i class="fal fa-books"></i>Гостевая книга</a></li>
    <li><a href="/page/test.php" class="menu__list-link"><i class="fal fa-vial"></i>Тест</a></li> -->
  </ul>
</aside>