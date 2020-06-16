//your base url
var baseUrl = "http://localhost:8888/youtubeLoop/";

//put your youtube data API key here
var key = "your youtube data api key";

//extract all the parameters from the URL
function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
	    queryEnd   = url.indexOf("#") + 1 || url.length + 1,
		     query = url.slice(queryStart, queryEnd - 1),
		     pairs = query.replace(/\+/g, " ").split("&"),
		     parms = {}, i, n, v, nv;

	if (query === url || query === "") return;
	for (i = 0; i < pairs.length; i++) {
	    nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);
	    if (!parms.hasOwnProperty(n)) parms[n] = [];
	    parms[n].push(nv.length === 2 ? v : null);
	}

	return parms;
}


//get all details using single video ID
function getDetails(vid){
	var keyword = parseURLParams(window.location.href);
	var limit = keyword['limit'];
	var request = new XMLHttpRequest();

	request.open('GET', 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&key='+key+'&id='+vid, true);
	request.onload = function() {
		
		var data = JSON.parse(this.response);
		var count = 0;
		if (request.status >= 200 && request.status < 400) {
			console.log(data);
			if(data.pageInfo.totalResults != 0){
				var item = data.items[0];
				document.getElementById("details").innerHTML = "<div class='card mb-4 shadow-sm'><div class='card-body'><p class='card-text'><h4>"+item.snippet.title+"</h4><h6 style='opacity: 0.6'>"+item.snippet.channelTitle+"</h6>"+item.snippet.description+"</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><button class='btn btn-sm btn-outline-secondary'>"+item.statistics.likeCount+" Likes</button><button class='btn btn-sm btn-outline-secondary'>"+item.statistics.dislikeCount+" Dislikes</button><button class='btn btn-sm btn-outline-warning' id='count'>Playing 1/"+limit+"</button><button class='btn btn-sm btn-outline-primary' onclick='selectVideo(\""+vid+"\")'>Customize Loop Limit</button></div><small class='text-muted'>"+item.statistics.viewCount+" views</small></div></div></div>";
			} else {
				console.log("No results found!");
			}
		} else {
			console.log('error');
		}
	};

	request.send();

}


//get youtube video details and put inside the modal when searching a video using video ID
function getDetailsInModal(){
	document.getElementById("mdetails").innerHTML = "<div class='card mb-4 shadow-sm'><div class='card-body'>Please Wait! Searching...</div></div>";
	var vid = document.getElementById("videoID").value;
	var request = new XMLHttpRequest();

	request.open('GET', 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&key='+key+'&id='+vid, true);
	request.onload = function() {
		
		var data = JSON.parse(this.response);
		var count = 0;
		if (request.status >= 200 && request.status < 400) {
			console.log(data);
			if(data.pageInfo.totalResults != 0){
				var item = data.items[0];
				document.getElementById("mdetails").innerHTML = "<div class='card mb-4 shadow-sm'><img src='"+item.snippet.thumbnails.medium.url+"' class='card-img-top'><div class='card-body'><p class='card-text'><h5>"+item.snippet.title+"</h5><h6 style='opacity: 0.6'>"+item.snippet.channelTitle+"</h6>"+item.snippet.description.substring(0,100)+"</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><a href='javascript:void(0)' class='btn btn-sm btn-outline-secondary' onclick='selectVideo(\""+item.id+"\")'>View Here</a><a target='_blank' href='https://www.youtube.com/watch?v="+item.id+"' class='btn btn-sm btn-outline-secondary'>Youtube</a></div><small class='text-muted'>"+item.statistics.viewCount+" views</small></div></div></div>";
			} else {
				document.getElementById("mdetails").innerHTML = "<div class='card mb-4 shadow-sm'><div class='card-body'>Sorry No Results Found!</div></div>";
			}
		} else {
			console.log('error');
		}
	};

	request.send();
}			

//get most popular 6 video from youtube
function loadPopularVideos(){
	var request = new XMLHttpRequest();

	request.open('GET', 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&chart=mostPopular&regionCode=US&maxResults=6&key='+key, true);
	request.onload = function() {
		document.getElementById("noVideos").style.display="none";
		
		var data = JSON.parse(this.response);
		var count = 0;
		if (request.status >= 200 && request.status < 400) {
			for (var i = 0; i < data.items.length; i++) {
				var item = data.items[i];
				count++;
				document.getElementById("videos").innerHTML += "<div class='col-md-4'><div class='card mb-4 shadow-sm'><img src='"+item.snippet.thumbnails.medium.url+"' class='card-img-top'><div class='card-body'><p class='card-text'><h4>"+item.snippet.title+"</h4><h6 style='opacity: 0.6'>"+item.snippet.channelTitle+"</h6>"+item.snippet.description.substring(0,100)+"</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><a href='javascript:void(0)' class='btn btn-sm btn-outline-secondary' onclick='selectVideo(\""+item.id+"\")'>View Here</a><a target='_blank' href='https://www.youtube.com/watch?v="+item.id+"' class='btn btn-sm btn-outline-secondary'>Youtube</a></div><small class='text-muted'>"+item.statistics.viewCount+" views</small></div></div></div></div>";
			}


			if(data.pageInfo.totalResults != 0){
				console.log(">>" + data.pageInfo.totalResults);
				console.log(">>" + data.pageInfo.resultsPerPage);
			} else {
				console.log("No results found!");
			}
		} else {
			console.log('error');
		}
	};

	request.send();
}

//get related video of single video by using video ID
function loadRelatedVideos(vid){
	var request = new XMLHttpRequest();

	request.open('GET', 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=6&relatedToVideoId='+vid+'&type=video&key='+key, true);
	request.onload = function() {
		document.getElementById("noVideos").style.display="none";
		
		var data = JSON.parse(this.response);
		var count = 0;
		if (request.status >= 200 && request.status < 400) {
			for (var i = 0; i < data.items.length; i++) {
				var item = data.items[i];
				count++;
				document.getElementById("videos").innerHTML += "<div class='col-md-4'><div class='card mb-4 shadow-sm'><img src='"+item.snippet.thumbnails.medium.url+"' class='card-img-top'><div class='card-body'><p class='card-text'><h4>"+item.snippet.title+"</h4><h6 style='opacity: 0.6'>"+item.snippet.channelTitle+"</h6>"+item.snippet.description.substring(0,100)+"</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><a href='javascript:void(0)' class='btn btn-sm btn-outline-secondary' onclick='selectVideo(\""+item.id.videoId+"\")'>View Here</a><a target='_blank' href='https://www.youtube.com/watch?v="+item.id.videoId+"' class='btn btn-sm btn-outline-secondary'>Youtube</a></div></div></div></div></div>";
			}

			if(data.pageInfo.totalResults != 0){
				console.log(">>" + data.pageInfo.totalResults);
				console.log(">>" + data.pageInfo.resultsPerPage);
			} else {
				console.log("No results found!");
			}
		} else {
			console.log('error');
		}
	};

	request.send();
}


//get youtube video details and put inside the modal when searching a video using keyword
function SearchVideos(){
	document.getElementById("m2details").innerHTML = "<div class='col-md-12'><div class='card mb-4 shadow-sm'><div class='card-body'>Please Wait! Searching...</div></div></div>";

	var vid = document.getElementById("keyword").value;

	var request = new XMLHttpRequest();

	request.open('GET', 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=10&q='+vid+'&key='+key, true);
	request.onload = function() {
		document.getElementById("noVideos").style.display="none";
		
		var data = JSON.parse(this.response);
		var count = 0;
		if (request.status >= 200 && request.status < 400) {
			document.getElementById("m2details").innerHTML = "";
			for (var i = 0; i < data.items.length; i++) {
				var item = data.items[i];
				count++;
				if(item.id.kind == "youtube#video"){
					document.getElementById("m2details").innerHTML += "<div class='col-md-12' id='mdetails'><div class='card mb-3' style='max-width: 540px;'><div class='row no-gutters'><div class='col-md-4' style='background: black;'><img src='"+item.snippet.thumbnails.medium.url+"' class='card-img'><div class='d-flex justify-content-between align-items-center mcustom'><div class='btn-group'><a href='javascript:void(0)' class='btn btn-sm btn-outline-secondary' onclick='selectVideo(\""+item.id.videoId+"\")'>View</a><a target='_blank' href='https://www.youtube.com/watch?v="+item.id.videoId+"' class='btn btn-sm btn-outline-secondary'>Youtube</a></div></div></div><div class='col-md-8'><div class='card-body'><h6 class='card-title'>"+item.snippet.title+"</h6><h6><small>"+item.snippet.channelTitle+"</small></h6><p class='card-text'><small class='text-muted'>Posted on "+item.snippet.publishTime+"</small></p></div></div></div></div></div>";
				}
			}

			if(data.pageInfo.totalResults != 0){
				console.log(">>" + data.pageInfo.totalResults);
				console.log(">>" + data.pageInfo.resultsPerPage);
			} else {
				document.getElementById("m2details").innerHTML = "<div class='col-md-12'><div class='card mb-4 shadow-sm'><div class='card-body'>Sorry No Results Found!</div></div></div>";
			}
		} else {
			console.log('error');
		}
	};

	request.send();
}
var tempId = "";

//show limit modal and hide all other modals
function selectVideo(vid){
	tempId = vid;
	$('#searchByKeyword').modal('hide');
	$('#searchByID').modal('hide');
	$('#limitCustom').modal('show');
}


//set the limit and redirect to watch page with video ID and Limit parameters
function watchVideo(){
	var l = document.getElementById("limit").value;	
	
	if(l == "" || l<=0 || l>9999){
		alert("Please input a valid limit number (0-9999)");
	} else {
		window.location.href = baseUrl+"watch.php?v="+tempId+"&limit="+l;
	}
}
