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

    public function getChoice()
    {   

        if ($this->result->getNbRound() == 0){
            $this->oppositePlayer = false;
            return parent::rockChoice();
        }
            
        if (($this->result->getNbRound() >= 4)
            && ($this->result->getChoicesFor($this->opponentSide)[1] == 'paper')
            && ($this->result->getChoicesFor($this->opponentSide)[2] == 'scissor') 
            && ($this->result->getChoicesFor($this->opponentSide)[3] == 'rock' )){
            $this->oppositePlayer = true;
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