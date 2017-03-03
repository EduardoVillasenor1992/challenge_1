<?php
// $count = $_GET['count'];

// $countChar = $_GET['countChar']; // this is equal to colorPerCell
$letterExclude = $_GET['letterExclude']; // this is equal to color
$count = 6;
$countChar = 10;
$ARR = array();



// going to be the code to generate password
//echo "<td>" . chr(rand(65,91)) . "</td>";

function display()
{
  global $countChar, $count;
  $wrong = "";
  
  for($i = 0; $i < 6; $i++)
  {
      for($j = 0; $j < 10; $j++)
      {
          echo chr(rand(65,91));
          
          
      }
      echo "<br/>";
         
  }
  
    
}



?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        
        <?php
            display();
        ?>

    </body>
</html>
