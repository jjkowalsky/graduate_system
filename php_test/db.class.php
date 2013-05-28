<?php

class database {

	var $SQL;
	var $lastquery;
	var $count=0;

	function database($database, $server, $username, $password){
		$this->SQL = mssql_connect($server, $username, $password) or die('Error: '.mssql_error());
		mssql_select_db($database, $this->SQL);
	}

	function query($query, $return='true'){
		$this->lastquery = $query;
		$this->count++;
		$result = mssql_query($query, $this->SQL) or die('Error with Query('.$query.'): '.mssql_error());
		if ($return)
			return $result;
	}

	function num_rows(&$result){
		return @mssql_num_rows($result);
	}

	function fetch_array(&$result){
		return @mssql_fetch_array($result);
	}

	function fetch_assoc(&$result){
		return @mssql_fetch_assoc($result);
	}

	function insert_id(){
		return @mssql_insert_id();
	}

	function disconnect(){
		mssql_close($this->SQL);
	}

	function escape(&$string){
		return mssql_real_escape_string($string);
	}

	function result($query, $column, $id=0){
		return mssql_result($query, $id, $column);
	}
}
?>
