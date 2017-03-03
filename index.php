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
  
  for($i = 0; $i < $count; $i++)
  {
      for($j = 0; $j < $countChar; $j++)
      {
          echo chr(rand(65,91));
      }
         
  }
  
    
}



?>
