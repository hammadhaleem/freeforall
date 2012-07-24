<div class="container">

		    <div class="page-header">
			    <h1>Tabs &amp; Pills</h1>
		    </div>
    
		<div class="row">
			<div id="sidebar" class="tabbable">
				<div class="span3">
					<div class="well">
					<ul id="sidenav" class="nav nav-pills nav-stacked">
						<li class="active"><a href="#tabs-basic" data-toggle="tab"><strong>Tabs</strong></a></li>
						<li><a href="#tabs-side" data-toggle="tab"><strong>Side Tabs</strong></a></li>
						<li><a href="#tabs-stacked" data-toggle="tab"><strong>Stacked Tabs</strong></a></li>
						<li><a href="#pills-basic" data-toggle="tab"><strong>Pills</strong></a></li>
						<li><a href="#pills-stacked" data-toggle="tab"><strong>Stacked Pills</strong></a></li>
					</ul>
					</div><!-- .well -->
					<div class="alert alert-info">
						<a class="close" data-dismiss="alert">×</a>
						<h4>PAGE LAYOUT NOTE</h4>
						<p>This page follows Twitter Bootstrap's "Fluid layout" template <a href="http://twitter.github.com/bootstrap/examples.html">found online here</a>.</p>
					</div>
			    <div class="alert alert-success">
						<a class="close" data-dismiss="alert">×</a>
			    	<h4>CONSULT THE DOCS!</h4>
				    <p>The examples given here depend upon and cannot replace <a href="http://twitter.github.com/bootstrap/components.html#navs">Twitter Bootstrap's own excellent documentation</a>.</p>
				  </div>
				</div><!-- .span3 -->
				<div class="span9">				
					<div class="tab-content">
						<div class="tab-pane active" id="tabs-basic">
							<h3>Basic Tabs</h3>
							<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tabs1-pane1" data-toggle="tab">Markup</a></li>
									<li><a href="#tabs1-pane2" data-toggle="tab">Twitter Docs</a></li>
									<li><a href="#tabs1-pane3" data-toggle="tab">Tab 3</a></li>
									<li><a href="#tabs1-pane4" data-toggle="tab">Tab 4</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tabs1-pane1">
										<h4>The Markup</h4>
										<p><a href="http://twitter.github.com/bootstrap/components.html#navs">See the Bootstrap documentation</a></p>
										<pre>&lt;div class=&quot;tabbable&quot;&gt;
  &lt;ul class=&quot;nav nav-tabs&quot;&gt;
    &lt;li class=&quot;active&quot;&gt;&lt;a href=&quot;#pane1&quot; data-toggle=&quot;tab&quot;&gt;Tab 1&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href=&quot;#pane2&quot; data-toggle=&quot;tab&quot;&gt;Tab 2&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href=&quot;#pane3&quot; data-toggle=&quot;tab&quot;&gt;Tab 3&lt;/a&gt;&lt;/li&gt;
    &lt;li&gt;&lt;a href=&quot;#pane4&quot; data-toggle=&quot;tab&quot;&gt;Tab 4&lt;/a&gt;&lt;/li&gt;
  &lt;/ul&gt;
  &lt;div class=&quot;tab-content&quot;&gt;
    &lt;div id=&quot;pane1&quot; class=&quot;tab-pane active&quot;&gt;
      &lt;h4&gt;The Markup&lt;/h4&gt;
      &lt;pre&gt;Code here ...&lt;/pre&gt;
    &lt;/div&gt;
    &lt;div id=&quot;pane2&quot; class=&quot;tab-pane&quot;&gt;
    &lt;h4&gt;Pane 2 Content&lt;/h4&gt;
      &lt;p&gt; and so on ...&lt;/p&gt;
    &lt;/div&gt;
    &lt;div id=&quot;pane3&quot; class=&quot;tab-pane&quot;&gt;
      &lt;h4&gt;Pane 3 Content&lt;/h4&gt;
    &lt;/div&gt;
    &lt;div id=&quot;pane4&quot; class=&quot;tab-pane&quot;&gt;
      &lt;h4&gt;Pane 4 Content&lt;/h4&gt;
    &lt;/div&gt;
  &lt;/div&gt;&lt;!-- /.tab-content --&gt;
