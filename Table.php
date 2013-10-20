<?php
/**
 * User: delboy1978uk
 * Date: 20/10/2013
 * Time: 16:45
 */

namespace PlayingCards;


class Table
{
    protected $shoe;
    protected $players;
    protected $pot;

    /**
     * @param Shoe $shoe
     * @param array $players
     */
    public function __construct(Shoe $shoe, array $players)
    {
        $this->setShoe($shoe);
        $this->players = new \ArrayObject();
        foreach($players as $player)
        {
            $this->addPlayer($player);
        }
        $this->pot = 0;
    }

    /**
     * Adds new Player
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players->append($player);
    }


    /**
     * Deletes player
     * @param $id
     */
    public function removePlayer($id)
    {
        while($this->players->getIterator()->valid())
        {
            if($this->players->getIterator()->current()->getID() == $id)
            {
                $this->players->offsetUnset($this->players->getIterator()->current());
            }
        }
        $this->players->getIterator()->rewind();
    }


    /**
     * @return \ArrayObject
     */
    public function getPlayers()
    {
        return $this->players;
    }


    /**
     * @param Shoe $shoe
     */
    public function setShoe(Shoe $shoe)
    {
        $this->shoe = $shoe;
    }

    /**
     * @return Shoe
     */
    public function getShoe()
    {
        return $this->shoe;
    }


    public function getFirstPlayer()
    {
        $this->players->getIterator()->rewind();
        return $this->players->getIterator()->current();
    }

    /**
     * @return Player
     */
    public function getNextPlayer()
    {
        $this->players->getIterator()->next();
        if($this->players->getIterator()->valid())
        {
            return $this->players->getIterator()->current();
        }
        else
        {
            $this->players->getIterator()->rewind();
            return $this->players->getIterator()->current();
        }
    }

    /**
     * @param $amount
     * @return int
     */
    public function addToPot($amount)
    {
        $this->pot = $this->pot + $amount;
        return $this->pot;
    }

    /**
     * @param $amount
     * @return int
     */
    public function removeFromPot($amount)
    {
        $this->pot = $this->pot - $amount;
        return $this->pot;
    }

    /**
     * @return int
     */
    public function getPotBalance()
    {
        return $this->pot;
    }

}