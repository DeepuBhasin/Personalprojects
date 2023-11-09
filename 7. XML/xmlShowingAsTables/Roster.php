<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php $xml = simplexml_load_file("./Roster.xml") or die("Error: Cannot create object"); ?>
    <table border="1">
        <?php foreach ($xml as $key => $team) : ?>
            <tr>
                <th>Team Name</th>
                <td colspan="20"><?= $key ?></td>
            </tr>
            <?php foreach ($team->team as $key => $data) : ?>
                <tr>
                    <td> Team Tri code: <?= $data->attributes()[0] ?></td>
                    <td>Team Name: <?= $data->attributes()[1] ?></td>
                    <td>Team locale : <?= $data->attributes()[2] ?></td>
                </tr>
                <?php foreach ($data as $player) : ?>
                    <tr>
                        <td>Player Number : <?= $player->attributes()[0] ?></td>
                        <td>Firstname : <?= $player->attributes()[1] ?></td>
                        <td>Lastname : <?= $player->attributes()[2] ?></td>
                        <td>fullname : <?= $player->attributes()[3] ?></td>
                        <td>battinghandltr : <?= $player->attributes()[4] ?></td>
                        <td>throwinghandltr: <?= $player->attributes()[5] ?></td>
                        <td>battinghand : <?= $player->attributes()[6] ?></td>
                        <td>throwinghand : <?= $player->attributes()[7] ?></td>
                        <td>games : <?= $player->attributes()[8] ?></td>
                        <td>playerbirthplace : <?= $player->attributes()[9] ?></td>
                        <td>playerdebutdate : <?= $player->attributes()[10] ?></td>

                    </tr>
                    <?php foreach ($player->bseasonstats as $bseasonstats) : ?>
                        <tr>
                            <td>avg : <?= $bseasonstats->attributes()[0]; ?></td>
                            <td>onbasepct : <?= $bseasonstats->attributes()[1]; ?></td>
                            <td>onbasepct : <?= $bseasonstats->attributes()[2]; ?></td>
                            <td>atbats : <?= $bseasonstats->attributes()[3]; ?></td>
                            <td>hits : <?= $bseasonstats->attributes()[4]; ?></td>
                            <td>doubles : <?= $bseasonstats->attributes()[5]; ?></td>
                            <td>doubles : <?= $bseasonstats->attributes()[6]; ?></td>
                            <td>hr : <?= $bseasonstats->attributes()[7]; ?></td>
                            <td>rbi : <?= $bseasonstats->attributes()[8]; ?></td>
                            <td>walks : <?= $bseasonstats->attributes()[9]; ?></td>
                            <td>strikeouts : <?= $bseasonstats->attributes()[10]; ?></td>
                            <td>runs : <?= $bseasonstats->attributes()[11]; ?></td>
                            <td>steals : <?= $bseasonstats->attributes()[12]; ?></td>
                            <td>sopercent : <?= $bseasonstats->attributes()[13]; ?></td>
                            <td>bbpercent : <?= $bseasonstats->attributes()[14]; ?></td>
                            <td>plateapp : <?= $bseasonstats->attributes()[15]; ?></td>
                            <td>totalbases : <?= $bseasonstats->attributes()[16]; ?></td>
                        </tr>
                        <?php foreach ($bseasonstats->hitfields as $hitfields) : ?>
                            <tr>
                                <td> leftinplaypct : <?= $hitfields->attributes()[0] ?></td>
                                <td> centerinplaypct : <?= $hitfields->attributes()[1] ?></td>
                                <td> rightinplaypct : <?= $hitfields->attributes()[2] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($bseasonstats->contact as $contact) : ?>
                            <tr>
                                <td> softcontactpct : <?= $contact->attributes()[0] ?></td>
                                <td> medcontactpct : <?= $contact->attributes()[1] ?></td>
                                <td> hardcontactpct : <?= $contact->attributes()[2] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($bseasonstats->trajectories as $trajectories) : ?>
                            <tr>
                                <td> groundballpct : <?= $trajectories->attributes()[0] ?></td>
                                <td> flyballpct : <?= $trajectories->attributes()[1] ?></td>
                                <td> linedrivepct : <?= $trajectories->attributes()[2] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($bseasonstats->hitballpcts as $hitballpcts) : ?>
                            <tr>
                                <td> avgexitvelo : <?= $hitballpcts->attributes()[0] ?></td>
                                <td> avglchangle : <?= $hitballpcts->attributes()[1] ?></td>
                                <td> brlhitballpct : <?= $hitballpcts->attributes()[2] ?></td>
                                <td> hardcontactpct : <?= $hitballpcts->attributes()[3] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php foreach ($player->pseasonstats as $pseasonstats) : ?>
                        <tr>
                            <td>avg : <?= $pseasonstats->attributes()[0]; ?></td>
                            <td>onbasepct : <?= $pseasonstats->attributes()[1]; ?></td>
                            <td>onbasepct : <?= $pseasonstats->attributes()[2]; ?></td>
                            <td>atbats : <?= $pseasonstats->attributes()[3]; ?></td>
                            <td>hits : <?= $pseasonstats->attributes()[4]; ?></td>
                            <td>doubles : <?= $pseasonstats->attributes()[5]; ?></td>
                            <td>doubles : <?= $pseasonstats->attributes()[6]; ?></td>
                            <td>hr : <?= $pseasonstats->attributes()[7]; ?></td>
                            <td>rbi : <?= $pseasonstats->attributes()[8]; ?></td>
                            <td>walks : <?= $pseasonstats->attributes()[9]; ?></td>
                            <td>strikeouts : <?= $pseasonstats->attributes()[10]; ?></td>
                            <td>runs : <?= $pseasonstats->attributes()[11]; ?></td>
                            <td>steals : <?= $pseasonstats->attributes()[12]; ?></td>
                            <td>sopercent : <?= $pseasonstats->attributes()[13]; ?></td>
                            <td>bbpercent : <?= $pseasonstats->attributes()[14]; ?></td>
                            <td>plateapp : <?= $pseasonstats->attributes()[15]; ?></td>
                            <td>totalbases : <?= $pseasonstats->attributes()[16]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>