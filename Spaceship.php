<?php
class Spaceship
{
    // Properties
    protected string $name;
    public bool $isAlive;
    protected float $fuel;
    protected int $hitPoints;
    protected int $ammo;
    protected array $location;
    protected int $extrafuel;
    protected int $extraheal;
    protected bool $barrier;

    //consturcten van de default/het normale space ship
    public function __construct(
        $name = 'spaceship',
        $ammo = 100,
        $fuel = 1000,
        $hitPoints = 100,
        $location = array(0,0),
        $extrafuel = 100,
        $extraheal = 100,
        $barrier = false,
    ) {
        $this->name = $name;
        $this->ammo = $ammo;
        $this->fuel = $fuel;
        $this->hitPoints = $hitPoints;
        $this->location = $location;
        $this->extrafuel = $extrafuel;
        $this->extraheal = $extraheal;
        $this->barrier = $barrier;



        $this->isAlive = true;
    }


    public function shoot($hitship): int
    {

        $shot = 10;
        $damage = 2;
        if ($this->ammo - $shot >= 0) {
            $this->ammo -= $shot;
            return $hitship->hit($shot * $damage);
        } else {
            return 0;
        }
    }

    public function hit($damage)
    {
        if($this->barrier === true){
            return $this->barrier = false;
        }
        elseif($this->hitPoints - $damage > 0) {
            $this->hitPoints -= $damage;
        } else {
            $this->isAlive = false;
        }
    }

    public function move($x, $y)

    {

        $distance = (sqrt(pow($this->location[0] - $x, 2) + pow($this->location[1] - $y, 2)));

        if($distance > 0){

            $_fuelUsage = 2 * $distance;

            if ($this->fuel - $_fuelUsage > 0) {

                $this->fuel -= $_fuelUsage;

            } else {

                $this->fuel = 0;

            }
            $location =array($x,$y);

        return $this->location = $location;

            }
        }
    public function getName(){
        return $this->name;
    }
    public function getAmmo(){
        return $this->ammo;
    }
    public function getHitPoints(){
        return $this->hitPoints;
    }
    public function getfuel(){
        return $this->fuel;
    }
    public function getextraFuel(){
        return $this->fuel += $this->extrafuel;
    }
    public function getextrahitpoints(){
        return $this->hitPoints += $this->extraheal;
    }
    public function getAlive(){
        return $this->isAlive;
    }
    public function kill(){
        return $this->isAlive = false;
    }
    
}
//consturcten van het fightership
class Fightership extends Spaceship{
    protected int $boost = 99;
    protected int $boostused = 10;

    public function getboost()
        {
           return $this->boost;
           
        }
        public function boost()
        {
            if($this->boost - $this->boostused > 0) {
                return $this->boost -= $this->boostused;
            }
    }
}
//consturcten van de healer
class Healer extends Spaceship{
    protected int $HitpointsInTank = 400;
    
    function __construct(){
        parent::__construct();
        $this->name = "Healer";
        $this->hitPoints = 10;
        $this->barrier = true;

        $this->ammo = 31;
        $this->fuel = 454;
        $this->location = array(52,5);
        $this->extrafuel = 100;
        $this->extraheal = 100;
    }
    public function getbarrier()
    {
        return (boolval($this->barrier) ? 'true' : 'false');
    }
    
    public function getHitpointsInTank()
        {
           return $this->HitpointsInTank;
        }
    public function giveheal()
        {
           return $this->HitpointsInTank -= $this->extraheal;
        }
}
//consturcten van het carriership
class Carriership extends Spaceship{
    protected int $FuelInTank = 400;
    public function getFuelInTank()
        {
           return $this->FuelInTank;
        }
    public function giveFuel()
        {
           return $this->FuelInTank -= $this->extrafuel;
        }
}
//De class die gaat over de moves en de battle die wordt uitgevoerd door de schepen
class Battle{
    protected string $win;
    protected string $Move;

