<?php
define('FILE_PATH', 'matches.csv');
function appendArrayToCSV(array $array, string $csvFile){
    $handle = fopen($csvFile, 'a');
    fputcsv($handle, $array);
    fclose($handle);
}
if((isset($_POST['action']))&&isset($_POST['resource'])){
    if($_POST['action']==='store' && $_POST['resource']==='match'){
        if( !empty($_POST['match-date']) &&
            !empty($_POST['home-team']) &&
            !empty($_POST['away-team-unlisted']) &&
            !empty($_POST['home-team-goals']) &&
            !empty($_POST['away-team-goals'])
        )
        {
            $matchDate = $_POST['match-date'];
            $homeTeam = $_POST['home-team'];
            $awayTeam = $_POST['away-team-unlisted'];
            $homeTeamGoals = $_POST['home-team-goals'];
            $awayTeamGoals = $_POST['away-team-goals'];

            $match = [$matchDate, $homeTeam, $homeTeamGoals, $awayTeamGoals, $awayTeam];
            appendArrayToCSV($match, FILE_PATH);
        }
    }

}
header('Location: index.php');
exit();