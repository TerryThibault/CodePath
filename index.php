<?php

	$subTotal = 0;
	$percentage = 20;

	// If the values are posted, update the defaults. If not, the form was not submitted.
	if (isSubmitted()) {
		$subTotal = $_POST["subTotal"];
		$percentage = $_POST["percentage"];
	}
	
	// This function will check if the subTotal and percentage values are greater than 0.
	// This is an easy way to ensure that the values are not only set, but are also valid.
	function isSubmitted() {
		if ($_POST["subTotal"] > 0 && $_POST["percentage"] > 0) {
			return True;
		}
	}
	
	// This function will calculate the expected tip, given a subtotal and tip percentage.
	function calculateTip($subTotal, $percentage) {
		return $subTotal * $percentage / 100;
	}
	
	// This function will print the tip out to screen. This function should only be called if 
	// the form has previously been submitted.
	function printResult($subTotal, $percentage) {
		$tip = number_format((float)calculateTip($subTotal, $percentage), 2, '.', '');	// Format tip and total
		$total = number_format((float) ($subTotal + $tip), 2, '.', ''); 		// to fit 2 decimal places
		echo	'<p>
			Tip: ' . $tip . ' </br>
			Total: ' . $total;
	}

	// This function will print three predefined percentages, as per the assignment requirements.
	// This function takes an input, persistantPercent, that tells the function which of the
	// radio buttons should be highlighted based on POST information. 
	function printPercentages($persistantPercent) {
		$percentages = array(10, 15, 20);
		foreach ($percentages as $i) {
			echo '	<p>
				<input class="with-gap" value="' . $i . '" name="percentage" type="radio" id="' . $i . '" '; 
				
				if ($i == $persistantPercent) {
					echo 'checked';
				} 	
			echo '	>
				<label for="' . $i . '">' . $i . '%</label>
				</p>
				';
		}
	}

	function printForm($subTotal, $percentage) {
		if ($_POST["subTotal"] < 1 && !empty($_POST["subTotal"])) {
			echo '<p class="red">Invalid subtotal.</p>';
			$subTotal = $_POST["subTotal"];
		}
		echo '
		<form class="col s6" action="" method="POST">
			<span>Bill subtotal: <input type="text" name="subTotal" value="' . $subTotal .'"> ';
			echo '</span>';
				printPercentages($percentage);	
		echo '<input type="submit" value="Submit">
		</form> 
		';
	}

?>

<html>
<head>
	<title>Tip Calculator</title>
  <!-- Materialize CSS for prettification of the form -->
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
  <!-- Materialize buttons -->        
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
<div class="container">

	<?php
	printForm($subTotal, $percentage);
	printResult($subTotal, $percentage);
	?>

</div>
</body>
</html>