&lt;/div&gt;&lt;!-- /.tabbable --&gt;</pre>
									</div>
									<div class="tab-pane" id="tabs1-pane2">
										<h4>See the docs!</h4>
										<p>Check out Twitter Bootstrap's tabs documentation:</p>
										<p><a class="btn" href="http://twitter.github.com/bootstrap/components.html#navs">Tabs Markup Documentation</a></p>
										<p><a class="btn" href="http://twitter.github.com/bootstrap/javascript.html#tabs">Tabs JavaScript Documentation</a></p>
									</div>
									<div class="tab-pane" id="tabs1-pane3">
										<h4>Pane 3 Content</h4>
										<p>Donec semper vestibulum dapibus. Integer et sollicitudin metus. Vivamus at nisi turpis. Phasellus vel tellus id felis cursus hendrerit. Suspendisse et arcu felis, ac gravida turpis. Suspendisse potenti. Ut porta rhoncus ligula, sed fringilla felis feugiat eget. In non purus quis elit iaculis tincidunt. Donec at ultrices est.</p>
									</div>
									<div class="tab-pane" id="tabs1-pane4">
										<h4>Pane 4 Content</h4>
										<p>Donec semper vestibulum dapibus. Integer et sollicitudin metus. Vivamus at nisi turpis. Phasellus vel tellus id felis cursus hendrerit. Suspendisse et arcu felis, ac gravida turpis. Suspendisse potenti. Ut porta rhoncus ligula, sed fringilla felis feugiat eget. In non purus quis elit iaculis tincidunt. Donec at ultrices est.</p>
									</div>
								</div><!-- /.tab-content -->
							</div><!-- /.tabbable -->
						</div><!-- .tabs-basic -->
						<div class="tab-pane" id="tabs-side">
							<h3>Side Tabs</h3>
							<div class="tabbable tabs-left">
							  <ul class="nav nav-tabs span2">
							    <li class="active"><a href="#tabs2-pane1" data-toggle="tab">Tab 1</a></li>
							    <li><a href="#tabs2-pane2" data-toggle="tab">Tab 2</a></li>
							    <li><a href="#tabs2-pane3" data-toggle="tab">Tab 3</a></li>
							    <li><a href="#tabs2-pane4" data-toggle="tab">Tab 4</a></li>
							  </ul>
							  <div class="tab-content span5">
							    <div id="tabs2-pane1" class="tab-pane active">
							      <h4>The Markup</h4>
							      <pre>&lt;div class=&quot;tabbable <strong>tabs-left</strong>&quot;&gt;
  &lt;ul class=&quot;nav nav-tabs&quot;&gt;
    //and so on ...</pre>
							    </div>
							    <div id="tabs2-pane2" class="tab-pane">
							    <h4>Pane 2 Content</h4>
							      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse euismod congue bibendum. Aliquam erat volutpat. Phasellus eget justo lacus. Vivamus pharetra ullamcorper massa, nec ultricies metus gravida egestas.</p>
							    </div>
							    <div id="tabs2-pane3" class="tab-pane">
							      <h4>Pane 3 Content</h4>
							      <p>Ut porta rhoncus ligula, sed fringilla felis feugiat eget. In non purus quis elit iaculis tincidunt. Donec at ultrices est.</p>
							    </div>
							    <div id="tabs2-pane4" class="tab-pane">
							      <h4>Pane 4 Content</h4>
							      <p>Donec semper vestibulum dapibus. Integer et sollicitudin metus. Vivamus at nisi turpis. Phasellus vel tellus id felis cursus hendrerit. Suspendisse et arcu felis, ac gravida turpis. Suspendisse potenti.</p>
							    </div>
							  </div><!-- /.tab-content -->
							</div><!-- /.tabbable -->
						</div>
						<div class="tab-pane" id="tabs-stacked">
							<h3>Stacked Tabs</h3>
							<div class="tabbable">
							  <ul class="nav nav-tabs nav-stacked span2">
							    <li class="active"><a href="#tabs3-pane1" data-toggle="tab">Tab 1</a></li>
							    <li><a href="#tabs3-pane2" data-toggle="tab">Tab 2</a></li>
							    <li><a href="#tabs3-pane3" data-toggle="tab">Tab 3</a></li>
							    <li><a href="#tabs3-pane4" data-toggle="tab">Tab 4</a></li>
							  </ul>
							  <div class="tab-content span5">
							    <div id="tabs3-pane1" class="tab-pane active">
							      <h4>The Markup</h4>
							      <pre>&lt;div class=&quot;tabbable&quot;&gt;
  &lt;ul class=&quot;nav nav-tabs <strong>nav-stacked</strong>&quot;&gt;
    //and so on ...</pre>
							    </div>
							    <div id="tabs3-pane2" class="tab-pane">
							    <h4>Pane 2 Content</h4>
							      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse euismod congue bibendum. Aliquam erat volutpat. Phasellus eget justo lacus. Vivamus pharetra ullamcorper massa, nec ultricies metus gravida egestas.</p>
							    </div>
							    <div id="tabs3-pane3" class="tab-pane">
							      <h4>Pane 3 Content</h4>
							      <p>Ut porta rhoncus ligula, sed fringilla felis feugiat eget. In non purus quis elit iaculis tincidunt. Donec at ultrices est.</p>
							    </div>
							    <div id="tabs3-pane4" class="tab-pane">
							      <h4>Pane 4 Content</h4>
							      <p>Donec semper vestibulum dapibus. Integer et sollicitudin metus. Vivamus at nisi turpis. Phasellus vel tellus id felis cursus hendrerit. Suspendisse et arcu felis, ac gravida turpis. Suspendisse potenti.</p>
							    </div>
							  </div><!-- /.tab-content -->
							</div><!-- /.tabbable -->
						</div>
						<div class="tab-pane" id="pills-basic">
							<h3>Pills</h3>
							<div class="tabbable">
							  <ul class="nav nav-pills">
							    <li class="active"><a href="#tabs4-pane1" data-toggle="tab">Tab 1</a></li>
							    <li><a href="#tabs4-pane2" data-toggle="tab">Tab 2</a></li>
							    <li><a href="#tabs4-pane3" data-toggle="tab">Tab 3</a></li>
							    <li><a href="#tabs4-pane4" data-toggle="tab">Tab 4</a></li>
							  </ul>
							  <div class="tab-content">
							    <div id="tabs4-pane1" class="tab-pane active">
							      <h4>The Markup</h4>
							      <pre>&lt;div class=&quot;tabbable&quot;&gt;
  &lt;ul class=&quot;nav <strong>nav-pills</strong>&quot;&gt;
    //and so on ...</pre>
							    </div>
							    <div id="tabs4-pane2" class="tab-pane">
							    <h4>Pane 2 Content</h4>
							      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse euismod congue bibendum. Aliquam erat volutpat. Phasellus eget justo lacus. Vivamus pharetra ullamcorper massa, nec ultricies metus gravida egestas.</p>
							    </div>
							    <div id="tabs4-pane3" class="tab-pane">
							      <h4>Pane 3 Content</h4>
							      <p>Ut porta rhoncus ligula, sed fringilla felis feugiat eget. In non purus quis elit iaculis tincidunt. Donec at ultrices est.</p>
							    </div>
							    <div id="tabs4-pane4" class="tab-pane">
							      <h4>Pane 4 Content</h4>
							      <p>Donec semper vestibulum dapibus. Integer et sollicitudin metus. Vivamus at nisi turpis. Phasellus vel tellus id felis cursus hendrerit. Suspendisse et arcu felis, ac gravida turpis. Suspendisse potenti.</p>
							    </div>
							  </div><!-- /.tab-content -->
							</div><!-- /.tabbable -->
						</div>
						<div class="tab-pane" id="pills-stacked">
							<h3>Stacked Pills</h3>
														<div class="tabbable">
							  <ul class="nav nav-pills nav-stacked span2">
							    <li class="active"><a href="#tabs5-pane1" data-toggle="tab">Tab 1</a></li>
							    <li><a href="#tabs5-pane2" data-toggle="tab">Tab 2</a></li>
							    <li><a href="#tabs5-pane3" data-toggle="tab">Tab 3</a></li>
							    <li><a href="#tabs5-pane4" data-toggle="tab">Tab 4</a></li>
							  </ul>
							  <div class="tab-content span5">
							    <div id="tabs5-pane1" class="tab-pane active">
							      <h4>The Markup</h4>
							      <pre>&lt;div class=&quot;tabbable&quot;&gt;
  &lt;ul class=&quot;nav nav-pills <strong>nav-stacked</strong>&quot;&gt;
    //and so on ...</pre>
							    </div>
							    <div id="tabs5-pane2" class="tab-pane">
							    <h4>Pane 2 Content</h4>
							      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse euismod congue bibendum. Aliquam erat volutpat. Phasellus eget justo lacus. Vivamus pharetra ullamcorper massa, nec ultricies metus gravida egestas.</p>
							    </div>
							    <div id="tabs5-pane3" class="tab-pane">
							      <h4>Pane 3 Content</h4>
							      <p>Ut porta rhoncus ligula, sed fringilla felis feugiat eget. In non purus quis elit iaculis tincidunt. Donec at ultrices est.</p>
							    </div>
							    <div id="tabs5-pane4" class="tab-pane">
							      <h4>Pane 4 Content</h4>
							      <p>Donec semper vestibulum dapibus. Integer et sollicitudin metus. Vivamus at nisi turpis. Phasellus vel tellus id felis cursus hendrerit. Suspendisse et arcu felis, ac gravida turpis. Suspendisse potenti.</p>
							    </div>
							  </div><!-- /.tab-content -->
							</div><!-- /.tabbable -->
						</div>
					</div><!-- .tab-content -->
				</div><!-- .span7 -->
			</div><!-- .tabbable -->
		</div><!-- .row-fluid -->


      <hr>

      <footer>
        <p>By David Cochran of <a href="http://okwu.edu">Oklahoma Wesleyan University</a> and <a href="http://alittlecode.com/">aLittleCode.com</a> for <a href="http://webdesign.tutsplus.com/">webdesign.tutsplus.com</a>. Free for your use! (No warranties, no guarantees.)</p>
        <p><a href="http://webdesign.tutsplus.com/series/twitter-bootstrap-101/">See the full Twitter Bootstrap 101 Tutorial Series</a></p>
      </footer>


    </div> <!-- .container -->

<!-- ==============================================
		 JavaScript below! 															-->

<!-- jQuery via Google + local fallback, see h5bp.com -->
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  	<script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>

<!-- Bootstrap JS: compiled and minified -->
    <script src="js/bootstrap-trim.min.js"></script>

<!-- Example plugin: Prettify -->
    <script src="js/prettify/prettify.js"></script>
    
<!-- Initialize Scripts -->
		<script>
			// Activate Google Prettify in this page
			addEventListener('load', prettyPrint, false);
		
			$(document).ready(function(){

				// Add prettyprint CSS to head now that we know JS is running
					$('head').append('<link href="js/prettify/prettify.css" rel="stylesheet">');

				// Add prettyprint class to pre elements
					$('pre').addClass('prettyprint');
				
			}); // end document.ready
		</script>

  </body>
</html>
