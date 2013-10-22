<?php
/**
 * User: delboy1978uk
 * Date: 22/10/2013
 * Time: 01:04
 */

namespace PlayingCards\Games;
use PlayingCards\Games\Baccarat\Hand;
use PlayingCards\Player;
use PlayingCards\Shoe;
use PlayingCards\Table;

class Baccarat extends CardGame
{

    private $player_hand;

    /**
     * add an array of Baccarat\Players to begin
     * @param array $players
     */
    public function __construct(array $players)
    {
        $this->setName('Baccarat');
        $shoe = new Shoe(6);
        $shoe->shuffleDeck();
        $this->setTable(new Table($shoe,$players));
        $this->player_hand = new Player('Punto');
    }

    /**
     *  Resets all bets
     */
    public function startGame()
    {
        $players = $this->getTable()->getPlayers()->getIterator();
        while($players->valid())
        {
            $players->current()->clearBet();
            $players->next();
        }
    }

    /**
     *  Deals the initial 2 cards to Punto and Banco
     */
    public function dealInitialCards()
    {
        // Give players and banker two cards

        $shoe = $this->getTable()->getShoe();

        for($x = 1; $x<=2; $x++)
        {
            //regardless how many players, there is only one player hand
            //which everyone can bet on
            $this->player_hand->addCard($shoe->dealCard());
            // Give the banker his first card
            $this->getTable()->getBanker()->addCard($shoe->dealCard());
        }
    }

    public function dealThirdCards()
    {

        $shoe = $this->getTable()->getShoe();
        if($this->evaluateHand($this->getPunto()) < 8 && $this->evaluateHand($this->getPunto()) < 8)
        {
            //no naturals (8 or 9) so third cards must be drawn if score is 0 -5
            if($this->evaluateHand($this->getPunto()) < 6)
            {
                $card = $shoe->dealCard();
                $this->getPunto()->addCard($card);
                // rules for banker depend on players new score
                $draw = false;
                if($this->evaluateHand($this->getBanco()) < 3)
                {
                    $draw = true;
                }
                // if banker is 3 and players 3rd card was not 8, draw a card
                elseif($this->evaluateHand($this->getBanco()) == 3 && $card->getValue() != 8)
                {
                    $draw = true;
                }
                //If the banker total is 4, then the bank draws a third card if the player's third card was 2, 3, 4, 5, 6, 7.
                elseif($this->evaluateHand($this->getBanco()) == 4 && (1 < $card->getValue() &&  $card->getValue() < 8))
                {
                    $draw = true;
                }
                //If the banker total is 5, then the bank draws a third card if the player's third card was 4, 5, 6, or 7.
                elseif($this->evaluateHand($this->getBanco()) == 5 && (3 < $card->getValue() &&  $card->getValue() < 8))
                {
                    $draw = true;
                }
                // If the banker total is 6, then the bank draws a third card if the player's third card was a 6 or 7.
                elseif($this->evaluateHand($this->getBanco()) == 6 && ($card->getValue() == 6 ||  $card->getValue() == 7))
                {
                    $draw = true;
                }
                if($draw == true)
                {
                    $this->getBanco()->addCard($this->getTable()->getShoe()->dealCard());
                }
            }
            else
            {
                //player hasn't drawn a third card, so banker follows same rule
                if($this->evaluateHand($this->getBanco()) < 6)
                {
                    $this->getBanco()->addCard($shoe->dealCard());
                }
            }
            return true;
        }
        else
        {
            //someone has a natural, game over, get the results
            return false;
        }

            $this->player_hand->addCard($this->getTable()->getShoe()->dealCard());
            // Give the banker his first card
            $this->getTable()->getBanker()->addCard($shoe->dealCard());
    }

    public function evaluateHand(Player $player)
    {
        return Hand::evaluate($player->getCards());
    }

    /**
     * @return Player
     */
    public function getPunto()
    {
        return $this->player_hand;
    }

    /**
     * @return Player
     */
    public function getBanco()
    {
        return $this->getTable()->getBanker();
    }
}