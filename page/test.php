<main class="main">
    <section class="head">
        <h2 class="head__title"><?= $pageTitle ?></h2>
        <p class="head__date"><?= $pageDate ?></p>
    </section>
    <?
    $name = "Karl";
    echo $name . "<br> Hello";
    echo '<h1>Hello $name</h1>';
    echo "<h1>Hello $name</h1>";

    $a = 4;

    if ($a > 6) {
        echo "$a > 6";
    } else if ($a < 4) {
        echo "$a < 4";
    } elseif ($a == 4) {
        echo "$a == 4";
    } else {
        echo "Error";
    }

    date_default_timezone_set("Asia/Tashkent");
    echo "<br>" . date("d l F Год Y; H:i:s");
    ?>
    <br>
    <p>Tugilgan yilingizni kiriting</p>
    <select name="" id="">
        <?
        // for ($i=1; $i < 50; $i++) { 
        //     echo "<option value='$i'>$i</option>";
        // }
        $year = date('Y');
        // echo "<option value='$i'>$i</option>";
        ?>
        <? for ($i = $year - 20; $i <= $year; $i++) : ?>
            <option value="<?= $i ?>"><?= $i ?></option>
        <? endfor; ?>
        <!-- <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option> -->
    </select>

    <?
    // massiv

    $arr = ["html", "css", "js"];

    for ($i = 0; $i < count($arr); $i++) {
        $x = strtoupper($arr[$i]);
        echo "<br> $x";
    }

    $arr_assoc = [
        "name" => "Karl",
        "age" => "23",
        "address" => [
            "city" => "London",
            "number" => "120-5"
        ]
    ];

    // echo "<br>" . $arr_assoc["age"];

    foreach ($arr_assoc as $key => $value) {

        if (gettype($value) == "array") {
            foreach ($value as $x) {
                echo "<p>$key = $x</p>";
            }
        } else {
            echo "<p>$key = $value</p>";
        }
    }
    ?>

    <form action="" method="POST">
        <fieldset>
            <label for="name">Ism</label>
            <input type="text" id="name" name="name" placeholder="Name">
            <br><br>
            <label>Familiya
                <input type="text" name="surname" placeholder="Surname">
            </label>
        </fieldset>
        <button>Jo'natish</button>
    </form>
    <?
    // var_dump($_GET);
    var_dump($_POST);

    $name = strip_tags($_POST["name"]);
    $surname = htmlspecialchars($_POST["surname"]);

    echo "<p>Ism: $name</p>";
    echo "<p>Familiya: $surname</p>";
    ?>
</main>