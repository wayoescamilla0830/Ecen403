<?php
session_start();

    $host = '10.183.215.166,1433';
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

    if(isset($_POST['save_data'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['psw'];
        $repeat = $_POST['psw-repeat'];

        if ($password != $repeat){
            
            echo "Passwords Incorrect";            
        }else{
           
        $sql = "INSERT INTO ProfessorLogin (ProfessorName, username,passw, email) VALUES (?, ?, ?, ?)";
        $params = array($name, $username, $password, $email);
        $stmt = sqlsrv_query($conn, $sql, $params);
        sqlsrv_commit($conn);

        if($stmt == true){
            sqlsrv_commit($conn);
            echo "Information Saved";
            
        }

        if ($stmt == false){
            die (print_r( sqlsrv_errors(), true));
        }
    }
}

?>
