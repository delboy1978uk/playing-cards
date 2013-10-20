<?php
/**
 * User: delboy1978uk
 * Date: 20/10/2013
 * Time: 16:53
 */

namespace PlayingCards;


abstract class CardGame
{
    protected $name;
    protected $table;


    public abstract function startGame();

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }
}