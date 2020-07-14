<?php
error_reporting(0);
function getDriveID($url){
    $filter1 = preg_match('/drive\.google\.com\/open\?id\=(.*)/', $url, $fileid1);
    $filter2 = preg_match('/drive\.google\.com\/file\/d\/(.*?)\//', $url, $fileid2);
    $filter3 = preg_match('/drive\.google\.com\/uc\?id\=(.*?)\&/', $url, $fileid3);
    if ($filter1) {
        $fileid = $fileid1[1];
    } else if ($filter2) {
        $fileid = $fileid2[1];
    } else if ($filter3) {
        $fileid = $fileid3[1];
    } else {
        $fileid = null;
    }
    
    return ($fileid);
}
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
	if($_POST['submit'] != ""){
		$url = $_POST['url'];
		$gid = getDriveID($url);
		$iframeid = my_simple_crypt($gid);
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title>GDrive Gen</title>
	 <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
	<style>
	.info-icon{margin-top:-6px}
	.navbar-default {background: #fff !important;}
	body { background: url('https://i.pixiv.cat/img-original/img/2017/12/20/00/12/19/66360679_p0.png?1564663474077') no-repeat center center fixed;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size: cover;background-size: cover;}
	.transp {background: rgba(255,255,255,0.5);}
	.card{ background: rgba(255,255,255,0.9) !important; }
	</style>
</head>
<body>

		<center><h1>GDrive Link Generate</h1></center>
		<br />
<div class='container-fluid' style="max-width: 1080px !important;">
<div class='row'>
	<div class="col-md-12">
		<div class='card' style='margin:50px;'>
			<h5 class="card-header">Convert</h5>
			<div class='card-body'>
				<div class="form-group">
					<label>URL</label>
					<form action="" method="POST">
			<input type="text" size="80" name="url" value="<?php if($iframeid){echo $_POST['url'];}
			else{echo "";}?>"/>
			<button class="btn btn-default" input type="submit" value="Generate" name="submit" >Submit </button>
		</form>
		<div id="myElement">Paste the url and click the generate button.</div>

<div class="col-md-12">
		<div class='card' style='margin:40px;'>
		    <h5 class="card-header">Hasil Link Anda</h5>
		    <div class="card-body">
		    	<h6 class="text-muted">Silahkan Copy Link Anda.</h6>
<textarea class="form-control" rows="6" readonly>
<?php if($iframeid){echo '?id='.$iframeid.'</textarea>';?></textarea><br/>
		<center>
		<h2>Boleh di test link downloadnya dibawah</h2>
		<a href="<?php echo $linkdown;?>"><button class="btn btn-default">Download</button></a></center>
		<?php }?>
</textarea>
</div>
	</div>


        <br><br>
  <section class="footme">
      Google Drive Link Generator <a id="nochange" href="https://fb.me/iqbalrifaii">Iqbal Rifai</a>
  </section>
</body>
</html>
