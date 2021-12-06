<?php
session_start();

    $host = '10.183.215.234,1433';
    $connectionInfo = array("Database"=>"TBDraft", "UID"=>"admin1", "PWD"=>"TBuilder");
	$conn = sqlsrv_connect( $host, $connectionInfo);

   if ( sqlsrv_begin_transaction( $conn ) === false ) {
    die( print_r( sqlsrv_errors(), true ));
	}
   
    if(isset($_POST['submit'])){
		
		if ($_FILES['pdfFile']['type'] == "application/pdf") {
			$source_file = $_FILES['pdfFile']['tmp_name'];
			$dest_file = "upload/".$_FILES['pdfFile']['name'];

			if (file_exists($dest_file)) {
				print "The file name already exists!!";
			}
			else {
				move_uploaded_file( $source_file, $dest_file);
				//print "File location : upload/".$_FILES['pdfFile']['name']."<br/>";
			}
		}
		
		$pdf= file_get_contents("upload/".$_FILES['pdfFile']['name']);
		
		$encoded = base64_encode(file_get_contents("upload/".$_FILES['pdfFile']['name']));
		$hex = bin2hex(base64_decode($encoded));
		//$hex = unpack("H", file_get_contents("upload/".$_FILES['pdfFile']['name']));
		//$hex = current($hex);
		
		//$bin = hex2bin($hex);
		//echo $hex;
		//$binary = (binary)$hex;
		//echo gettype($hex);
		$sql = "INSERT INTO StudentInformation (StringResume) VALUES (?)";
        $parameters = array($hex);

		

        $stmt = sqlsrv_query($conn, $sql, $parameters);
        sqlsrv_commit($conn);

       
            
        if ($stmt == true){
            echo "Information Saved";
        }
            
        

        if ($stmt == false){
            die (print_r( sqlsrv_errors(), true));
        }
    }
	

?>