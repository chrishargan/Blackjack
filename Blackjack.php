<?php
declare(strict_types=1);

class Blackjack
{
    private Player  $player;
    private Dealer $dealer;
    private Deck $deck;


    public function __construct()
    {
        $deck = new Deck();
        $deck->shuffle();
        $this->deck = $deck;
        $this->player = new Player($deck);
        $this->dealer = new Dealer($deck);

    }


    public function stand()
    {
        $this->getDealer()->dealerHit($this);
        if ($this->getDealer()->getScore()>$this->getPlayer()->getScore()){
            $this->getPlayer()->hasLost();
        } else {
            $this->getDealer()->hasLost();
        }
    }


    public function getPlayer(): Player
    {
        return $this->player;
    }


    public function setPlayer(Player $player): void
    {
        $this->player = $player;
    }


    public function getDealer(): Player
    {
        return $this->dealer;
    }


    public function setDealer(Dealer $dealer): void
    {
        $this->dealer = $dealer;
    }


    public function getDeck(): Deck
    {
        return $this->deck;
    }


    public function setDeck(Deck $deck): void
    {
        $this->deck = $deck;
    }


}
