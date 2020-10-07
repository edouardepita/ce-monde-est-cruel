<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class RugosaPlayers
 * @package Hackathon\PlayerIA
 * @author YOUR NAME HERE
 */
class TerreliaPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    protected $oppositePlayer;
    protected $lastchance;


    /* 

    1 - Je commence par une pierre
    2 - Je commence à renvoyer ce qui bat le cout n-1 
    3 - Ayant commencé par une pierre, je verifie si l'ennemi utilise la meme stratégie (cout 2 : papier ...)
    4 - Si au bout du 15eme round je ne suis toujours pas gagnant (calcul entre 10 et 15), j'alterne entre retourner ce qui contre le coup n-1 et contrer le contre (pour éviter que la stratégie soit anticipable)
  
    */
    public function getChoice()
    {   

        if ($this->result->getNbRound() == 0){
            $this->oppositePlayer = false;
            $this->lastchance = false;
            return parent::rockChoice();
        }
            
        if (($this->result->getNbRound() >= 4)
            && ($this->result->getChoicesFor($this->opponentSide)[1] == 'paper')
            && ($this->result->getChoicesFor($this->opponentSide)[2] == 'scissor') 
            && ($this->result->getChoicesFor($this->opponentSide)[3] == 'rock' )){
            $this->oppositePlayer = true;
        }

        if ($this->result->getNbRound() == 16) 
            {
                $ennemyScore = 0;
                $myScore = 0;
                for ($i = 5; $i <= 15; $i++){
                    $myScore += $this->result->getScoresFor($this->mySide)[$i];
                    $ennemyScore += $this->result->getScoresFor($this->opponentSide)[$i];
                }
                if ($ennemyScore > $myScore){
                    $lastchance = true;
                    $oppositePlayer = false;
                }
            }

        if ($this->lastchance){
            if ($this->result->getNbRound() % 2 == 0){
                if ($this->result->getLastChoiceFor($this->mySide) == 'rock'){
                    return parent::scissorsChoice();    
                }
                if ($this->result->getLastChoiceFor($this->mySide) == 'paper'){
                    return parent::rockChoice();
                }
                if ($this->result->getLastChoiceFor($this->mySide) == 'scissor'){
                    return parent::paperChoice();
                }
            }
            else{
                if ($this->result->getLastChoiceFor($this->opponentSide) == 'rock'){
                    return parent::paperChoice();
                }
                if ($this->result->getLastChoiceFor($this->opponentSide) == 'paper'){
                    return parent::scissorsChoice();
                }
                if ($this->result->getLastChoiceFor($this->opponentSide) == 'scissor'){
                    return parent::rockChoice();
                }
            }
        }

        if ($this->oppositePlayer){

            if ($this->result->getLastChoiceFor($this->mySide) == 'rock'){
                return parent::scissorsChoice();    
            }
            if ($this->result->getLastChoiceFor($this->mySide) == 'paper'){
                return parent::rockChoice();
            }
            if ($this->result->getLastChoiceFor($this->mySide) == 'scissor'){
                return parent::paperChoice();
            }
        }
        else{
            if ($this->result->getLastChoiceFor($this->opponentSide) == 'rock'){
                return parent::paperChoice();
            }
            if ($this->result->getLastChoiceFor($this->opponentSide) == 'paper'){
                return parent::scissorsChoice();
            }
            if ($this->result->getLastChoiceFor($this->opponentSide) == 'scissor'){
                return parent::rockChoice();
            }
        }

        // check last
        
        
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        return parent::rockChoice();

    }
};
    