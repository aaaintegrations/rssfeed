<!DOCTYPE HTML>
<html>
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/magic.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>TweetDeck APP</title>
        
        <style>
        
            html {
                font-family: GillSans, Calibri, Trebuchet, sans-serif;
            }
        
            .tweet-column {
                width: 350px;
                color: #795548;
            }
            
            .tweet-column-container {
                display: -webkit-inline-flex;       
                display: inline-flex;
            }
            
            .split {
                width: 5px;
            }
            
            .vertical-scroll {
                overflow-y: auto;
                height: 100vh;
            }
            
            body {
                background-color: #D7CCC8;
            }
            
            #bgText {
                display: -webkit-flex;       
                display:         flex;
                align-items: center;
                justify-content: center;
                font-size: 150px;
                color: #FFFF00;
            }
			
			@mixin BoxShadowHelper($level: 1){
			  @if $level == 1 {
				box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
			  }
			  @if $level == 2 {
				box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .18), 0 4px 15px 0 rgba(0, 0, 0, .15);
			  }
			}
			a {transition: .25s all;}
			.card {
			  overflow: hidden;
			  @include BoxShadowHelper(1);
			  transition: .25s box-shadow;
			  &:focus,
			  &:hover {@include BoxShadowHelper(2);}
			}
			.card-inverse .card-img-overlay {
			  background-color: rgba(#333,.85);
			  border-color: rgba(#333,.85);
			}
            .styling{
				padding: 10px;
			}
			
			#permalink_section > a
			{
				font-size: 20px;
				font-weight: 800;
				width: 230px;
				line-height: 18px;
				left: 60px;
				white-space: pre-wrap; /* css-3 */    
				white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
				white-space: -pre-wrap; /* Opera 4-6 */    
				white-space: -o-pre-wrap; /* Opera 7 */    
				word-wrap: break-word; /* Internet Explorer 5.5+ */
			}
			nav .brand-logo.center {
				left: none !important;
				-webkit-transform: none !important;
				transform: none !important;
			}
        </style>
    </head>
    <body>
        <!--Tweet Column Container -->
        <div class="tweet-column-container">
        </div>
        
        <!-- Background Text-->
        <div id="bgText">
            <span>#TweetDeck</span>
        </div>
		
		<!-- Feed Container-->
		<div class="container">
			<div id="feedContainer">
				<div class="row" id="show_feeds"></div>
			</div>
		</div>
		
        <!-- Modal -->
        <div id="modalAddTweetColumn" class="modal modal-fixed-footer">
            <div class="modal-content">
                
              <div class="slider">
                <ul class="slides">
                  <li>
                    <img src="http://wallpapercave.com/wp/sbBtVcq.jpg">
                    <div class="caption center-align">
                      <h3>Your Ad Here</h3>
                      <h5 class="light grey-text text-lighten-3">Advertise with us.</h5>
                    </div>
                  </li>
                  <li>
                    <img src="http://cdn.pcwallart.com/images/solid-color-orange-wallpaper-3.jpg">
                    <div class="caption left-align">
                      <h3>Ad Space Available</h3>
                      <h5 class="light grey-text text-lighten-3">Advertise with us.</h5>
                    </div>
                  </li>
                  <li>
                    <img src="http://cdn.pcwallart.com/images/solid-color-orange-wallpaper-2.jpg">
                    <div class="caption right-align">
                      <h3>Your Ad Here</h3>
                      <h5 class="light grey-text text-lighten-3">Advertise with us.</h5>
                    </div>
                  </li>
                  <li>
                    <img src="http://cdn.playbuzz.com/cdn/b559a82b-04ad-494d-8d65-5c9e9b45757f/05460c1e-974f-4b33-802d-f0e94790694d.jpg">
                    <div class="caption center-align">
                      <h3>Ad Space Available</h3>
                      <h5 class="light grey-text text-lighten-3">Advertise with us.</h5>
                    </div>
                  </li>
                </ul>
              </div>
              
              <!-- Add Tweet Column-->
              <h4>Add Tweet Column</h4></br>
              <div class="input-field col s6">
                  <input placeholder="Placeholder" id="textTweet" type="text" class="validate">
                  <label for="textTweet">Tweet stream word</label>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" id="addTweetColumn" class="modal-action modal-close waves-effect waves-green btn-flat ">Add</button>
            </div>
        </div>
        
        <!-- Fab Menu Button -->
        <div class="fixed-action-btn vertical" style="bottom: 45px; right: 24px;">
            <a class="btn-floating btn-large brown darken-1">
              <i class="large material-icons">playlist_add</i>
            </a>
            <ul>
              <li><a class="btn-floating  light-blue darken-1" id="btnTweetColumnDialog"><i class="material-icons">add</i></a></li>
              <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
            </ul>
        </div>
        <div id="demo"></div>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>-->
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    </body>
    <script>
		var arr = [$.cookie("feed_url")];
		$(document).ready(function(){
			if($.cookie("feed_url") != undefined){
				arr = JSON.parse($.cookie("feed_url"));
			}
			$.each(arr, function (key, val) {
				var proxy = 'https://cors-anywhere.herokuapp.com/';
				var count = 0;
				$.ajax({
					type: 'GET',
					url: proxy+val,
					dataType: 'xml',
					success: function (xml) {
						var panelTitle = $(xml).find("title")[0]['innerHTML'];
						var feed = '';
						$(xml).find("item").each(function () {
							count++;
							var title = $(this).find("title").text();
							var description = $(this).find("description").text();
							var linkUrl = $(this).find("link").text();
							var imageUrl = $(this).find("coverImages").text();
							var pubDate = $(this).find("pubDate").text();
							feed += '<li><div class="col-xs-12"><article class="card animated fadeInUp styling"><div class="card-block"><a href="'+linkUrl+'" target="_blank"><h4 class="card-title">'+title+'</h4></a><h6 class="text-muted">'+pubDate+'</h6></div><img class="img-responsive" src="'+imageUrl+'" alt="Leaf on the street" /><div class="card-block"><p class="card-text">'+description+'</p></div></article></div></li>';						
						});
						appendColumn(count, panelTitle, feed)
					}
				});
			});
		});
	
		$('body').on('click', '#addTweetColumn', function(){
			var url = $('#textTweet').val();
			var proxy = 'https://cors-anywhere.herokuapp.com/';
			var count = 0;
			var urlList = [];
			$.ajax({
				type: 'GET',
				url: proxy+url,
				dataType: 'xml',
				success: function (xml) {
					var panelTitle = $(xml).find("title")[0]['innerHTML'];
					var feed = '';
					$(xml).find("item").each(function () {
						count++;
						var title = $(this).find("title").text();
						var description = $(this).find("description").text();
						var linkUrl = $(this).find("link").text();
						var imageUrl = $(this).find("coverImages").text();
						var pubDate = $(this).find("pubDate").text();
						feed += '<li><div class="col-xs-12"><article class="card animated fadeInUp styling"><div class="card-block"><a href="'+linkUrl+'" target="_blank"><h4 class="card-title">'+title+'</h4></a><h6 class="text-muted">'+pubDate+'</h6></div><img class="img-fluid" src="'+imageUrl+'" alt="'+title+'" /><div class="card-block"><p class="card-text">'+description+'</p></div></article></div></li>';						
					});
					if($.cookie("feed_url") != undefined){
						arr = [];
						arr = JSON.parse($.cookie("feed_url"));
						arr.push(url);
						var json_str = JSON.stringify(arr);
						$.cookie("feed_url", json_str);
					}else{
						arr = [];
						arr.push(url);
						var json_str = JSON.stringify(arr);
						$.cookie("feed_url", json_str);
					}
					appendColumn(count, panelTitle, feed);
				}
			});
		});
		

        $('.slider').slider({full_width: false});
        
        
        function appendColumn(count, name, feed) {
            $(".tweet-column-container").prepend( 
                "<div class='tweet-column' id='list"+count+"'>"+
                    "<nav>"+
                        "<div class='nav-wrapper brown darken-1'>"+
                              "<div id='permalink_section'><a href='#' class='brand-logo center'>"+name+"</a><div>"+
                              "<ul id='nav-mobile' class='left hide-on-med-and-down'>"+
                                "<li><a id='tweetCount"+count+"'></a>"+count+"</li>"+
                              "</ul>"+
                              "<ul id='nav-mobile' class='right hide-on-med-and-down'>"+
                                "<li><a id='btnDel"+count+"' href='#'>Delete</a></li>"+
                              "</ul>"+
                        "</div>"+
                    "</nav>"+
                    "<ul id="+count+" class='collection vertical-scroll'>"+
						feed
                    +"</ul>"+
                "</div> <div id='split"+count+"' class='split'></div>"
            );
            
            // Add Delete Column Listener
            addDelColmListener(count,name);
        }
        
        function addDelColmListener(name,tweet) {
            $("#btnDel"+name).click(function() {
                //Delete Column and spliter
                $("#list"+name).remove();
                $("#split"+name).remove(); 
                
                deleteTweetList(tweet);
                
                //Close WebSocket connection
                setTimeout(
                function() {
                    mapTweetColumn.get(name).close();
                }, 3000);
                
            });
        }
        
        function updateTweetItemCount(name,countStr) {
            var count = parseInt(countStr);
            document.getElementById(name).innerHTML = count;
        }
        
        function openTweetColumnDialog() {
            $('#modalAddTweetColumn').openModal();
        }
        
        $("#btnTweetColumnDialog").click(openTweetColumnDialog);
        
        
        // Background text animation
        
        magicAnimate("vanishIn");
        
        function magicAnimate(animationName) {
            setTimeout(function(){
                $('#bgText').addClass('magictime '+animationName);
            }, 0000);    
        }
    </script>
</html>