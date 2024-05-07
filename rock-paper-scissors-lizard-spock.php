<?php

const ROCK = "rock";
const PAPER = "paper";
const SCISSORS = "scissors";
const LIZARD = "lizard";
const SPOCK = "spock";

$elementMap =
    [
        ROCK => ["wins" => [SCISSORS, LIZARD], "loses" => [PAPER, SPOCK]],
        PAPER => ["wins" => [ROCK, SPOCK], "loses" => [SCISSORS, LIZARD]],
        SCISSORS => ["wins" => [PAPER, LIZARD], "loses" => [ROCK, SPOCK]],
        LIZARD => ["wins" => [PAPER, SPOCK], "loses" => [ROCK, SCISSORS]],
        SPOCK => ["wins" => [ROCK, SCISSORS], "loses" => [PAPER, LIZARD]]
    ];

$elements = array_keys($elementMap);

function getOpponentInput($elements): string
{
    return $elements[array_rand($elements)];
}

function validateInput($input, $elements): bool
{
    if (!in_array($input, $elements)) {
        echo "Invalid input!\n";
        return false;
    }
    return true;
}

function callTurn($userInput, $opponentInput): void
{
    echo "You picked $userInput!\n";
    echo "Opponent picked $opponentInput!\n";
}

function playTurn($userInput, $opponentInput, $elementMap): void
{
    callTurn($userInput, $opponentInput);
    if (in_array($opponentInput, $elementMap[$userInput]["wins"])) {
        echo "You win!\n";
        return;
    }
    if (in_array($opponentInput, $elementMap[$userInput]["loses"])) {
        echo "You lose!\n";
        return;
    }
    echo "tie!\n";
}

do {
    $userInput = strtolower(readline("Pick your hand! (rock, paper, scissors, lizard, spock) - "));
    $inputIsValid = validateInput($userInput, $elements);
} while (!$inputIsValid);

$opponentInput = getOpponentInput($elements);
playTurn($userInput, $opponentInput, $elementMap);