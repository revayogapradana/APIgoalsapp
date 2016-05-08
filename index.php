<?php
	header( 'Access-Control-Allow-Origin: *');

	if(isset($_GET['type'])){
		// koneksi database
	    $host = "localhost";        // lokasi database
	    $user = "revoreva_goalsap";             // nama username
	    $pass = "g04l54pp";                 // password database
	    $dbname = "revoreva_goalsapp";       // nama database yang digunakan
	    $cn = mysqli_connect( $host, $user, $pass, $dbname );
	    
	    //url/login/email/password
	    if ( $_POST['type'] == "login" ) {
	    	$query = 	"SELECT
	    					AKUN_ID, EMAIL, USERNAME, FOTO
		                from
		                 	AKUN
		                where
		                  AKUN.EMAIL = \"" . $_POST['p1'] . "\" AND AKUN.PASSWORD = \"" . $_POST['p2'] . "\"
		                limit 1";
	    	
		    $result = mysqli_query( $cn, $query );
		    $var = array();
		    $ada = 0;
		    while ( $obj = mysqli_fetch_object( $result ) ) {
		    	$var[] = $obj;
		    	$ada = 1;
		    }
		    if($ada == 1)
		    	echo '{"status":200, "message":"login sukses", "data":' . json_encode( $var ) . '}';
		    else
		    	echo '{"status":200, "message":"login gagal"}';
	    } else if($_GET['type'] == 'register'){
	    	//register/username/email/password/foto
	    	//register/p1      /p2   /p3      /p4

	    	$query = "INSERT INTO AKUN(USERNAME, EMAIL, PASSWORD, FOTO) VALUES (" . $_GET['p1'] . "," . $_GET['p2'] . "," . $_GET['p3'] . "," . $_GET['p4'] . ")";
        	
		    $result = mysqli_query( $cn, $query );
		    
		    if($result){
		    	$query = 	"SELECT
	    					AKUN_ID, EMAIL, USERNAME, FOTO
		                from
		                 	AKUN
		                where
		                  AKUN.EMAIL = \"" . $_GET['p2'] . "\"
		                limit 1";
	    	
			    $result = mysqli_query( $cn, $query );
			    $var = array();
			    $ada = 0;
			    while ( $obj = mysqli_fetch_object( $result ) ) {
			    	$var[] = $obj;
			    }
			    echo '{"status":200, "message":"registrasi sukses", "data":' . json_encode( $var ) . '}';
		    }
		    else
		    	echo '{"status":200, "message":"registrasi gagal"}';
	    }
	}
?>
