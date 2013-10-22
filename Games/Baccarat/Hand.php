<?php
/**
 * User: delboy1978uk
 * Date: 22/10/2013
 * Time: 02:47
 */

namespace PlayingCards\Games\Baccarat;


class Hand
{
    public static function evaluate(\ArrayObject $cards)
    {
        $hand_score = 0;

        /** @var \PlayingCards\Card $card */
        foreach($cards as $card)
        {
            switch($card->getValue())
            {
                case 'A':
                    $val = 1;
                    break;
                case '10':
                case 'J':
                case 'Q':
                case 'K':
                    $val = 0;
                    break;
                default:
                    $val = $card->getValue();
                    break;
            }
            $hand_score = $hand_score + $val;
        }
        return $hand_score % 10;
    }
}