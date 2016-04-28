<?php
$csvPath =  __DIR__.'\..\..\data\\';

$csvPaths = array(
	'autoren' => realpath($csvPath.'autoren.csv'),
	'buecher' => realpath($csvPath.'buecher.csv'),
	'zeitschriften' => realpath($csvPath.'zeitschriften.csv')
);