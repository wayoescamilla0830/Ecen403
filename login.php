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
   if ( sqlsrv_begin_transaction( $conn ) === false ) {
    die( print_r( sqlsrv_errors(), true ));
}
   
    if(isset($_POST['submit'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM ProfessorLogin WHERE username ='{$username}' AND passw='{$password}'";
        $result = sqlsrv_query($conn, $query);

        if($result == false){
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_has_rows($result) != 1){
            echo "Incorrect Username/Password";
        }else{
            header("Location: Prof-Page.html");
        }

    }

?>