<div class="container">
	<div class="page-header">
			<center style="padding-top:20px;">
			<form action="#" id="search_box">
			<div class="wrapper">
			<input type="text" id="sample" name="mid" placeholder="Autocomplete for Movies " />
			<button type="submit" class="search_btn"><img src="search_icon.png" title="Search" /></button>
			</div>
		        </form>
		        </center>
	 </div>
      
      <div class="row">
        <div class="span4">
          <h4>Box office</h4>
           <div class="demo1">
           	<div style="position: absolute; margin: 0px; top: 0px; ">
<?php 
		$url="api.rottentomatoes.com/api/public/v1.0/lists/movies/box_office.json?limit=10&country=us&apikey=uuacu746nquzs3f2679dcyv6";
		