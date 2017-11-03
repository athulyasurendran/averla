	<footer class="motopress-wrapper footer <?php if(of_get_option('map_display') !== 'true') { ?>with-map<?php } ?>">
		<script>
			var geocoder;
			var map;

			function initialize() {
				geocoder = new google.maps.Geocoder();
					
				var mapOptions = {
					zoom: <?php echo of_get_option('place_zoom'); ?>,
					disableDefaultUI: false,
					scrollwheel: false,
					panControl: true,
					scaleControl: true,
					draggable: true,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}

				map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

				codeAddress();
			}

			function codeAddress() {
			  var address = "<?php echo of_get_option('place'); ?>";
			  geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					var iconBase = '<?php echo get_bloginfo("stylesheet_directory") ?>/images/';
					var marker = new google.maps.Marker({
				        map: map,
				        icon: iconBase + 'map_icon.png',
				        position: results[0].geometry.location
				    });

				} else {
				  alert('Map are not loaded for the following reason: ' + status);
				}
			  });
			}

			google.maps.event.addDomListener(window, 'load', initialize);

		</script>
		<div class="footer-map">
			<div id="map-canvas" class="<?php if(of_get_option('map_display') !== 'true') { ?>with-map-on-pages<?php } ?>"></div>
			<div class="map-info">
				<div class="footer-logo">
					<a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo of_get_option('footer_logo'); ?>"></a>
					<p><?php echo get_bloginfo('description'); ?></p>
				</div>
				<div class="addr"><span>Address:</span> <?php echo of_get_option('location'); ?></div>
				<div class="phones"><i class="icon-phone"></i><span><?php echo of_get_option('phone'); ?></span></div>
				<div class="phones fax"><i class="icon-phone"></i><span><?php echo of_get_option('fax'); ?></span></div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="<?php echo cherry_get_layout_class( 'full_width_content' ); ?>" data-motopress-wrapper-file="wrapper/wrapper-footer.php" data-motopress-wrapper-type="footer" data-motopress-id="<?php echo uniqid() ?>">
					<?php get_template_part('wrapper/wrapper-footer'); ?>
				</div>
			</div>
		</div>
	</footer>

	<!--End #motopress-main-->
	</div>
	<div id="back-top-wrapper" class="visible-desktop">
		<p id="back-top">
			<?php echo apply_filters( 'cherry_back_top_html', '<a href="#top"><span></span></a>' ); ?>
		</p>
	</div>
	<?php if(of_get_option('ga_code')) { ?>
		<script type="text/javascript">
			<?php echo stripslashes(of_get_option('ga_code')); ?>
		</script>
		<!-- Show Google Analytics -->
	<?php } ?>
	<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->
</body>
</html>