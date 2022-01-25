<?php

function currencyConverter($fromCurrency,$toCurrency,$amount) {	
	$fromCurrency = urlencode($fromCurrency);
	$toCurrency = urlencode($toCurrency);	
	$url  = "https://www.google.com/search?q=".$fromCurrency."+to+".$toCurrency;
	$get = file_get_contents($url);
	$data = preg_split('/\D\s(.*?)\s=\s/',$get);
	$exhangeRate = (float) substr($data[1],0,7);
	$convertedAmount = $amount*$exhangeRate;
	return $convertedAmount;	
}

function ZARtoUSD($amt){
   return currencyConverter("ZAR","USD",$amt);
}

function USDtoZAR($amt){
    return currencyConverter("USD","ZAR",$amt);
 }

?>