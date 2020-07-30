<?php
declare(strict_types=1);

class Blackjack
{

    private Player  $player;
    private Dealer $dealer;
    private Deck $deck;
    public const thresholdScore = 21;


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
        $this->getPlayer()->setStands();
        $this->getDealer()->dealerHit($this);
        $playerScore = $this->getPlayer()->getScore();
        $dealerScore = $this->getDealer()->getScore();
        if (($dealerScore > $playerScore || $dealerScore == $playerScore) && $dealerScore < self::thresholdScore) {
            $this->getPlayer()->hasLost();
        } elseif ($playerScore > $dealerScore && $playerScore < self::thresholdScore) {
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
