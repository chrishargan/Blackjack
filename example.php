<?php

declare(strict_types=1);
require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';
require 'index.php';
session_start();

if (isset($_POST['CashOut'])) {
    echo "<h1>Thanks for playing </h1>";
    echo " <h1> You leave the table with " . $_SESSION['chips'] . " Chips! </h1>";
    session_destroy();
}


if (!isset($_SESSION['currentGame']) || isset($_POST["NewGame"])) {

    $newGame = new Blackjack();
    $_SESSION['currentGame'] = $newGame;
    if (!isset($_SESSION['chips'])) {
        $_SESSION['chips'] = $_SESSION['currentGame']->getPlayer()->getChips();
    }
    $thresholdScore = 21;
    $firstRoundPlayerWinnings = 10;
    $firstRoundPlayerLoses = 5;
    if ($_SESSION['currentGame']->getPlayer()->getScore() == $thresholdScore) {
        $_SESSION['currentGame']->getDealer()->hasLost();
        $_SESSION['chips'] += $firstRoundPlayerWinnings;
    } elseif ($_SESSION['currentGame']->getDealer()->getScore() == $thresholdScore || ($_SESSION['currentGame']->getDealer()->getScore() == $thresholdScore && $_SESSION['currentGame']->getPlayer()->getScore() == $thresholdScore)) {
        $_SESSION['currentGame']->getPlayer()->setStands();
        $_SESSION['currentGame']->getPlayer()->hasLost() ;
        $_SESSION['chips'] -= $firstRoundPlayerLoses;
    }
}


if (isset($_POST['Hit']) && $_POST['bet'] !== null) {
    if (!isset($_SESSION['bet'])) {
        $_SESSION['bet'] = $_POST['bet'];
        $_SESSION['chips'] -= $_SESSION['bet'];
    }
    $_SESSION['currentGame']->getPlayer()->hit($_SESSION['currentGame']);
} elseif (isset($_POST['Hit']) && $_POST['bet'] == null) {

    echo "<h1>Please place your bet </h1>";
}


if (isset($_POST['Stand']) && $_POST['bet'] !== null) {
    if (!isset($_SESSION['bet'])) {
        $_SESSION['bet'] = $_POST['bet'];
        $_SESSION['chips'] -= $_SESSION['bet'];
    }
    $_SESSION['currentGame']->stand();
} elseif (isset($_POST['Stand']) && $_POST['bet'] == null) {

    echo "<h1>Please place your bet</h1>";
}


if (isset($_POST['Surrender'])) {
    $_SESSION['currentGame']->getPlayer()->surrender();

}
echo "<h1>Current Chips: " . $_SESSION['chips'] . "</h1>";
echo "<div><h1>Player:  ";
echo $_SESSION['currentGame']->getPlayer()->getScore() . "</h1><br>";

foreach ($_SESSION['currentGame']->getPlayer()->getCards() as $card) {

    echo $card->getUnicodeCharacter(true);
}
echo "</div>";
echo "<div><h1>Dealer</h1><br> ";


if ($_SESSION['currentGame']->getPlayer()->isStands() == true) {
    foreach ($_SESSION['currentGame']->getDealer()->getCards() as $card) {
        echo $card->getUnicodeCharacter(true);
    }
} else {
    echo $_SESSION['currentGame']->getDealer()->getCards()[0]->getUnicodeCharacter(true);
}

echo "</div>";

if ($_SESSION['currentGame']->getPlayer()->isLost() == true) {
    echo "<h1><strong>The house wins this time...</strong></h1>";
    if ($_SESSION['chips'] != 0) {
        unset($_SESSION['currentGame']);
        unset($_SESSION['bet']);
    } else {
        echo "<h1> You have run out of chips </h1>";
        session_destroy();
    }
}

if ($_SESSION['currentGame']->getDealer()->isLost() == true && $_SESSION['currentGame']->getPlayer()->isLost() == false) {
    echo "<h1><strong>You are a Winner!</strong></h1>";
    $_SESSION['chips'] += ($_SESSION['bet'] * 2);
    unset($_SESSION['currentGame']);
    unset($_SESSION['bet']);
}



