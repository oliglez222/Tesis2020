<?php

//$db = new SQLite3('sigenusimulated.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
$db=new SQLite3('Sigenu.db');


// $res=$db->query('SELECT * FROM studentsinfo');
// while($row=$res->fetchArray()){
// var_dump($row['ci']);

// }
$s=$db->query('SELECT * FROM estudiante LIMIT=10');
var_dump($s);
?>