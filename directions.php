<?php set_include_path($_SERVER['DOCUMENT_ROOT']); ?>
<?php include('header.php'); ?>
	<!-- greenfieldhill.net ABQIAAAARnXr4_I9FAF3cys-f6CvDBQSvOLAkfdKXnEWXt40R2RlR69J7hRZ3Iu73K82KGC_q5Z7oRqYCM_3tQ  -->
		<!-- localhost  ABQIAAAARnXr4_I9FAF3cys-f6CvDBT2yXp_ZAY8_ufC3CFXhHIE1NvwkxT02mP9XELVcDMufiviAFyizDO_Ng  -->
		<!-- ffldfpc.org  ABQIAAAARnXr4_I9FAF3cys-f6CvDBT3iwyBado6tG_XQ2cP02XvC9k92hQEHGUJZDsdGmWlpmiKQSVicknNQg -->
		<!-- firstpresby.net  ABQIAAAARnXr4_I9FAF3cys-f6CvDBTTTmV_kSOIydqrdUYxYWteaexRfxTVQ69bWSiLhZf6IQUEz_6Ecgkk-Q -->
		
		
		<script
			src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAARnXr4_I9FAF3cys-f6CvDBTTTmV_kSOIydqrdUYxYWteaexRfxTVQ69bWSiLhZf6IQUEz_6Ecgkk-Q"
			type="text/javascript"></script>

		<script type="text/javascript">
		
		function getMap() {
			if (GBrowserIsCompatible()) {
	        	var map = new GMap2(document.getElementById("map"));
		        var center = new GLatLng(41.210724,-73.253639);
		        map.setCenter(center, 14);
	    	    // Create our "tiny" marker icon
	
				var icon = new GIcon();
				icon.image = "http://labs.google.com/ridefinder/images/mm_20_red.png";
				icon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
				icon.iconSize = new GSize(12, 20);
				icon.shadowSize = new GSize(22, 20);
				icon.iconAnchor = new GPoint(6, 20);
				icon.infoWindowAnchor = new GPoint(5, 1);
		        var marker = new GLatLng(41.211535,-73.247910);
				map.addOverlay(new GMarker(marker, icon));
			}

		}
	</script>			
	<body onLoad="getMap();">

<?php include('content/directions.php'); ?>
<?php include('footer.php'); ?>
