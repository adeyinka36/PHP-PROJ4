
<?php


session_start();


 
 

   if(empty($_SESSION["allSelected"])){
    $_SESSION["allSelected"]=[];
   }
   if(empty($_SESSION["unique"])){
    $_SESSION["unique"]=[];
   }
//    if(empty($_SESSION["lives"])){
//     $_SESSION["lives"]=null;
//    }
   
   if(empty($_SESSION["selected"])){
    $_SESSION["selected"]=[];
    }
    if(empty($_SESSION["currentPhrase"])){
       
    $_SESSION["currentPhrase"]=[];
    }
    
   include 'inc/Phrase.php';
   include 'inc/Game.php';
   
   
   
   if(empty($_SESSION["currentPhrase"])){
    $phrase=new Phrase();
    $_SESSION["currentPhrase"]=$phrase->currentPhrase;
    $_SESSION["unique"]=$phrase->unique;
    
  }
  else{
     $phrase=new Phrase($_SESSION["currentPhrase"],$_SESSION["selected"]);
     $_SESSION["currentPhrase"]=$phrase->currentPhrase;
     
     $_SESSION["unique"]=$phrase->unique;
 }
    $game=new Game($phrase);
   if(isset($_GET["choice"])){
    $choice=$_GET["choice"];
    $_GET["choice"]=null;
   
    
   
    // cehck if the choice matches any in the currentPhrase session(minus a life if it doesn't)
    $phrase->checkLetter($choice);
   
    
    // add chosen letter to selected and disable the button
    array_push($_SESSION["allSelected"],$choice);
    

    // check gameover
    
    $game->gameOver();
  
    if(!isset($_SESSION["result"])){
        header("Location:play.php");
    }

//array_push($_SESSION["selected"],$choice);

    
 }
//  if(count($_SESSION["currentPhrase"])==0){
//    $phrase=new Phrase();
//    $_SESSION["currentPhrase"]=$phrase->currentPhrase;
//    $_SESSION["unique"]=array_unique($_SESSION["currentPhrase"]);
//  }
//  else{
//     $phrase=new Phrase($_SESSION["currentPhrase"],$_SESSION["selected"]);
//     $_SESSION["currentPhrase"]=$phrase->currentPhrase;
//     $_SESSION["unique"]=array_unique($_SESSION["currentPhrase"]);
// }
 
       
   
  

//    check if game has been won
  
   
//    function  to check if values match
// function checkLetter($val){
//     global $choice;
//     if($val==$choice){
//         return false;
//     }
//     else{
//         return true;
//     }
// }

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="css/animate.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
        <?php echo $phrase->addPhraseToDisplay();?>
        <?php echo $game->displayKeyboard();?>
        <?php echo $game->displayScore();?>
    </div>
</div>
<script src="inc/javascript/index.js?v=<?php echo time(); ?>"></script>
</body>
</html>
