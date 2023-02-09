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
        //random number generator voor de teams aan te maken.
        $random_number = mt_rand(1, 10);
        //De schips waar een fleet uit kan bestaan
        $fleet = [
            new Spaceship,
            new Fightership("Fightership", 120, 120, 123, array(12, 12)),
            new Healer(99, 112, 122, array(12, 100)),
            new Carriership("Carriership", 98, 210, 121, array(12, 25))
        ];
        //De twee teams die gevuld worden met de ships uit $fleet.
        $teamBlue = null;
        $teamRed = null;
        //Een class zodat de battle goed kan verlopen
        $battle = new battle;

        //Maak een fleet aan voor team blauw
        for ($i = $random_number; $i >= 0; $i--) {
            $randomIndex = rand(0, count($fleet) - 1);
            $selectedValue = clone $fleet[$randomIndex];
            $teamBlue[] = $selectedValue;
            echo $selectedValue->getName() . "<br>";
        }
        echo  "<br>";
        //Maak een fleet aan voor team rood
        for ($i = $random_number; $i >= 0; $i--) {
            $randomIndex = rand(0, count($fleet) - 1);
            $selectedValue = clone $fleet[$randomIndex];
            $teamRed[] = clone $fleet[$randomIndex];
            echo $selectedValue->getName() . "<br>";
        }
        //Laat zien welk team heeft gewonnen
        echo "victory: " . $battle->battle1($teamRed, $teamBlue) . "<br>";
    
        //Laat het scoreboard zien
        foreach ($battle as $info) {
            echo $info;
        }
        echo "The end of the code has been reached.<br>";
        ?>
    </p>
</body>

</html>