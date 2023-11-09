<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table cellSpacing="7">
        <tr>
            <th>Division Ranking</th>
            <th>Team Tricode</th>
            <th>Team Name</th>
            <th>Team Locale</th>
            <th>Wins</th>
            <th>Loses</th>
            <th>Div Games Back</th>
            <th>Winpct</th>
            <th>Elim number</th>
        </tr>
        <?php
        $xml = simplexml_load_file("./Standings.xml") or die("Error: Cannot create object");
        $leagueArray = $xml->league;
        foreach ($leagueArray as $league) :
        ?>
            <?php
            foreach ($league->division as $key => $division) : ?>
                <?php foreach ($division->team as $team) : ?>
                    <tr>
                        <td><?= $team->divisionranking ?></td>
                        <td><?= $team->teamtricode ?></td>
                        <td><?= $team->teamname ?></td>
                        <td><?= $team->teamlocale ?></td>
                        <td><?= $team->wins ?></td>
                        <td><?= $team->loses ?></td>
                        <td><?= $team->divgamesback ?></td>
                        <td><?= $team->winpct ?></td>
                        <td><?= $team->elimnumber ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach;
        ?>
    </table>
</body>

</html>