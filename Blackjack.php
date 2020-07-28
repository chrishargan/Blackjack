<?php
declare(strict_types=1);
class Blackjack {
    private Player  $player;
    private Player $dealer;
    private Deck $deck;


    public function __construct()
    {
        $deck = new Deck();
        $deck->shuffle();
        $this->deck = $deck;
        $this->player = new Player($deck);
        $this->dealer = new Player($deck);

    }

    public function hitPlayer() : void
    {

        if($_SESSION['REQUEST_METHOD'] == "POST" and isset($_POST['Hit']))
        {
         $_SESSION['playerValue'] = $this->player->hit($this->deck);

        }
    }

    public function playerStands(){
    $this->getDealer()->hit();
    }




    public function getPlayer(): Player
    {
        return $this->player;
    }




    public function setPlayer( Player $player): void
    {
        $this->player = $player;
    }


    public function getDealer(): Player
    {
        return $this->dealer;
    }


    public function setDealer(Player $dealer): void
    {
        $this->dealer = $dealer;
    }


    public function getDeck(): Deck
    {
        return $this->deck;
    }


    public function setDeck(Deck $deck): Deck
    {
        $this->deck = $deck;
    }


}
