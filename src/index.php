<?php
include_once 'Spaceship.php'
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spaceboot</title>
</head>

<body style="background-color: #383838;">
    <p style="font-family:Cambria; font-size: 20px; color:#8a2be2;">
        <?php
        $random_number = mt_rand(1, 10);
        $fleet = [
            new Spaceship,
            new Fightership("Fightership", 120, 120, 123, array(12, 12)),
            new Healer(99, 112, 122, array(12, 100)),
            new Carriership("Carriership", 98, 210, 121, array(12, 25))
        ];
        $battle = new battle;
        $teamBlue = null;
        $teamRed = null;

        for ($i = $random_number; $i >= 0; $i--) {
            $randomIndex = rand(0, count($fleet) - 1);
            $selectedValue = clone $fleet[$randomIndex];
            $teamBlue[] = $selectedValue;
            echo $selectedValue->getName() . "<br>";
        }
        echo  "<br>";
        for ($i = $random_number; $i >= 0; $i--) {
            $randomIndex = rand(0, count($fleet) - 1);
            $selectedValue = clone $fleet[$randomIndex];
            $teamRed[] = $selectedValue;
            echo $selectedValue->getName() . "<br>";
        }
        echo "victory: " . $battle->battle1($teamRed, $teamBlue) . "<br>";
    

        foreach ($battle as $info) {
            echo $info;
        }
        echo "The end of the code has been reached.<br>";
        ?>
    </p>
</body>

</html>