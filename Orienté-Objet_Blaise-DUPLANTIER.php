<?php
class Player
{
    public $name;
    public $marbles;
    public $loss;
    public $gain;
    public $screem_war;

    public function __construct($name, $marbles, $loss, $gain, $screem_war)
    {
        $this->name = $name;
        $this->marbles = $marbles;
        $this->loss = $loss;
        $this->gain = $gain;
        $this->screem_war = $screem_war;
    }
}

class Opponent
{
    public $name;
    public $marbles;
    public $age;

    public function __construct($name, $marbles, $age)
    {
        $this->name = $name;
        $this->marbles = $marbles;
        $this->age = $age;
    }
}

$players = [
    new Player("Seong Gi-hun", 15, 2, 1, "Victoire!"),
    new Player("Kang Sae-byeok", 25, 1, 2, "Victoire!"),
    new Player("Cho Sang-woo", 35, 0, 3, "Victoire!")
];

$opponents = [];
for ($i = 0; $i < 20; $i++) {
    $opponents[] = new Opponent("Opponent " . ($i + 1), rand(1, 20), rand(20, 60));
}

class Game
{
    private $player;
    private $opponents;

    public function __construct($player, $opponents)
    {
        $this->player = $player;
        $this->opponents = $opponents;
    }

    public function start()
    {
        foreach ($this->opponents as $opponent) {
            echo "Vous affrontez " . $opponent->name . " qui a " . $opponent->age . " ans.<br>";
            echo "Vous avez actuellement " . $this->player->marbles . " billes.<br>";

            $guess = rand(0, 1) == 0 ? "pair" : "impair";
            echo "Vous devinez que l'adversaire a un nombre " . $guess . " de billes.<br>";

            if (($opponent->marbles % 2 == 0 && $guess == "pair") || ($opponent->marbles % 2 != 0 && $guess == "impair")) {
                echo "Vous avez deviné juste ! Vous gagnez le tour.<br>";
                $this->player->marbles += $opponent->marbles + $this->player->gain;
            } else {
                echo "Vous avez deviné faux ! Vous perdez le tour.<br>";
                $this->player->marbles -= $opponent->marbles + $this->player->loss;
            }

            if ($this->player->marbles <= 0) {
                echo "Vous avez perdu toutes vos billes et avez été éliminé du jeu.<br>";
                return;
            }
        }

        echo "Félicitations ! Vous avez gagné le jeu avec " . $this->player->marbles . " billes restantes et remporté 45,6 milliards de Won Sud-Coréens !.<br>";
    }
}

$player = $players[array_rand($players)];

$game = new Game($player, $opponents);
$game->start();
?>