<?php

include 'index.php';


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
        <title>Password Challenge</title>
        <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet"> 
        <style>
            @import url("./css/styles.css");
            
            table {
                border: 0px !important;
            }
            form {
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
          
          <input id="six_chars" type="radio" name="chars" value="6"><label for="six_chars">6 characters</label>
          <input id="eight_chars" type="radio" name="chars" value="8"><label for="eight_chars">8 characters</label>
          <input id="ten_chars" type="radio" name="chars" value="8"><label for="ten_chars">10 characters</label>
          
          <br /> <br />
          
          Letters to exclude 
          <select name="letters_dropdown">
              <?php dropdown_letters() ?>   
          </select>
          <br /> <br />
          
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