<?php
/**
 * User: delboy1978uk
 * Date: 19/10/2013
 * Time: 22:45
 */

namespace PlayingCards;


class Card
{
    protected $suit;
    protected $value;
    protected $suit_text;
    protected $value_text;
    protected $facedown = false;

    public function __construct($suit, $value,$suit_text,$value_text)
    {
        $this->suit = $suit;
        $this->value = $value;
        $this->suit_text = $suit_text;
        $this->value_text = $value_text;
    }

    /**
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getAsText()
    {
        return $this->value_text.' of '.$this->suit_text;
    }

    /**
     * @return string
     */
    public function getSuitAsText()
    {
        return $this->suit_text;
    }

    /**
     * @return string
     */
    public function getValueAsText()
    {
        return $this->value_text;
    }

    /**
     * Generates HTML for the card
     * @param string $id
     * @return string
     */
    public function getHtml($id = null)
    {
        $html = '<div id="'.$id.'" class="playing-card card-'
            .strtolower($this->getValue())
            .strtolower($this->getSuit()).' ';
        if($this->facedown == true){$html .= 'playing-card-facedown ';}
        $html .= '"></div>';
        return $html;
    }

    /**
     * @return string
     */
    public function getJson()
    {
        $class = 'playing-card card-'.strtolower($this->getValue()).strtolower($this->getSuit()).' ';
        if($this->facedown == true){$class .= 'playing-card-facedown ';}

        $array = array(
            'suit' => $this->getSuit(),
            'value' => $this->getValue(),
            'suit_text' => $this->getSuitAsText(),
            'value_text' => $this->getValueAsText(),
            'facedown' => $this->facedown,
            'divclass' => $class
        );
        return json_encode($array);
    }

    /**
     * Flips the card face up or face down
     */
    public function flipCard()
    {
        if($this->facedown == false)
        {
            $this->facedown = true;
        }
        else
        {
            $this->facedown = false;
        }
    }

    /**
     * Flips the card face down
     */
    public function flipFaceDown()
    {
        $this->facedown = true;
    }

    /**
     * Flips the card face up
     */
    public function flipFaceUp()
    {
        $this->facedown = false;
    }
}