<?php

class RockPaperScissorsLizardSpock
{
    const ROCK = "rock";
    const PAPER = "paper";
    const SCISSORS = "scissors";
    const LIZARD = "lizard";
    const SPOCK = "spock";
    private array $elementMap =
        [
            self::ROCK => ["wins" => [self::SCISSORS => "crushes", self::LIZARD => "crushes"], "loses" => [self::PAPER => "covered", self::SPOCK => "vaporized"]],
            self::PAPER => ["wins" => [self::ROCK => "covers", self::SPOCK => "disproves"], "loses" => [self::SCISSORS => "cut", self::LIZARD => "eaten"]],
            self::SCISSORS => ["wins" => [self::PAPER => "cut", self::LIZARD => "decapitate"], "loses" => [self::ROCK => "crushed", self::SPOCK => "smashed"]],
            self::LIZARD => ["wins" => [self::PAPER => "eats", self::SPOCK => "poisons"], "loses" => [self::ROCK => "crushed", self::SCISSORS => "decapitated"]],
            self::SPOCK => ["wins" => [self::ROCK => "vaporizes", self::SCISSORS => "smashes"], "loses" => [self::PAPER => "disproved", self::LIZARD => "poisoned"]]
        ];
    private array $elements;

    public function __construct()
    {
        $this->elements = array_keys($this->elementMap);
    }

    public function play()
    {
        $this->run();
    }

    private function run(): void
    {
        while (true) {
            $userInput = $this->promptUserElement();
            if (!$this->validElement($userInput)) {
                echo "Invalid input!\n";
                continue;
            }

            $opponentInput = $this->getOpponentElement();
            $this->playMatch($userInput, $opponentInput);
            if ($this->promptPlayAgain()) {
                echo "\n\n\n";
                echo "Starting new game!\n";
            } else {
                echo "Goodbye!\n";
                break;
            }
        }
    }

    private function listElements():string
    {
        return implode(", ", $this->elements);
    }

    private function promptUserElement(): string
    {
        $choices = $this->listElements();
        return strtolower(readline("Pick your hand ($choices) - "));
    }

    private function validElement($input): bool
    {
        return in_array($input, $this->elements);
    }

    private function getOpponentElement(): string
    {
        return $this->elements[array_rand($this->elements)];
    }

    private function playMatch($userInput, $opponentInput): void
    {
        $this->callHands($userInput, $opponentInput);
        if (in_array($opponentInput, array_keys($this->elementMap[$userInput]["wins"]))) {
            $verb = $this->elementMap[$userInput]["wins"][$opponentInput];
            $userInput = ucfirst($userInput);
            echo "$userInput $verb $opponentInput!\n";
            echo "You win!\n";
            return;
        }
        if (in_array($opponentInput, array_keys($this->elementMap[$userInput]["loses"]))) {
            $verb = $this->elementMap[$userInput]["loses"][$opponentInput];
            $userInput = ucfirst($userInput);
            echo "$userInput is $verb by $opponentInput!\n";
            echo "You lose!\n";
            return;
        }
        echo "tie!\n";
    }

    private function callHands($userInput, $opponentInput): void
    {
        echo "You picked $userInput!\n";
        echo "Opponent picked $opponentInput!\n";
    }

    private function promptPlayAgain(): bool
    {
        while (true) {
            echo "|=======================|\n";
            echo "0) Play again\n";
            echo "1) Quit\n";
            $action = readline("Action: ");

            if (!in_array($action, ["0", "1"])) {
                echo "Invalid choice!\n";
            }

            if ($action === "0") {
                return true;
            }

            if ($action === "1") {
                return false;
            }
        }
    }
}


$rockPaperScissorsLizardSpock = new RockPaperScissorsLizardSpock();
$rockPaperScissorsLizardSpock->play();
