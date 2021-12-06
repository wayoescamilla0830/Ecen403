<?php
    
    $host = '10.183.215.234,1433';
    $connectionInfo = array("Database"=>"TBDraft", "UID"=>"admin1", "PWD"=>"TBuilder");
	$conn = sqlsrv_connect( $host, $connectionInfo);

	if( $conn ) {
		 echo "Connection established.<br />";
	}else{
		 echo "Connection could not be established.<br />";
		 die( print_r(sqlsrv_errors(), true));
	}
?>