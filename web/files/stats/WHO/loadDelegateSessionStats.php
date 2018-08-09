<?php

//
// Requires POST params:
//    ComCode        -->  Official abbreviation please. (VADER, GA-6, JCC-ALLIED, etc.)
//    PortfolioNames  -->  Can have apostrophes! :D
//

// Retrieved from: http://stackoverflow.com/questions/14114411/remove-all-special-characters-from-a-string
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function loadFile($path) {
	/*$file = fopen($path, "r") or die('Error opening/creating ' . $path);
	echo fread($file, filesize($path)) or die('Error reading from ' . $path);
	fclose($file);*/
	
	global $stats_superArray;
	array_push($stats_superArray, json_decode( file_get_contents($path) ) );
}



$stats_superArray = [];
$portfolioNames = json_decode( $_POST['PortfolioNames'] );

for( $i = 0; $i < count($portfolioNames); $i++ ) {
	$portfolioName = $portfolioNames[$i];
	
	$path = "../web/files/stats/" . strtoupper($_POST['ComCode']) . "/" . clean($portfolioName) . ".json";
	loadFile($path);
}

echo json_encode($stats_superArray);
print_r($stats_superArray);
?>
