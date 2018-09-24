<?php
	error_reporting(0);
	include "curl_gd.php";

	if($_POST['submit'] != ""){
		$url = $_POST['id'];
		$gid = get_drive_id($url);
		$iframeid = my_simple_crypt($gid);
		$linkdown = Drive($url);
		$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$linkdown.'"}]';
		$kontol = $_SERVER['SERVER_NAME'];
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title>GDrive Gen</title>
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


<div class="col-md-12"><center>
		<div class='card' style='margin:40px;'>
		    <h5 class="card-header">Hasil Link Anda</h5>
		    <div class="card-body">
		    	<h6 class="text-muted">Silahkan Copy Link Anda.</h6>
<textarea class="form-control" rows="6" readonly>
<?php if($iframeid){echo 'http://'.$kontol.'?id='.$iframeid.'</textarea>';?></textarea><br/>
		<h2>Boleh di test link downloadnya dibawah</h2>
		<?php }?>
</textarea>
</div>
	</div></center>


        <br><br>
  <section class="footme">
      Google Drive Link Generator <a id="nochange" href="https://fb.me/iqbalrifaii/">iqbalrifai</a>
  </section>
</body>
</html>