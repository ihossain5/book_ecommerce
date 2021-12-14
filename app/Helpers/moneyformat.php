<?php
 


function currency_format($number){
  $number=round($number,2);

  if(setlocale(LC_MONETARY, 'bn_BD')){
   
  $formatter = new NumberFormatter('en_BD', NumberFormatter::DECIMAL);
$formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 2);
return($formatter->format($number));
     }
  else {

  $number = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $number);


  return $number;
  }
}
?>
