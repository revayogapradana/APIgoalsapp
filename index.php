<?php
	header( 'Access-Control-Allow-Origin: *');
	// echo $_POST['TYPE'] . "aaa";
	if(!empty($_POST['TYPE'])){
		// koneksi database
	    $host = "localhost";        // lokasi database
	    $user = "revoreva_goalsap";             // nama username
	    $pass = "g04l54pp";                 // password database
	    $dbname = "revoreva_goalsapp";       // nama database yang digunakan
	    $cn = mysqli_connect( $host, $user, $pass, $dbname );
	    
	    //url/login/email/password
	    if ( $_POST['TYPE'] == "login" ) {
	    	$query = 	"SELECT
	    					AKUN_ID, EMAIL, USERNAME, FOTO
		                from
		                 	AKUN
		                where
		                  AKUN.EMAIL = \"" . $_POST['EMAIL'] . "\" AND AKUN.PASSWORD = \"" . $_POST['PASSWORD'] . "\"
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
	    } else if($_POST['TYPE'] == 'register'){
	    	//register/username/email/password/foto

	    	$query = "INSERT INTO AKUN(USERNAME, EMAIL, PASSWORD, FOTO) VALUES (" . $_POST['USERNAME'] . "," . $_POST['EMAIL'] . "," . $_POST['PASSWORD'] . "," . $_POST['FOTO'] . ")";
        	
		    $result = mysqli_query( $cn, $query );
		    
		    if($result){
		    	$query = 	"SELECT
	    					AKUN_ID, EMAIL, USERNAME, FOTO
		                from
		                 	AKUN
		                where
		                  AKUN.EMAIL = \"" . $_POST['EMAIL'] . "\"
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
	} else if(!empty($_GET['TYPE'])){
		// koneksi database
	    $host = "localhost";        // lokasi database
	    $user = "revoreva_goalsap";             // nama username
	    $pass = "g04l54pp";                 // password database
	    $dbname = "revoreva_goalsapp";       // nama database yang digunakan
	    $cn = mysqli_connect( $host, $user, $pass, $dbname );

	    if($_GET['TYPE'] == 'list_target'){
	    	//list_target/AKUN_ID
	    	
	    	$query = 	"SELECT
	    					TARGET_ID, FOTO, SALDO, HARGA, DUE_DATE
		                FROM
		                 	TARGET
		                WHERE
		                  	TARGET.AKUN_ID = " . $_POST['AKUN_ID'];
	    	
		    $result = mysqli_query( $cn, $query );
		    $var = array();
		    $ada = 0;
		    while ( $obj = mysqli_fetch_object( $result ) ) {
		    	$var[] = $obj;
		    	$ada = 1;
		    }
		    if($ada == 1)
		    	echo '{"status":200, "message":"get list target sukses", "data":' . json_encode( $var ) . '}';
		    else
		    	echo '{"status":200, "message":"get list target gagal"}';
	    }
	}
?>
