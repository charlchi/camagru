#!/usr/bin/php
<?php

$stockpath = 'resources/stock';

if (!file_exists('resources/init.csv'))
{
	echo "Error: No init file found in resources/";
	exit();
}
$file = file('resources/init.csv');
// name;artist;year;genre;

$stock = array();
$id = 0;
foreach ($file as $line)
{
	$values = explode(';', $line);
	$stock[$id]['name']   = $values[0];
	$stock[$id]['artist'] = $values[1];
	$stock[$id]['year']   = $values[2];
	$stock[$id]['genre']  = explode(',', $values[3]);
	$stock[$id]['path']   = $values[4];
	$stock[$id]['price']   = intval($values[5]);
	$stock[$id]['id']   = $id;
	$id++;
}
file_put_contents($stockpath, serialize($stock));

?>
