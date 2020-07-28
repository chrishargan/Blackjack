<?php
declare(strict_types=1);

class Player {

    private array $cards=[];
    private bool $lost;




    public function __construct(Deck $deck)
    {

        $this->cards[]=$deck->drawCard();
        $this->cards[]=$deck->drawCard();

    }


    public function getCards(): array
    {
        return $this->cards;
    }


    public function isLost(): bool
    {
        return $this->lost;
    }


    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }


    public function setLost(bool $lost): void
    {
        $this->lost = $lost;

    }

    public function hit(){

        $this->cards[] = $_SESSION['currentGame']->getDeck()->drawCard();
        if($_SESSION['currentGame']->getPlayer()->getScore() >= 21){
            $this->hasLost();
        }

    }

    public function stand(){

        $this->cards[] = $_SESSION['currentGame']->getDeck()->drawCard();
        if($_SESSION['currentGame']->getdealer()->getScore() >= 21){
            $this->hasLost();
        }

    }




    public function surrender(){

    }
    public function  getScore(){
        $totalValue =0;
        $cards = $_SESSION['currentGame']->getPlayer()->getCards();
        foreach ($cards AS $card){
            $totalValue += $card->getValue();

        }
        return $totalValue;
    }
    public function  getDealerScore(){
        $totalValue =0;
        $cards = $_SESSION['currentGame']->getDealer()->getCards();
        foreach ($cards AS $card){
            $totalValue += $card->getValue();

        }
        return $totalValue;
    }


    public function hasLost(){

    $this->setLost( true);
    echo "Better luck next time...";
    session_destroy();
}

}
