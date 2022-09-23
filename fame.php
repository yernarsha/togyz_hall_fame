<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css"></head>
<body>

<?php
if ($_POST['mode'] === '0') {
    echo "Please select a mode.";
} else {
    require 'connection.php';

    $table_name = '';
    switch ($_POST['mode']) {
        case '1':
            $table_name = 'best_table';
            $game_name = 'Bestemshe';
            break;
        case '2':
            $table_name = 'bohn_table';
            $game_name = 'Bohnenspiel';
            break;
        case '3':
            $table_name = 'mang_table';
            $game_name = 'Mangala';
            break;
        case '4':
            $table_name = 'pod_table';
            $game_name = 'Poddavki';
            break;
        case '5':
            $table_name = 'qoz_table';
            $game_name = 'Qozdatu';
            break;
        case '6':
            $table_name = 'tog_table';
            $game_name = 'Togyz Kumalak';
            break;
    }

    if (!empty($table_name)) {
        echo '<h1>' . $game_name . ' Hall of Fame</h1>';
        echo '<table class="table"><thead><tr>
<th style="width:10%">N</th><th>Name</th><th>Rating</th>
</tr></thead><tbody>';

        mysqli_set_charset($connect, "utf8");
        $sql_stmt = "SELECT * FROM $table_name WHERE (_active=1) order by _rating_elo desc limit 200";
        $result = mysqli_query($connect, $sql_stmt);

        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $i++;
            if ($i % 3 == 0) {
                echo '<tr class="table-primary">';
            } else if ($i % 2 == 0) {
                echo '<tr class="table-success">';
            } else {
                echo '<tr class="table-warning">';
            }
            echo '<td>'. $i .'.</td>';
            echo '<td>'. $row['_name'] .'</td>';
            echo '<td>'. $row['_rating_elo'] .'</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    }

}
?>

</body>
</html>

