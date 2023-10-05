<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower and Color Arrays</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin-top: 30px;
            background-color: #f0e6f2;
        }

        h2 {
            font-size: 1.5em;
            color: #2d3a47;
            margin-bottom: 10px;
        }

        .section-content {
            font-size: 1.2em;
            color: #4e5967;
        }
    </style>
</head>

<body>
    <h2>Indexed Array</h2>
    <div class="section-content">
        <?php
        $flowers = array("Rose", "Tulip", "Lily", "Sunflower", "Daisy");
        for ($x = 0; $x < 5; $x++) {
            echo "$flowers[$x] ";
        }
        echo "<br><br>";
        print_r($flowers);
        ?>
    </div>

    <h2>Associative Arrays</h2>
    <div class="section-content">
        <?php
        $flowersAndColors = array(
            "Rose" => "Red",
            "Tulip" => "Yellow",
            "Lily" => "White",
            "Sunflower" => "Yellow",
            "Daisy" => "White"
        );
        print_r($flowersAndColors);
        echo "<br>";
        echo "Flower - Color<br>";
        foreach ($flowersAndColors as $flower => $color) {
            echo "$flower - $color<br>";
        }
        ?>
    </div>

    <h2>Multidimensional Arrays</h2>
    <div class="section-content">
        <?php
        $flowersAndColors = array(
            array("Rose", "Red", "Love and Passion"),
            array("Tulip", "Yellow", "Love and Affection"),
            array("Lily", "White", "Purity and Innocence"),
            array("Sunflower", "Yellow", "Simplicity and Cheerfulness"),
            array("Daisy", "White", "Adoration and Loyalty")
        );
        for ($x = 0; $x < count($flowersAndColors); $x++) {
            echo $flowersAndColors[$x][0] . ": " . $flowersAndColors[$x][1] . ", " . $flowersAndColors[$x][2] . "<br>";
        }
        ?>
    </div>

    <h2>Array Functions</h2>
    <div class="section-content">
        <?php
        $colors = array("Red", "Yellow", "White", "Blue", "Green");
        echo "<br> Count: " . count($colors) . "<br>";

        sort($colors);
        echo "<br> Sorted:<br>";
        print_r($colors);

        $colorsReverse = array_reverse($colors);
        echo "<br> Reversed Array:<br>";
        print_r($colorsReverse);
        echo "<br>";
        echo "Searching white colored flower";
        $searchResult = array_search("White", $colors);
        echo "<br> Search result: " . $searchResult . "<br>";

        $searchResult2 = array_search("Black", $colors);
        if ($searchResult2 === false) {
            echo "<br> 'Black colored flower' is not known.";
        } else {
            echo "'Black' is found at index " . $searchResult2;
        }

        $flowerColors = array("Red", "Yellow", "White");
        $commonColors = array_intersect($colors, $flowerColors);
        echo "<br> Common Colors:<br>";
        print_r($commonColors);
        ?>
    </div>
</body>

</html>
