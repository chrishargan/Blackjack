<?php

declare(strict_types=1);
require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';
require 'index.php';
session_start();
if (!isset($_SESSION['currentGame']) || isset($_POST["NewGame"])) {

    $newGame = new Blackjack();
    $_SESSION['currentGame'] = $newGame;
}


if (isset($_POST['Hit'])) {
    $currentDeck = $_SESSION['currentGame'];
    $currentDeck->getPlayer()->hit($currentDeck);
    $_SESSION['currentGame'] = $currentDeck;
}

if (isset($_POST['Stand'])) {
    $_SESSION['currentGame']->stand();

}

if (isset($_POST['Surrender'])) {
    $_SESSION['currentGame']->getPlayer()->surrender();

}

echo "<div><h1><strong>Player</strong></h1> <br>";
foreach ($_SESSION['currentGame']->getPlayer()->getCards() as $card) {
    echo $card->getUnicodeCharacter(true);
    echo "<br>";

}
echo "</div>";
echo "<div> <h1><strong>Dealer</strong></h1> <br>";
foreach ($_SESSION['currentGame']->getDealer()->getCards() as $card) {
    echo $card->getUnicodeCharacter(true);
    echo "<br>";

}
echo "</div>";

if ($_SESSION['currentGame']->getPlayer()->isLost() == true) {
    echo "<h1><strong>The house wins this time...</strong></h1>";
    session_destroy();
}

if ($_SESSION['currentGame']->getDealer()->isLost() == true && $_SESSION['currentGame']->getPlayer()->isLost() == false)  {
    echo "<h1><strong>You are a Winner!</strong></h1>";
    session_destroy();
}
//elseif{
   // echo "<h1><strong>The House wins in a Draw!</strong></h1>";
//}


