<?php
function my_simple_crypt( $string, $action = 'e' ) {
  	$secret_key = 'drivekey';
  	$secret_iv = 'google';
  	$output = false;
  	$encrypt_method = "AES-256-CBC";
  	$key = hash( 'sha256', $secret_key );
  	$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
  	if( $action == 'e' ) {
    		$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
  		}else if( $action == 'd' ){
    			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
  	}
  	return $output;
}
function getDownload($id){
		$ch = curl_init("https://drive.google.com/uc?id=$id&authuser=0&export=download");
		curl_setopt_array($ch, array(
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POSTFIELDS => [],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => 'gzip,deflate',
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
			CURLOPT_HTTPHEADER => [
				'accept-encoding: gzip, deflate, br',
				'content-length: 0',
				'content-type: application/x-www-form-urlencoded;charset=UTF-8',
				'origin: https://drive.google.com',
				'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',
				'x-client-data: CKG1yQEIkbbJAQiitskBCMS2yQEIqZ3KAQioo8oBGLeYygE=',
				'x-drive-first-party: DriveWebUi',
				'x-json-requested: true'
			]
		));
		$response = curl_exec($ch);
		$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($response_code == '200') { // Jika response status OK
			$object = json_decode(str_replace(')]}\'', '', $response));
			if(isset($object->downloadUrl)) {
				return $object->downloadUrl;
			} 
		} else {
			return $response_code;
		}
}
if($_GET['id'] != ""){
	$gid = $_GET['id'];
	$original_id = my_simple_crypt($gid, 'd');
	$url = "https://www.googleapis.com/drive/v2/files/$original_id?supportsTeamDrives=true&key=AIzaSyBPO_VhHtvTL-gs35Nb24cSsjuxQasjlN0";
	$json = file_get_contents($url);
	$json_data = json_decode($json, true);
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gdrive Download">
    <meta name="author" content="Iqbal Rifai">
    <?php
    error_reporting(0);
    	if($_POST['asdf']){
		$id = $_POST['asdf'];
		$original_id = my_simple_crypt($id, 'd');
		$docsurl = getDownload($original_id);
		echo "<meta http-equiv='refresh' content='0;url=$docsurl'>\n"; 
		}?>
    <title><?php echo $json_data["title"]; ?> – Meowdrive</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header class="top-header">
        <div class="container">
            <div class="row header-row">
                <div class="col-md-12">
                    <nav class="navbar navbar-default">
                        <a href="#"><img src="img/meowdrivex.png" alt="" class="logo"></a>
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#sec1">Home</a></li>
                                    <li><a href="https://drive.google.com/file/d/<?php echo $original_id;?>">CONVERT TO GOOGLE DRIVE</a></li>
                                    <!-- <li><a href="#sec3">services</a></li>
                                    <li><a href="#sec4">my work</a></li>
                                    <li><a href="#sec5">contact me</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <section class="about text-center" id="sec2">
        <div class="container">
            <div class="row">
                <div class="about-heading">
                    <h2><?php echo $json_data["title"]; ?></h2>
                    <p><form method="post" action="">
                        <input type="hidden" name="asdf" value="<?php echo $gid;?>">
                        <button class="download">DOWNLOAD</button>
                        </form></p>
                </div>
                 <div class="recom">
		</div>
            </div>
        </div>
    </section>
    <footer class="footer text-center">
        <p>Copyright: &copy; <a href="#">Iqbal Rifai</a> | All rights reserved</p>
    </footer>
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
