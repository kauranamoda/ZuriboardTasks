<?php 

// addition
function add($first_val, $second_val) {
	return $first_val + $second_val;
}

//subtraction
function subtract($first_val, $second_val) {
	return $first_val - $second_val;
}

//division
function divide($first_val, $second_val) {
	return $first_val / $second_val;
}

//multiplication
function multiply($first_val, $second_val) {
	return $first_val * $second_val;
}

//modulus
function modulus($first_val, $second_val) {
	return $first_val % $second_val;
}


echo modulus(5, 2);

?>