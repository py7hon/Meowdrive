<?php
	error_reporting(0);
	include "curl_gd.php";

	if($_POST['submit'] != ""){
		$url = $_POST['url'];
		$gid = get_drive_id($url);
		$iframeid = my_simple_crypt($gid);
		$linkdown = Drive($url);
		$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$linkdown.'"}]';
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
	body { background: url('https://0wo.me/img/bg2.jpg') no-repeat center center fixed;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size: cover;background-size: cover;}
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

<!--- 0wo text --->
<script src="https://0wo.me/0wo.js"></script>
</body>
</html>
