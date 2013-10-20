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
            'H' => 'Hearts',
            'C' => 'Clubs',
            'D' => 'Diamonds',
            'S' => 'Spades'
        );
        $values = array(
            'A' => 'Ace',
            '2' => 'Two',
            '3' => 'Three',
            '4' => 'Four',
            '5' => 'Five',
            '6' => 'Six',
            '7' => 'Seven',
            '8' => 'Eight',
            '9' => 'Nine',
            '10' => 'Ten',
            'J' => 'Jack',
            'Q' => 'Queen',
            'K' => 'King'
        );
        foreach($suits as $suit => $suit_text)
        {
            foreach($values as $value => $value_text)
            {
                $card = new Card($suit,$value, $suit_text, $value_text);
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