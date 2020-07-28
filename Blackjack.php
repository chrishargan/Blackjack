<?php
declare(strict_types=1);
class Blackjack {
    private string $player;
    private string $dealer;
    private string $deck;

    /**
     * @return string
     */
    public function getPlayer(): string
    {
        return $this->player;
    }

    /**
     * @param string $player
     */
    public function setPlayer(string $player): void
    {
        $this->player = $player;
    }

    /**
     * @return string
     */
    public function getDealer(): string
    {
        return $this->dealer;
    }

    /**
     * @param string $dealer
     */
    public function setDealer(string $dealer): void
    {
        $this->dealer = $dealer;
    }

    /**
     * @return string
     */
    public function getDeck(): string
    {
        return $this->deck;
    }

    /**
     * @param string $deck
     */
    public function setDeck(string $deck): void
    {
        $this->deck = $deck;
    }


}
