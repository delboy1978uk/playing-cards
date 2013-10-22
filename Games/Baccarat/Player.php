<?php
/**
 * User: delboy1978uk
 * Date: 22/10/2013
 * Time: 02:13
 */

namespace PlayingCards\Games\Baccarat;

class Player extends \PlayingCards\Player
{
    private $bet_player;
    private $bet_banker;
    private $bet_tie;

    public function __construct($id)
    {
        parent::__construct($id);
    }

    /**
     * @return int
     */
    public function getPlayerBet()
    {
        return $this->bet_player;
    }

    /**
     * @return int
     */
    public function getBankerBet()
    {
        return $this->bet_banker;
    }

    /**
     * @return int
     */
    public function getTieBet()
    {
        return $this->bet_tie;
    }

    /**
     * @param int $amount
     */
    private function setPlayerBet($amount)
    {
        $this->bet_player = $amount;
    }

    /**
     * @param int $amount
     */
    private function setBankerBet($amount)
    {
        $this->bet_banker = $amount;
    }

    /**
     * @param int $amount
     */
    private function setTieBet($amount)
    {
        $this->bet_tie = $amount;
    }


    /**
     * @param $amount
     * @return Player
     * @throws \Exception
     */
    public function placePlayerBet($amount)
    {
        $this->fundsCheck($amount);
        $this->setPlayerBet($this->getPlayerBet() + $amount);
        $this->removeChips($amount);
        return $this;
    }

    /**
     * @param $amount
     * @return Player
     * @throws \Exception
     */
    public function placeBankerBet($amount)
    {
        $this->fundsCheck($amount);
        $this->setBankerBet($this->getBankerBet() + $amount);
        $this->removeChips($amount);
        return $this;
    }

    /**
     * @param $amount
     * @return Player
     * @throws \Exception
     */
    public function placeTieBet($amount)
    {
        $this->fundsCheck($amount);
        $this->setTieBet($this->getTieBet() + $amount);
        $this->removeChips($amount);
        return $this;
    }


    /**
     *  zeroes bets
     */
    public function clearBet()
    {
        $this->setBankerBet(0);
        $this->setPlayerBet(0);
        $this->setTieBet(0);
    }
}