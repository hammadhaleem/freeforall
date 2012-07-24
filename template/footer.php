<footer>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://engineerinme.com" > EngineerInMe </a>&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
 This application is free and in future would be free &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.themoviedb.org/"> Tmdb API </a> &nbsp;&nbsp;&nbsp; <a href="http://twitter.github.com">Bootstrap </a>  &nbsp;&nbsp;&nbsp;<a href="http://developer.rottentomatoes.com/">Rotten Tomatoes </a></p>
     

</footer></div> <!-- .container -->
<!-- ==============================================JavaScript below!-->
<!-- jQuery via Google + local fallback, see h5bp.com -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css">
<script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>
<!- ticker -->
<script src="js/ticker/jquery.easy-ticker.js"></script>
<script src="js/ticker/jquery.easy-ticker.min.js"></script>
<script src="//connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId:'355087481227235',
cookie:true,
status:true,
xfbml:true
});

function FacebookInviteFriends()
{
FB.ui({
method: 'apprequests',
message: 'Friends Check out htis really nice application ! , find about all movies , reviews ,comments and rating http://apps.facebook.com/moviepie/'
});
}
</script>
<script src="js/jquery.jcarousel.min.js"></script>
<!--script src="js/ticker/jquery.easy-ticker.js"></script-->
<!-- Bootstrap JS: compiled and minified -->
<script src="js/bootstrap-trim.min.js"></script>
<!-- Example plugin: Prettify -->
<script src="js/prettify/prettify.js"></script>
<!-- Initialize Scripts -->
		
		<script type="text/javascript">
	// Activate Google Prettify in this page
			addEventListener('load', prettyPrint, false);
		
			$(document).ready(function(){

				// Add prettyprint CSS to head now that we know JS is running
					$('head').append('<link href="js/prettify/prettify.css" rel="stylesheet">');

				// Add prettyprint class to pre elements
					$('pre').addClass('prettyprint');
				
			}); // end document.ready
		</script>
		<div id="fb-root"></div>

<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
    	wrap: 'circular'
    });
});




(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=355087481227235";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));




var api_key = "4cff43a8a3eec60c17cb778d7d56214a";
var id=1;
$("#sample").autocomplete({



    source: function (request, response) {
      id=$.ajax("http://api.themoviedb.org/3/search/movie", {
            data: {
                api_key: api_key,
                query: request.term
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                response($.map(data.results, function (movie) {
                
               
                    return {
                        label: movie.title,
                        value: movie.title,
                        thumb: movie.poster_path,
                        id: movie.id
                    }
                    
                   
                    
                }));


    
            }


        });
       // alert(label);






    },


    select: function (event, ui) { window.location = "http://freeforall.herokuapp.com/movies.php?mid="+ui.item.id; 
    
    }

       

   


}).data("autocomplete")._renderItem = function (ul, item) {
    var img = $("<img>").attr("src", "http://cf2.imgobject.com/t/p/w45/"+item.thumb);
    var link = $("<a>").text(item.label).prepend(img);
    return $("<li>").data("item.autocomplete", item).append(link).appendTo(ul);
};


$(document).ready(function(){
		$('.demo1').easyTicker({
			height: '300px',
			interval: 2000,
			direction: 'up'
		});
	});

$(document).ready(function(){
		$('.demo2').easyTicker({
			height: '300px',
			interval: 2000,
			direction: 'down'
			
		});
	});
	$(document).ready(function(){
		$('.demo3').easyTicker({
			height: '300px',
			interval: 2000,
			direction: 'up'
		});
	});


			
</script>

  </body>
</html>