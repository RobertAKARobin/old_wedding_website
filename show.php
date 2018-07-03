<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Who's coming to the wedding?</title>
<style>
td
{
font-size:14px;
vertical-align:top;
padding:5px 10px;
outline:1px dotted #cccccc;
}
tr:first-of-type td
{
font-weight:bold;
}
</style>
<body>

<table>
<?php

$guestlist = json_decode(file_get_contents("people.json"),true);

echo "<tr><td>&num;</td>";
foreach($guestlist[0] as $header => $val){
    echo "<td>" . ucfirst($header) . "</td>";
}
echo "</tr>";

$num = 0;
foreach($guestlist as $person){
    $num++;
    echo "<tr><td>$num</td>";
    foreach($person as $val){
        echo "<td>" . ucfirst($val) . "</td>";
    }
    echo "</tr>";
}

?>
</table>


</body>
</html>