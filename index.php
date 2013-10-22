<link rel="stylesheet" href="playing-cards.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<style>
    body
    {
        background-color: #005500;
    }
    li, div.playing-card
    {
        float:left;
    }
    p{clear: both; color: white;}
</style>



<?php
/**
 * User: delboy1978uk
 * Date: 19/10/2013
 * Time: 23:08
 */

require_once('Card.php');
require_once('Deck.php');
require_once('Shoe.php');
require_once('Table.php');
require_once('Player.php');
require_once('Banker.php');
require_once('Games/CardGame.php');
require_once('Games/Baccarat.php');
require_once('Games/Baccarat/Player.php');
require_once('Games/Baccarat/Hand.php');



/*
 *  To get started, create a new Card Shoe
 *  Telling it how many decks of cards to use
 *  Then give it a shuffle
 *  you can flip a card face down or face up
 *  when you are finished with the card you give it back to the shoe and
 *  put it in the discard pile
 */

$shoe = new PlayingCards\Shoe(1);
$shoe->shuffleDeck();

echo '<ul>';
for($x = 1; $x<= 52; $x++)
{
    $card =  $shoe->dealCard();
    if(rand(1,6) == 6)
    {
        $card->flipCard();
    }
    echo '<li>'.$card->getHtml().'</li>';
    $shoe->discardCard($card);
}
echo '</ul>';

/*
 * You can find out how many cards are left
 * resetting the shoe moves the cards back from the discard pile and reshuffles
 * You can also get a JSON version of the card
 */

echo '<p>'.$shoe->getCardsRemaining().' Cards remaining.<br />Reshuffling deck.<br />Dealing 1 card.';
$shoe->resetShoe();
$card = $shoe->dealCard();
echo $card->getJson().'</p>';




/*
 *  You get the idea! Lets start a fake game of baccarat
 *  You can create players and add them to a table
 */

echo '<h2>Baccarrat</h2>';

$p1 = new \PlayingCards\Games\Baccarat\Player(1);
$p2 = new \PlayingCards\Games\Baccarat\Player(2);
$p3 = new \PlayingCards\Games\Baccarat\Player(3);
$p4 = new \PlayingCards\Games\Baccarat\Player(4);

$p1->addChips(200);
$p2->addChips(79);
$p3->addChips(123);
$p4->addChips(166);

$players = array(
    $p1,$p2,$p3,$p4
);

$baccarat = new PlayingCards\Games\Baccarat($players);

$baccarat->dealInitialCards();

$players = $baccarat->getTable()->getPlayers()->getIterator();

//place a bet
while($players->valid())
{
    $choice = rand(1,3);
    $bet = rand(5,(round($players->current()->getBalance()/5)));
    echo 'Player '.$players->current()->getID().'('.$players->current()->getBalance().' BTC) bets '.$bet.' BTC on ';
    switch($choice)
    {
        case 1:
            $players->current()->placePlayerBet($bet);
            echo 'himself.<br />';
            break;
        case 2:
            $players->current()->placeBankerBet($bet);
            echo 'the Banker.<br />';
            break;
        case 3:
            $players->current()->placeTieBet($bet);
            echo 'a Tie.<br />';
            break;
    }
    $players->next();
}
$players->rewind();


for($x = 0; $x < $baccarat->getTable()->getNumPlayers(); $x++)
{
    /** @var \PlayingCards\Player $player  */
    $player = $players->current();
    $cards = $player->getCards()->getIterator();
    /** @var \PlayingCards\Card $card */
    $card = $cards->current();
    echo '<li><h3>Player '.$player->getID().'</h3>';
    echo 'Score: '.$baccarat->evaluateHand($player).'<br />';
    echo $card->getHtml();
    $cards->next();
    /** @var \PlayingCards\Card $card */
    $card = $cards->current();
    echo $card->getHtml().'</li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>';
    $players->next();

}
$players->rewind();

echo '<li><h3>Banker</h3>';
echo 'Score: '.$baccarat->evaluateHand($baccarat->getTable()->getBanker()).'<br />';
$cards = $baccarat->getTable()->getBanker()->getCards()->getIterator();
echo $cards->current()->getHtml();
$cards->next();
echo $cards->current()->getHtml().'</li>';

?>




<script type="text/javascript">
    $(document).ready(function(){

        /* clicking on a card to make it face down or face up


        $('li').click(function(){
            if($(this).find('div').hasClass('playing-card-facedown'))
            {
                $(this).find('div').removeClass('playing-card-facedown');
            }
            else
            {
                $(this).find('div').addClass('playing-card-facedown');
            }
        });
        */


        $('li').draggable();
    });
</script>