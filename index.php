<?php
// désigner varibles pour :
    //chemin qui mène vers le CSV
$filePath = 'matches.csv';
    //Array des matches
$matches = [];
    //accéder au fichier avec les données nécessaires
$handle = fopen($filePath, 'r');
    //récupérer la première ligne du CSV qui sont les titrages dans un array
$headers = fgetcsv($handle, 1000);
    //récupérer les données dans un array
while($line = fgetcsv($handle, 1000)){
    $matches[] = array_combine($headers, $line);
}

require('vue.php');

