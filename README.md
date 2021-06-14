# finalproject_webprog - Scotland Yard

_Oscar, Björn, Dennis en Noor_

We have created an online game by creating an online version of the game Scotland Yard.

To play this game with multiple people, one person has to be the host. That person will copy the id number and give it to the other players. These players will join the game with this id number. The host will choose who will be Mister X, and will then start the game. 

The players are not able to see Mister X, only after a certain amount of moves. There need to be 4 or 5 players to start the game. The rules of the game are explained on our website.

We have uploaded the game to a webhosting server: 

https://londondetectivegame.000webhostapp.com/

However, we encountered some problems when playing it on here. The json value that is used as our database, can have a value of `null`. We have not been able to track the cause of this problem. You can play the game on your localhost with MAMP or by using the following command (with this command you can also use other devices on your local network to visit the site and play the game):

```
 php -S 0.0.0.0:4000 
```

The problem is less frequent when using the last options, but the json value will occasionally still have a value of `null`. You are unable to continue the game when the json file has a value of `null`. You are still able to host a new game after the json got a value of `null`.

Good luck with playing!

