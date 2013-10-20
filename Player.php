<?php
/**
 * User: delboy1978uk
 * Date: 20/10/2013
 * Time: 17:03
 */

namespace PlayingCards;


class Player
{
    protected $id;
    protected $cards;
    protected $chips;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->cards = array();
        $this->chips = 0;
    }

    public function getID()
    {
        return $this->id;
    }

    /**
     * @param Card $card
     */
    public function addCard(Card $card)
    {
        array_push($this->cards,$card);
    }

    /**
     * Give it a value like AH for Ace of Hearts, 10D 10 of Diamonds etc
     * @param string $cardval
     * @return Card
     */
    public function removeCard($cardval)
    {
        for($x = 0; $x < count($this->cards); $x ++)
        {
            if($this->cards[$x]->getValue.$this->cards[$x]->getSuit() == $cardval)
            {
                $card = $this->cards[$x];
                $this->cards[$x] = null;
                return $card;
            }
        }
        return false;
    }

    /**
     * adds amount to chip total
     * returns balance
     * @param $amount
     * @return int
     */
    public function addChips($amount)
    {
        $this->chips = $this->chips + $amount;
        return $this->chips;
    }

    /**
     * deducts amount from chip total
     * returns balance
     * @param $amount
     * @return int
     */
    public function removeChips($amount)
    {
        $this->chips = $this->chips - $amount;
        return $this->chips;
    }

    /**
     * returns the players chip total
     * @return int
     */
    public function getBalance()
    {
        return $this->chips;
    }
}