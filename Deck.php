<?php
/**
 * User: delboy1978uk
 * Date: 19/10/2013
 * Time: 22:45
 */

namespace PlayingCards;


class Deck
{
    /**
     * @var array
     */
    protected $cards;

    /**
     *  Creates a deck of 52 Playing Cards
     */
    public function __construct()
    {
        $this->cards = array();
        $suits = array(
            'H','C','D','S'
        );
        $values = array(
            'A','2','3','4','5','6','7','8','9','10','J','Q','K'
        );
        foreach($suits as $suit)
        {
            foreach($values as $value)
            {
                $card = new Card($suit,$value);
                array_push($this->cards,$card);
            }
        }
    }

    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }
}