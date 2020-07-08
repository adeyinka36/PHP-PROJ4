<?php
include_once "Phrase.php";

class Game{
    public $phrase;
    public $lives;

     function __construct($obj){

        $this->phrase=$obj;
        $this->lives=5;
     if(!isset($_SESSION["lives"])){
         $_SESSION["lives"]=$this->lives;
         }

    }

    public function check_for_win(){
    
       
        
        // var_dump($_SESSION["unique"]);
        // var_dump($_SESSION["selected"]);
        // die();

        if(count($_SESSION["unique"])==count($_SESSION["selected"])){
            $_SESSION["result"]="YOU WIN!";
          return true;
        }
        else{
            return false;
        }
    }

    public function check_for_loss(){
       
        if($_SESSION["lives"]<=0){
            
            $_SESSION["result"]="YOU LOSE!";
          return true;
        }
        else{
            return false;
        }
    }


  public function gameOver(){
    
      if($this->check_for_win()){
        
        header("Location: index.php");
      }
      else if ($this->check_for_loss()){
        
        header("Location: index.php");
      }
      else{
          return false;
      }
  }

  public function displayKeyboard(){
    //    global $keyboardForm;
    //    echo $keyboardForm;
    global $keyrow1;
    global $keyrow2;
    global $keyrow3;
   echo '<div id=qwerty class=section>
   
    <form action=play.php method=get>
    <div class=keyrow>';
     echo check1();
    echo '</div>
    <div class=keyrow>';
    echo check2();
    echo '</div>
    <div class=keyrow>';
    echo check3();
    echo '</div>
    </form>
    </div>';


  }

  public function displayScore(){
     
      $lost=5-$_SESSION["lives"];
      echo "<div id=scoreboard class=section>
      <ol>";
         for($i=0;$i<$lost;$i++){
           echo  "<li class=tries><img src=images/lostHeart.png height=35px widght=30px></li>";
         }
         for($i=0;$i<$_SESSION["lives"];$i++){
            echo  "<li class=tries><img src=images/liveHeart.png height=35px widght=30px></li>";
          }
        
      "</ol>
  </div>";
  }
}