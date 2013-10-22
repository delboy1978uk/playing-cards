playing-cards
=============

PHP Playing Cards
-----------------

PHP objects for playing card games. Create a card shoe and specify how many decks of cards to use.<br />

The Shoe
--------

__construct($decks);<br />
dealCard();<br />
discardCard(Card $card)<br />
shuffleDeck();<br />
getCardsRemaining();<br />
resetShoe();<br />

The Card
--------

getSuit(); // eg. C, S, D, or H <br />
getValue(); // eg. A, K, Q, J, 10, 9, etc<br />
getAsText(); // eg. Ace of Spades<br />
getSuitAsText();<br />
getValueAsText();<br />
flipCard(); // toggles crd face up or face down
flipFaceDown();<br />
flipFaceUp();<br />
isFaceDown();<br />
getHtml($id = null)<br />
getJson();<br />

The Player
----------

__construct($id);<br />
getID();<br />
addCard(Card $card);<br />
removeCard($cardval); // The card as a shorthand string ie 10D<br />
addChips($amount);<br />
removeChips($amount);<br />
getBalance();<br />


The Table
---------

__construct(Shoe $shoe, array $players);<br />
addPlayer(Player $player);<br />
removePlayer($id);<br />
getPlayers(); //returns an array object with iterator<br />
getNumPlayers();<br />
getBanker();<br />
setShoe(Shoe $shoe);<br />
addToPot($amount);<br />
removeFromPot($amount);<br />
getPotBalance();<br />




