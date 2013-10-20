<?php
/**
 * User: delboy1978uk
 * Date: 19/10/2013
 * Time: 22:37
 */

namespace PlayingCards;

class Shoe
{
    protected $num_decks;
    protected $cards;
    protected $discard_pile;


    /**
     * @param int $decks the number of decks to use
     */
    public function __construct($decks)
    {
        $this->cards = array();
        $this->discard_pile = array();
        $this->num_decks = $decks;
        for($x = 1; $x <= $decks; $x++)
        {
            $deck = new Deck();
            $cards = $deck->getCards();
            foreach($cards as $card)
            {
                array_push($this->cards, $card);
            }
        }
    }

    /**
     * @return Card
     * @throws \Exception
     */
    public function dealCard()
    {
        if(count($this->cards) == 0)
        {
            throw new \Exception('No more cards left to deal.');
        }
        return array_pop($this->cards);
    }

    /**
     * @param Card $card
     */
    public function discardCard(Card $card)
    {
        array_push($this->discard_pile, $card);
    }

    /**
     * Shuffles the cards
     */
    public function shuffleDeck()
    {
        shuffle($this->cards);
        shuffle($this->cards);
        shuffle($this->cards);
        $this->cutDeck();
    }

    /**
     * Chops the deck like in the casino
     * and moves the lot from the front to the back
     */
    private function cutDeck()
    {
        $num = count($this->cards);
        $rand = rand(0,($num - 1));
        for($x = 0; $x <= ($num - 1); $x++)
        {
            array_unshift($this->cards,array_pop($this->cards));
        }
    }

    /**
     * @return int
     */
    public function getCardsRemaining()
    {
        return count($this->cards);
    }

    public function resetShoe()
    {
        for($x = 0; $x < $this->getCardsRemaining(); $x++)
        {
            array_push($this->discard_pile,array_pop($this->cards));
        }
        $this->cards = $this->discard_pile;
        $this->discard_pile = array();
        foreach($this->cards as $card)
        {
            /** @var Card $card */
            $card->flipFaceUp();
        }
        $this->shuffleDeck();
    }

}