    public function __construct(
        $win = 'something went wrong'
    ) {
        $this->win = $win;
    }
    public function battle1($teamRed, $teamblue)
    {

        $default=array("shoot","move");
        $fighter=array("boost");
        $healer=array("giveheal");
        $Carriership=array("giveFuel");
        $functions = null;
        $total = [];

        for ($i = 0; $i < count($teamblue); $i++) {
            $total[] = $teamblue[$i];
            if (isset($teamRed[$i])) {
                $total[] = $teamRed[$i];
            }
        }
        
        $u = 0;
        $o = 0;
        $i = 0;
        $team = [$teamRed,$teamblue];
        do{
            $blueAlive = array();
            $redAlive = array();
            foreach ($teamblue as $ships) {
                $blueAlive[] = $ships->getAlive();
            }
            $filtered = array_filter($blueAlive, function($k) {
                return $k == true;
            });
            foreach ($teamRed as $ships) {
                $redAlive[] = $ships->getAlive();
            }
            $filtered2 = array_filter($redAlive, function($k) {
                return $k == true; 

            });
            //vgm filterd wordt niet gevuld?
            foreach ($total as $ship){

                //laat merken welk team er aan zet is
                $u++;
                if($u>1){
                    $u=0;
                }
                //laat zien de hoeveelste schip van het team aan zet is
                //hij reset wannneer alle schepen geweest zijn maar kan niet op lijken schieten
                $aantal=count($team[$u]);
                if ($i % 2 == 0) {// deze functie die werkt toch
                    if($o==$aantal){
                        $o = 0;
                    }else{
                        $o++;
                    }
                    // while($team[$u][$o]->isAlive==false){
                    //     if($o==$aantal){
                    //     $o = 0;
                    //    }else{
                    //     $o++;}
                    // } 
                }
                //zorgt ervoor dat er een random functie uit de moveset van het character wordt gekozen
                $shipName = $ship->getName();
                switch ($shipName) {
                    case 'Carriership':
                        $randomIndex = rand(0, count($CariershipMoveset=$Carriership + $default) - 1);
                        $selectedValue = $CariershipMoveset[$randomIndex];
                        $functions = $selectedValue;
                        break;
                    case 'Healer':
                        $randomIndex = rand(0, count($HealerMoveset=$healer + $default) - 1);
                        $selectedValue = $HealerMoveset[$randomIndex];
                        $functions = $selectedValue;
                        break;
                    case 'fightership':
                        $randomIndex = rand(0, count($FighterMoveset=$fighter + $default) - 1);
                        $selectedValue = $FighterMoveset[$randomIndex];
                        $functions = $selectedValue;
                        break;
                    default:
                        $randomIndex = rand(0, count($default) - 1);
                        $selectedValue = $default[$randomIndex];
                        $functions = $selectedValue;
                        break;
                }

                //activeert de functies
                switch ($functions) {
                    case "move":
                        $ship->move(rand(10 ,25),rand(10 ,25));
                        break;
                    case "boost":
                        $ship->boost();
                        break;
                    case "giveheal":
                        $ship->giveheal();
                        break;
                    case "giveFeul":
                        $ship->giveFuel();
                        break;
                    default:
                        if($team=="teamblue"){
                            $ship->shoot($teamRed[$o]);
                        }
                        if($team=="teamred"){
                            $ship->shoot($teamblue[$o]);
                        }
                        break;
                }
                $i++; 
            }
            var_dump($filtered);
            var_dump($filtered2);
        }
        // while(0<0);
        while(count($filtered) > 0 && count($filtered2) > 0);
        if(count($filtered) == 0){
            return $this->win = "red won";
        }
        elseif(count($filtered2) == 0){
            return $this->win = "Blue won";
        }
        else{
            echo "error";
        }
        $this->getWin();
    }
    public function getWin()
    {
        return $this->win;
        exit();
    }
}