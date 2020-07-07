<?php
 $phrases= ["Believe in yourself","Never give up","I will be back","The world is yours"];

// $keyrow1=["q","w","e","r","t","y","u","i","o","p"];
// $keyrow2=["a","s","d","f","g","h","j","k","l"];
// $keyrow3=["z","x","c","v","b","n",]


$keyboardForm="<div id=qwerty class=section>
<div class=keyrow>
<form action=play.php method=get>
    <button class=key value=q name=choice>q</button>
    <button class=key value=w name=choice>w</button>
    <button class=key value=e name=choice>e</button>
    <button class=key value=r name=choice>r</button>
    <button class=key value=t name=choice>t</button>
    <button class=key value=y name=choice>y</button>
    <button class=key value=u name=choice>u</button>
    <button class=key value=i name=choice>i</button>
    <button class=key value=o name=choice>o</button>
    <button class=key value=p name=choice>p</button>
</div>

<div class=keyrow>
    <button class=key value=a name=choice>a</button>
    <button class=key value=s name=choice>s</button>
    <button class=key value=d name=choice>d</button>
    <button class=key value=f name=choice>f</button>
    <button class=key value=g name=choice>g</button>
    <button class=key value=h name=choice>h</button>
    <button class=key value=j name=choice>j</button>
    <button class=key value=k name=choice>k</button>
    <button class=key value=l name=choice>l</button>
</div>

<div class=keyrow>
    <button class=key value=z name=choice>z</button>
    <button class=key value=x name=choice>x</button>
    <button class=key value=c name=choice>c</button>
    <button class=key value=v name=choice>v</button>
    <button class=key value=b name=choice>b</button>
    <button class=key value=n name=choice>n</button>
    <button class=key value=m name=choice>m</button>
</div>
</form>
</div>";
class Phrase{
   public $currentPhrase;
   public $selected=[];
   public $splitPhrase=[];
   public $unique=[];
   

   function __construct($phrase=null,$selected=[]){
    
       if($phrase!=null){
          
       $this->currentPhrase=$phrase;
       $this->selected=$selected;

       }
       else{
           global $phrases;
           shuffle($phrases);
           $this->currentPhrase=$phrases[1];
           $this->selected=$selected;
       }
      
       $stringWithoutSpace=str_replace(' ', '', $this->currentPhrase);
        $this->splitPhrase=str_split($stringWithoutSpace,1);

    //    if (count($_SESSION["currentPhrase"])==0){
    //        $_SESSION["currentPhrase"]=str_split($stringWithoutSpace,1);
    //    }
     $_SESSION["currentPhrase"]=$this->currentPhrase;
     $_SESSION["unique"]=array_unique($this->splitPhrase);
     $this->unique=$_SESSION["unique"];
     
    }     
    
    public function addPhraseToDisplay(){
   
       echo "<div id=phrase class=section>
       <ul>";
       
          foreach($this->splitPhrase as $p){
           
              if($p!=" " && !in_array(strtolower($p),$this->selected) ){
              echo
                  "<li class='hide letter $p'>".$p."</li>";
          }
          else if ($p!=" " && in_array(strtolower($p),$this->selected)){
           echo "<li class='letter $p show'>".$p."</li>";
          }
          else{
            echo "<li class=hide space>".$p."</li>";
          }
        }           
       echo "</ul>
       </div>";
      
        } 

   public function checkLetter($letter){
       if(in_array($letter,$this->unique)||in_array(strtoupper($letter),$this->unique)){
         
           array_push($_SESSION["selected"],$letter);
           
           return true;
       }
       else{
       
         $_SESSION["lives"]--;
         
           return false;
       }
   }
}



class Game{
    public $phrase;
    public $lives=4;

     function __construct($obj){

        $this->phrase=$obj;
        $this->lives=5;
     if(is_null($_SESSION["lives"])){
         $_SESSION["lives"]=$this->lives;
         }

    }

    public function check_for_win(){
        
        if(count($_SESSION["unique"])==count($_SESSION["selected"])){
            echo "game won";
            die();
          return true;
        }
        else{
            return false;
        }
    }

    public function check_for_loss(){
       
        if($_SESSION["lives"]<=0){
            echo "game lost";
            die();
          return true;
        }
        else{
            return false;
        }
    }


  public function gameOver(){
     
      if($this->check_for_win()){
          echo "game over!";
          session_destroy();
          die();
      }
      else if ($this->check_for_loss()){
        echo "game over you lose!";
        session_destroy();
        die();
      }
      else{
          return false;
      }
  }

  public function displayKeyboard(){
       global $keyboardForm;
       echo $keyboardForm;
  }

  public function displayScore(){
      $lost=5-$_SESSION["lives"];
      echo "<div id=scoreboard class=section>
      <ol>";
         for($i=0;$i<$lost;$i++){
           echo  "<li class=tries><img src=images/lostHeart.png height=35px widght=30px></li>";
         }
         for($i=0;$i<$_SESSION["lives"];$i++){
            echo  "<li class=tries><img src=images/lostHeart.png height=35px widght=30px></li>";
          }
        //   <li class=tries><img src=images/liveHeart.png height=35px widght=30px></li>
        //   <li class=tries><img src=images/liveHeart.png height=35px widght=30px></li>
        //   <li class=tries><img src=images/liveHeart.png height=35px widght=30px></li>
        //   <li class=tries><img src=images/liveHeart.png height=35px widght=30px></li>
        //   <li class=tries><img src=images/liveHeart.png height=35px widght=30px></li>
      "</ol>
  </div>";
  }
}

