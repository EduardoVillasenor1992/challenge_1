<?php

include '../lab2/LEDBoard/ledLetters.php';


function isFormValid() {
    global $colorPerWord;
    global $colorPerCell;
    if(isset($_GET['submitForm'])){
         
        if(strlen($_GET['message']) >= 16){
            echo "<h3>Message should be less than 16 characters!</h3>";
            return false;
        }
        if(empty($_GET['message'])){
            echo "<h3>Message shouldn't be blank!</h3>";
            return false;
        }
        if(!numberOfCustomColors($colorPerWord)){
            echo "<h3>Please enter three color values when choosing this option!</h3>";
            return false;
        }
        if(!isset($_GET['colorPerCell'])){
            echo "<h3>Please choose yes or no for color per cell!</h3>";
            return false;
        }
        return true;
    }
}

function displayOrHideForm() {
    if(isset($_GET['submitForm'])){ //check if form has been submitted
        if(isset($_GET['displayForm'])){ //isset() checks if form element is part of the URL
            return "block";
        }
        return "none";
    }
}

function numberOfCustomColors($colorPerWord) {
    global $colorPerWord;
    if($colorPerWord[0] == "" && ($colorPerWord[1] != "" || $colorPerWord[2] != "")){
        return false;
    }
    elseif($colorPerWord[0] != "" && ($colorPerWord[1] == "" || $colorPerWord[2] == "")){
        return false;
    }
    return true;
}
 function led($phrase, $color) {
     global $colorPerCell;
     global $colorPerWord;
     global $color;
     $eachword = explode(" ", $phrase);
     if($colorPerCell == 'y'){
         $color = "rainbow";
     }
     if((($colorPerWord[0] == "" && $colorPerWord[1] == "" && $colorPerWord[2] == "") && $colorPerCell == 'n') || 
        (($colorPerWord[0] == "" && $colorPerWord[1] == "" && $colorPerWord[2] == "") && $colorPerCell == 'y')) {
         for($j = 0; $j < count($eachword); $j++){
             for ($i = 0; $i < strlen($eachword[$j]); $i++ ) {
                drawLetter($eachword[$j][$i],$color);
              }
              echo "<br />";
         }
     }
     elseif(numberOfCustomColors($colorPerWord) && $colorPerCell == 'n'){
         for($j = 0; $j < count($eachword); $j++){
             for ($i = 0; $i < strlen($eachword[$j]); $i++ ) {
                drawLetter($eachword[$j][$i],$colorPerWord[rand(0,count($colorPerWord) - 1)]);
              }
              echo "<br />";
         }
     }
     
 }

$message = $_GET['message'];
$color = $_GET['color'];
$colorPerCell = $_GET['colorPerCell'];
$colorPerWord = $_GET['colorPerWord'];

function dropdown_letters(){
    for($i = 65; $i < 91; $i++){
        echo '<option value="&#' . $i . '">&#' . $i . '</option>';
    };
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Custom LED Board</title>
        <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet"> 
        <style>
            @import url("./css/styles.css");
            
            table {
                border: 0px !important;
            }
            form {
                /*display:none;  /* Hides form
                display:block; /*shows form */
                display: <?=displayOrHideForm()?>;
                font-size: 1.0em;
                font-family: 'Orbitron', sans-serif;
            }
        </style>
    </head>
    <body>

    <h1>Custom LED Board</h1>
    <div>
        <form method="GET">
          How many passwords? <input type="text" name="message" size="5" maxlength="5" placeholder="Type message" >
          <br /><br />
          Password Length 
          
          <input id="cpcYes" type="radio" name="six_chars" value="6"><label for="cpcYes">6 characters</label>
          <input id="cpcNo" type="radio" name="eight_chars" value="8"><label for="cpcNo">8 characters</label>
          <input id="cpcNo" type="radio" name="ten_chars" value="8"><label for="cpcNo">10 characters</label>
          
          <br /> <br />
          
          Letters to exclude 
          <select name="color">
              <?php dropdown_letters() ?>   
          </select>
          <br /> <br />
          <input id="displayForm" type="checkbox" name="displayForm" checked /><label for="displayForm">Display form again</label>
          <br /><br />
          
          
          <input name="submitForm" type="submit" value="Generate Passwords"/>
          
          </form>
          
          <br />
          
          <?php
          if(isFormValid()) {
            led($message, $color);
          }
          ?>
    </div>
        
    </body>
</html>