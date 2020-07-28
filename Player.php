<?php
declare(strict_types=1);

class Player {
    private array $cards=[];
    private boolean $lost ;

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return bool
     */
    public function isLost(): bool
    {
        return $this->lost;
    }

    /**
     * @param array $cards
     */
    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }

    /**
     * @param bool $lost
     */
    public function setLost(bool $lost): void
    {
        $this->lost = $lost;
    }

    public function hit(){

    }
    public function surrender(){

    }
    public function  getScore(){

    }
    public function hasLost(){

}
}
