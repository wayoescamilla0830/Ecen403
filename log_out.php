<?php
session_start();

    $host = '10.183.215.234,1433';
    $connectionInfo = array("Database"=>"TBDraft", "UID"=>"admin1", "PWD"=>"TBuilder");
	$conn = sqlsrv_connect( $host, $connectionInfo);
/*
    if( $conn ) {
        echo "Connection established.<br />";
   }else{
        echo "Connection could not be established.<br />";
        die( print_r(sqlsrv_errors(), true));
   }*/
   if ( sqlsrv_begin_transaction( $conn ) == false ) {
    die( print_r( sqlsrv_errors(), true ));
}

    if(isset($_POST['log_out'])){

        header("Location: Webpage.html");
}

?>
