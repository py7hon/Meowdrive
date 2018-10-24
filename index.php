<?php
error_reporting(0);
include "curl_gd.php";



if($_GET['id'] != ""){
	$gid = $_GET['id'];
	$original_id = my_simple_crypt($gid, 'd');
	$title = fetch_value(file_get_contents_curl('https://drive.google.com/get_video_info?docid='.$original_id), "title=", "&");
	$url = 'https://drive.google.com/file/d/'.$original_id.'/view';
	$linkdown = Drive($url);
	$test = fetch_value(new_title($fs));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gdrive Download">
    <meta name="author" content="Iqbal Rifai">
    <title><?php echo new_title('https://drive.google.com/file/d/' . $original_id . '/view'); ?> – Meowdrive</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type='text/javascript'>
function changeTags(){
   $("head").append('<meta http-equiv="refresh" content="0;url=<?php echo $linkdown;?>">');
}
</script>
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
			      <iframe src="https://tetora.webs.vc/player?id=<?php echo $original_id;?>" frameborder="0" width="480" height="240"></iframe>
                    <h2><?php echo new_title('https://drive.google.com/file/d/' . $original_id . '/view'); ?></h2>
                    <p><form method="post" action="">
                        <input type="hidden" name="asdf" value="<?php echo $gid;?>">
                        <button class="download" onClick="changeTags(); return false;">DOWNLOAD</button>
                        </form></p>
                </div>
                 <div class="recom">
			 <h3 class="section-title">Embed Player</h3>
          <p class="section-description">Silahkan Copy untuk Embed playernya.</p>
        <center>
      	<textarea wrap="hard" rows="4" cols="50" readonly><iframe src="https://tetora.webs.vc/player?id=<?php echo $original_id;?>"frameborder="0"></iframe></textarea>
      	</center>
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
