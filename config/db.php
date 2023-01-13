<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$name = 'db-perpustakaan';

$db = new PDO('mysql:host=' . $host . ';dbname=' . $name, $user, $pass);