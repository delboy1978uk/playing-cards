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

    public function dealInitialCards()
    {
        // Give players and banker two cards

        $players = $this->getTable()->getPlayers()->getIterator();
        $shoe = $this->getTable()->getShoe();

        for($x = 1; $x<=2; $x++)
        {
            while($players->valid())
            {
                /** @var \PlayingCards\Player $player  */
                $player = $players->current();
                $player->addCard($shoe->dealCard());
                $players->next();
            }
            $players->rewind();

            // Give the banker his first card
            $this->getTable()->getBanker()->addCard($shoe->dealCard());
        }
    }

    public function evaluateHand(Player $player)
    {
        return Hand::evaluate($player->getCards());
    }
}