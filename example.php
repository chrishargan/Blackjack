<?php

declare(strict_types=1);
session_start();
require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';
require 'index.php';

$newGame = new Blackjack();
$_SESSION['currentGame'] = $newGame;
//print_r($newGame->getPlayer());
//$newGame->getPlayer()->hit();
//print_r($newGame->getPlayer());
//print_r($newGame->getPlayer()->getScore());
print_r($newGame->getDealer()->getDealerScore());
$newGame->playerStands();
print_r($newGame->getDealer()->getDealerScore());

/*
foreach ($deck->getCards() as $card) {
    echo $card->getUnicodeCharacter(true);
    echo "<br>";

}
echo "</div>";

*/