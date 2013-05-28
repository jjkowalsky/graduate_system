<?php
// Server in the this format: <computer>\<instance name> or 
// <server>,<port> when using a non default port number
//var $server = 'mssql.cs.mtsu.edu';

// Connect to MSSQL
$link = mssql_connect('mssql.cs.mtsu.edu', 'c8849011', 'ThhMzViO');

if (!$link) {
    die('Something went wrong while connecting to MSSQL');
}
else {
	die('successful link to mssql');
}

mssql_select_db('c8849011db', $link);

$query = 'select * from works_on;';
//var lastquery = $query;
$result = mssql_query($query, $link) or die('Error with Query('.$query.'): '.mssql_error());
return $result;

?>
