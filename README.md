playing-cards
=============

PHP Playing Cards
-----------------

PHP objects for playing card games. Create a card shoe and specify how many decks of cards to use.<br />

The Shoe
--------

public function __construct($decks);<br />
public function dealCard();<br />
public function discardCard(Card $card)<br />
public function shuffleDeck();<br />
public function getCardsRemaining();<br />
public function resetShoe();<br />

The Card
--------

public function getSuit(); // eg. C, S, D, or H <br />
public function getValue(); // eg. A, K, Q, J, 10, 9, etc<br />
public function getAsText(); // eg. Ace of Spades<br />
public function getSuitAsText();<br />
public function getValueAsText();<br />
public function flipCard(); // toggles crd face up or face down
public function flipFaceDown();<br />
public function flipFaceUp();<br />
public function isFaceDown();<br />
public function getHtml($id = null)<br />
public function getJson();<br />

The Player
----------

Still unused and needing testing so far<br />
&nbsp;<br />
public function __construct($id);<br />
public function getID();<br />
public function addCard(Card $card);<br />
public function removeCard($cardval); // The card as a shorthand string ie 10D<br />
public function addChips($amount);<br />
public function removeChips($amount);<br />
public function getBalance();<br />

The Table
---------

Again, in development and untested so far. <br />
&nbsp;<br />
public function __construct(Shoe $shoe, array $players);<br />
public function addPlayer(Player $player);<br />
public function removePlayer($id);<br />
public function getPlayers(); //returns an array object with iterator<br />
public function getNumPlayers();<br />
public function getBanker();<br />
public function setShoe(Shoe $shoe);<br />
public function addToPot($amount);<br />
public function removeFromPot($amount);<br />
public function getPotBalance();<br />




