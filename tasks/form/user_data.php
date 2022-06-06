<?php 

$data = [
	[
		$_POST['name'], 
		$_POST['email'], 
		$_POST['dob'], 
		$_POST['gender'], 
		$_POST['country']
	]
];

$handle = fopen('userdata.csv', 'a');

foreach($data as $row) {
	fputcsv($handle, $row);
}

fclose($handle);

print_r($data);