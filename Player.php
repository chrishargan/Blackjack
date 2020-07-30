<?php
declare(strict_types=1);

class Player
{

    private array $cards = [];
    private bool $lost;
    private bool $stands;
    private int $chips;
    public const chipsAtStart = 100;
    public const thresholdScore = 21;

    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
        $this->lost = false;
        $this->stands = false;
        $this->chips = self::chipsAtStart;


    }

    /**
     * @return int
     */
    public function getChips(): int
    {
        return $this->chips;
    }

    /**
     * @param int $chips
     */
    public function setChips(int $chips): void
    {
        $this->chips = $chips;
    }


    public function isStands(): bool
    {
        return $this->stands;
    }


    public function setStands(): void
    {
        $this->stands = true;
    }


    public function getCards(): array
    {
        return $this->cards;
    }

    public function hit(Blackjack $newGame)
    {
        $newDeck = $newGame->getDeck();
        $this->cards[] = $newDeck->drawCard();
        $newGame->setDeck($newDeck);

        if ($this->getScore() > self::thresholdScore) {
            $this->hasLost();
        }
    }


    public function hasLost(): void
    {
        $this->lost = true;
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
    public const dealerTarget = 15;

    public function dealerHit(Blackjack $newGame)
    {

        while ($this->getScore() < self::dealerTarget) {
            parent::hit($newGame);
        }

    }

}


