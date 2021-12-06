<?php
session_start();

    $host = '10.236.2.124,1433';
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
   
    if(isset($_POST['save_proj'])){
       
        $Description = trim($_POST['project_description']);
        $Project = $_POST['Proj_Name'];
        $prof = $_POST['Professor_Name'];

       $sql = "INSERT INTO Project (projectName, Descrp, ProfessorName) VALUES (?, ?, ?)";
        $params = array($Project, $Description, $prof);
       $stmt = sqlsrv_query($conn, $sql, $params);
        sqlsrv_commit($conn);

        

        $Role1 = $_POST['role_name1'];
        $sql1 = "INSERT INTO Roles (projectName, roleName) VALUES (?, ?)";
        $params1 = array($Project, $Role1);
        $stmt1 = sqlsrv_query($conn, $sql1, $params1);
        sqlsrv_commit($conn);
        if($stmt1 == true){
            sqlsrv_commit($conn);
            echo "Information Saved";
            
        } 
        //$Role2 = $_POST['role_name2'];
       // $Role3 = $_POST['role_name3'];
        //$Role4 = $_POST['role_name4'];

        
    }

?>