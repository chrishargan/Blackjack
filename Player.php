<?php
declare(strict_types=1);

class Player
{

    private array $cards = [];
    private bool $lost;


    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
        $this->lost = false;
    }


    public function getCards(): array
    {
        return $this->cards;
    }




    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }


    public function hit(Blackjack $newGame)
    {
        $newDeck = $newGame->getDeck();
        $this->cards[] = $newDeck->drawCard();
        $newGame->setDeck($newDeck);

        if ($this->getScore() > 21) {
            $this->hasLost();
        }
    }



    public function hasLost(): void
    {
        $this->lost= true;
    }
    public function isLost(): bool
    {
        return $this->lost;
    }

    public function surrender()
    {
        $this->hasLost();

    }

    public function getScore()
    {
        $totalValue = 0;
        $cards = $this->getCards();
        foreach ($cards as $card) {
            $totalValue += $card->getValue();
        }
        return $totalValue;
    }
}

class Dealer extends Player
{

    public function dealerHit(Blackjack $newGame)
    {

        while ($this->getScore() < 15) {
            parent::hit($newGame);
        }

    }

}


