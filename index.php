<?php
Define('TODAY', (new DateTime('now', new DateTimeZone('Europe/Brussels')))->format('M jS, Y'));
Define('NOW', (new DateTime('now', new DateTimeZone('Europe/Brussels')))->format('Y-m-d'));

// désigner varibles pour :
    //chemin qui mène vers le CSV
define('FILE_PATH', 'matches.csv');
    //Array des matches
$matches = [];

$standings = [];
    //accéder au fichier avec les données nécessaires
$handle = fopen(FILE_PATH, 'r');
    //récupérer la première ligne du CSV qui sont les titrages dans un array
$headers = fgetcsv($handle, 1000);
    //récupérer les données dans un array
function getEmptyStatsArray() {
    return [
        'games'=>0,
        'points'=>0,
        'wins'=>0,
        'losses'=>0,
        'draws'=>0,
        'GF'=>0,
        'GA'=>0,
        'GD'=>0
    ];
}

while($line = fgetcsv($handle, 1000)){
    $match = array_combine($headers, $line);;
    $matches[] = $match;
    $homeTeam = $match['home-team'];
    $awayTeam = $match['away-team'];
    if(!array_key_exists($homeTeam, $standings)){
        $standings[$homeTeam] = getEmptyStatsArray();
    }
    if(!array_key_exists($awayTeam, $standings)){
        $standings[$awayTeam] = getEmptyStatsArray();
    }
    $standings[$homeTeam]['games']++;
    $standings[$awayTeam]['games']++;
    if($match['home-team-goals'] === $match['away-team-goals']){
        $standings[$homeTeam]['points']++;
        $standings[$awayTeam]['points']++;
        $standings[$homeTeam]['draws']++;
        $standings[$awayTeam]['draws']++;
    } elseif ($match['home-team-goals'] > $match['away-team-goals']){
        $standings[$homeTeam]['points']+=3;
        $standings[$homeTeam]['wins']++;
        $standings[$awayTeam]['losses']++;
    }else {
        $standings[$awayTeam]['points']+=3;
        $standings[$awayTeam]['wins']++;
        $standings[$homeTeam]['losses']++;
    }
    $standings[$homeTeam]['GF'] +=  $match['home-team-goals'];
    $standings[$homeTeam]['GA'] +=  $match['away-team-goals'];
    $standings[$awayTeam]['GF'] +=  $match['away-team-goals'];
    $standings[$awayTeam]['GA'] +=  $match['home-team-goals'];

    $standings[$homeTeam]['GD'] =  $standings[$homeTeam]['GF'] - $standings[$homeTeam]['GA'];
    $standings[$awayTeam]['GD'] =  $standings[$awayTeam]['GF'] - $standings[$awayTeam]['GA'];
}
uasort($standings, function ($a, $b){
    if($a['points'] === $b['points']){
        return 0;
    }
    return $a['points'] > $b['points'] ? -1: 1;
});
$teams = array_keys($standings);
sort($teams);

require('vue.php');

