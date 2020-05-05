  <div class="site-footer">
    <div class="first-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="social-footer">
              <ul>
                <li><a href="#" class="fa fa-facebook"></a></li>
                <li><a href="#" class="fa fa-twitter"></a></li>
                <li><a href="#" class="fa fa-dribbble"></a></li>
                <li><a href="#" class="fa fa-linkedin"></a></li>
                <li><a href="#" class="fa fa-rss"></a></li>
              </ul>
            </div> <!-- /.social-footer -->
          </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /.first-footer -->
    <div class="bottom-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <p class="copyright">Copyright © 2084 <a href="#">Krayina</a>
                        </p>
          </div> <!-- /.col-md-6 -->
          <div class="col-md-6 credits">
            <p><!-- Design: <a rel="nofollow" href="http://www.templatemo.com/tm-394-sonic" target="_parent">Sonic</a> --></p>
          </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->
      </div> <!-- /.container-fluid -->
    </div> <!-- /.bottom-footer -->
  </div> <!-- /.site-footer -->

</div> <!-- /#main-content -->
<!-- JavaScripts -->
	<script src="../assets/js/jquery-1.10.2.min.js"></script>
	<script src="../assets/js/jquery.singlePageNav.js"></script>
	<script src="../assets/js/jquery.flexslider.js"></script>
	<script src="../assets/js/jquery.prettyPhoto.js"></script>
	<script src="../assets/js/custom.js"></script>
  <script src="main.js"></script>
	<script>
		$(document).ready(function(){
			$("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'});
		});

        function initialize() {
          var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng(40.7809919,-73.9665273)
          };

          var map = new google.maps.Map(document.getElementById('map-canvas'),
              mapOptions);
        }

        function loadScript() {
          var script = document.createElement('script');
          script.type = 'text/javascript';
          script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
              'callback=initialize';
          document.body.appendChild(script);
        }

        window.onload = loadScript;
    </script>
<!-- templatemo 394 sonic -->
</body>
</html>