<link rel="stylesheet" href="playing-cards.css" />
<script type="text/javascript" src="../inc/jquery.min.js"></script>
<style>
    body
    {
        background-color: #005500;
    }
    li
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
 *  You can create players and add them to a table
 */

$p1 = new \PlayingCards\Player(1);
$p2 = new \PlayingCards\Player(2);
$p3 = new \PlayingCards\Player(3);
$p4 = new \PlayingCards\Player(4);

$p1->addChips(200);
$p2->addChips(79);
$p3->addChips(123);
$p4->addChips(166);

$players = array(
    $p1,$p2,$p3,$p4
);

$table = new \PlayingCards\Table($shoe,$players);

$current_player = $table->getFirstPlayer();
$card = $table->getShoe()->dealCard();
$current_player->addCard($card);

/**
 * @todo still to test all table and player functionality
 */

?>




<script type="text/javascript">
    $(document).ready(function(){

        //clicking on a card to make it face down or face up

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
    });
</script>