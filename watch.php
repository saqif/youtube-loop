<?php 
  if(!isset($_GET['v']) || $_GET['v'] == "" || !isset($_GET['limit']) || $_GET['limit'] == ""){
    header('location: index.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A customized Youtube Player with loop Limit">
    <meta name="author" content="Shadman Saleh Shahriyar">
    <meta name="generator" content="">
    <title>Customized Youtube Player</title>

    <!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Favicons -->
	<meta name="theme-color" content="#563d7c">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.5/examples/album/album.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
  </head>

  <body>
    <?php include('includes/header.php'); ?>

	<main role="main">

	  <section class="jumbotron text-center" id="watch">
	  	<div class="embed-responsive embed-responsive-16by9">
	    	<div id="player"></div>
		</div>
	  </section>

	  <div class="album py-5 bg-light">
	    <div class="container">
	      <div class="row" id="videos">
	        
	        <div class="col-md-12" id="details">
	          <div class="card mb-4 shadow-sm">
	            <div class="card-body">
	              <p class="card-text">
	              	Please Wait... Getting the details from Youtube...
	              </p>
	            </div>
	          </div>
	        </div>

	        <div class="col-md-12" id="noVideos">
	          <div class="card mb-4 shadow-sm">
	            <div class="card-body">
	              <p class="card-text">
	              	Please Wait... Getting related videos from Youtube...
	              </p>
	            </div>
	          </div>
	        </div>

	      </div>
	    </div>
	  </div>

	</main>

	<?php 
		include('includes/footer.php'); 
		include('includes/limitLoop.php');
	?>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
	<script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script>
      var keyword = parseURLParams(window.location.href);
      var vid = keyword['v'];
      var limit = keyword['limit'];
      
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      var player;
      function onYouTubeIframeAPIReady() {
      	if (isNaN(limit) || limit <= 0) {
          alert("Limit not valid. Limit should be greater than 0");
          window.location.href = baseUrl;
        } else {
          if(!Number.isInteger(parseInt(limit))){
            alert("Please Input A valid limit number.");
            window.location.href = baseUrl;
          }
        }

        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: vid,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });

        getDetails(vid);
        loadRelatedVideos(vid)
      }

      //full link: https://www.youtube.com/watch?v=IA7jmBDmApY

      function onPlayerReady(event) {
        event.target.playVideo();
      }

      var done = false;
      var count = 1;

      function onPlayerStateChange(event) {
        if (player.getPlayerState() == 0 && !done) {
          event.target.playVideo();
          count++;

          if(count == limit && limit != -1){
            done = true;
          }

          var myEle = document.getElementById("count");
	      if(myEle){
	        document.getElementById("count").innerHTML = "Playing " + count + "/" + ((limit == -1) ? "~" : limit);
	      } else {
	      	console.log("count elem does not exist");
	      }
        }

        if(count >= limit && limit != -1){
          done = true;
        }
      }

      function stopVideo() {
        player.stopVideo();
      }
    </script>
  </body>
</html>