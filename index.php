
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
  <body onload="loadPopularVideos()">
    <?php include('includes/header.php'); ?>

	<main role="main">

	  <section class="jumbotron text-center">
	    <div class="container">
	      <h1>Loop Limiter</h1>
	      <p class="lead text-muted">Youtube doesn't have a loop limiter right now. If you put a single video on loop, youtube will repeat that video infinite time. But this tool will help you limit that loop.</p>
	      <p>
	        <button class="btn btn-primary my-2" type="button" data-toggle="modal" data-target="#searchByID">Search By Video ID</button>
	        <button class="btn btn-secondary my-2" type="button" data-toggle="modal" data-target="#searchByKeyword">Search By Keyword</button>
	      </p>
	    </div>
	  </section>

	  <div class="album py-5 bg-light">
	    <div class="container">
	      <div class="row" id="videos">

	        <div class="col-md-12" id="noVideos">
	          <div class="card mb-4 shadow-sm">
	            <div class="card-body">
	              <p class="card-text">
	              	Please Wait... Getting most popular videos from Youtube...
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
		include('includes/searchByIDModal.php'); 
		include('includes/searchByKeywordModal.php'); 
		include('includes/limitLoop.php'); 
	?>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
	<script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/custom.js"></script>

  </body>
</html>