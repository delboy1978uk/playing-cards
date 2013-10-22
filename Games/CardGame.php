<?php
/**
 * User: delboy1978uk
 * Date: 20/10/2013
 * Time: 16:53
 */

namespace PlayingCards\Games;
use PlayingCards\Table;

abstract class CardGame
{
    protected $name;
    protected $table;


    public abstract function startGame();

    /**
     * @param string $name
     * @return CardGame
     */
    protected function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Table $table
     */
    protected function setTable(Table $table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }
}