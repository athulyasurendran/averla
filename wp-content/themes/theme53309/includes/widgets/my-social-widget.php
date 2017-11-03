<?php
// =============================== My Social Networks Widget ====================================== //
class My_SocialNetworksWidget extends WP_Widget {

	function My_SocialNetworksWidget() {
		$widget_ops = array('classname' => 'social_networks_widget', 'description' => theme_locals("social_networks_desc"));
		$this->__construct('social_networks', theme_locals("social_networks"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		
		$networks['Twitter']['link']    = $instance['twitter'];
		$networks['Facebook']['link']   = $instance['facebook'];
		$networks['Flickr']['link']     = $instance['flickr'];
		$networks['Skype']['link']       = $instance['skype'];
		$networks['Rss']['link']   = $instance['rss'];
		$networks['Delicious']['link']  = $instance['delicious'];
		$networks['Dribbble']['link']    = $instance['dribbble'];
		$networks['Google_plus']['link'] = $instance['google_plus'];
		
		$networks['Twitter']['label']   = $instance['twitter_label'];
		$networks['Facebook']['label']  = $instance['facebook_label'];
		$networks['Flickr']['label']    = $instance['flickr_label'];
		$networks['Skype']['label']      = $instance['skype_label'];
		$networks['Rss']['label']  = $instance['rss_label'];
		$networks['Delicious']['label'] = $instance['delicious_label'];
		$networks['Dribbble']['label']   = $instance['dribbble_label'];
		$networks['Google_plus']['label']   = $instance['google_plus_label'];

		// WPML compatibility
		// Check if WPML is activated, then reigster labels for translation
		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			foreach( $networks as $label => $val ) {
				$networks[$label]['label'] = icl_translate( 'cherry', 'social_widget_label_' . $label, $val['label'] );
			}
		}

		$display = $instance['display'];
		
		echo $before_widget;
		if( $title ) {
			echo $before_title;
				echo $title;
			echo $after_title;
		} ?>
		
		<!-- BEGIN SOCIAL NETWORKS -->
		<?php if ($display == "both" or $display =="labels") {
			$addClass = "social__list";
		} elseif ($display == "icons") { 
			$addClass = "social__row clearfix";
		} ?>
		
		<ul class="social <?php echo $addClass ?> unstyled">
			
		<?php foreach(array("Facebook", "Twitter", "Flickr", "Skype", "Rss", "Delicious", "Dribbble", "Google_plus") as $network) : ?>
			<?php if (!empty($networks[$network]['link'])) : ?>
			<li class="social_li">
				<a class="social_link social_link__<?php echo strtolower($network); ?>" rel="tooltip" data-original-title="<?php echo strtolower($network); ?>" href="<?php echo $networks[$network]['link']; ?>">
					<?php if (($display == "both") or ($display =="icons")) { 
							if ($network == "Google_plus") { ?>
								<span class="social_ico"><i class="icon-google-plus"></i></span>
							<?php } else { ?>
								<span class="social_ico"><i class="icon-<?php echo strtolower($network);?>"></i></span>
							<?php }
						} if (($display == "labels") or ($display == "both")) { ?> 
						<span class="social_label"><?php if (($networks[$network]['label'])!=="") { echo $networks[$network]['label']; } else { echo $network; } ?></span>
					<?php } ?>
				</a>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>

		</ul>
		<!-- END SOCIAL NETWORKS -->
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = strip_tags($new_instance['title']);
		
		$instance['twitter']         = $new_instance['twitter'];
		$instance['facebook']        = $new_instance['facebook'];
		$instance['flickr']          = $new_instance['flickr'];
		$instance['skype']           = $new_instance['skype'];
		$instance['rss']       		 = $new_instance['rss'];
		$instance['delicious']       = $new_instance['delicious'];
		$instance['dribbble']       = $new_instance['dribbble'];
		$instance['google_plus']     = $new_instance['google_plus'];
		
		$instance['twitter_label']   = $new_instance['twitter_label'];
		$instance['facebook_label']  = $new_instance['facebook_label'];
		$instance['flickr_label']    = $new_instance['flickr_label'];
		$instance['skype_label']     = $new_instance['skype_label'];
		$instance['rss_label'] 		 = $new_instance['rss_label'];
		$instance['delicious_label'] = $new_instance['delicious_label'];
		$instance['dribbble_label'] = $new_instance['dribbble_label'];
		$instance['google_plus_label'] = $new_instance['google_plus_label'];
		
		$instance['display']         = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'twitter' => '', 'twitter_label' => '', 'facebook' => '', 'facebook_label' => '', 'flickr' => '', 'flickr_label' => '', 'skype' => '', 'skype_label' => '', 'rss' => '', 'rss_label' => '', 'delicious' => '', 'delicious_label' => '', 'dribbble' => '', 'dribbble_label' => '', 'google_plus' => '', 'google_plus_label' => '', 'display' => 'icons', 'text' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
			
		$twitter         = $instance['twitter'];
		$facebook        = $instance['facebook'];
		$flickr          = $instance['flickr'];
		$skype           = $instance['skype'];
		$rss       		 = $instance['rss'];
		$delicious       = $instance['delicious'];
		$dribbble       = $instance['dribbble'];
		$google_plus     = $instance['google_plus'];
		
		$twitter_label   = $instance['twitter_label'];
		$facebook_label  = $instance['facebook_label'];
		$flickr_label    = $instance['flickr_label'];
		$skype_label     = $instance['skype_label'];
		$rss_label  	 = $instance['rss_label'];
		$delicious_label = $instance['delicious_label'];
		$dribbble_label = $instance['dribbble_label'];
		$google_plus_label = $instance['google_plus_label'];
		
		$display         = $instance['display'];
		$title           = strip_tags($instance['title']);
		$text            = format_to_edit($instance['text']);
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php theme_locals("title") ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Facebook' ?>:</legend>
		
		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo 'Facebook URL:' ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('facebook_label'); ?>"><?php echo 'Facebook '.theme_locals("label") ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook_label'); ?>" name="<?php echo $this->get_field_name('facebook_label'); ?>" type="text" value="<?php echo esc_attr($facebook_label); ?>" /></p>
	</fieldset>
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Twitter' ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo 'Twitter URL:' ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php echo 'Twitter '.theme_locals("label") ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" name="<?php echo $this->get_field_name('twitter_label'); ?>" type="text" value="<?php echo esc_attr($twitter_label); ?>" /></p>
	</fieldset>	
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Skype' ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('skype'); ?>"><?php echo 'Skype:' ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo esc_attr($skype); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('skype_label'); ?>"><?php echo 'Skype '.theme_locals("label") ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('skype_label'); ?>" name="<?php echo $this->get_field_name('skype_label'); ?>" type="text" value="<?php echo esc_attr($skype_label); ?>" /></p>
	</fieldset>
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
			<legend style="padding:0 5px;"><?php echo 'Rss' ?>:</legend>
	<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php echo 'Rss URL:' ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo esc_attr($rss); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('rss_label'); ?>"><?php echo 'Rss '.theme_locals("label") ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('rss_label'); ?>" name="<?php echo $this->get_field_name('rss_label'); ?>" type="text" value="<?php echo esc_attr($rss_label); ?>" /></p>
		</fieldset>
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Dribbble' ?>:</legend>
		<p>
			<label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php echo 'Dribbble URL:' ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" name="<?php echo $this->get_field_name('dribbble'); ?>" type="text" value="<?php echo esc_attr($dribbble); ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('dribbble_label'); ?>"><?php echo 'Dribbble '.theme_locals("label") ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('dribbble_label'); ?>" name="<?php echo $this->get_field_name('dribbble_label'); ?>" type="text" value="<?php echo esc_attr($dribbble_label); ?>" />
		</p>
	</fieldset>
	
	<fieldset style="border:1px solid #dfdfdf; padding:10px 10px 0; margin-bottom:1em;">
		<legend style="padding:0 5px;"><?php echo 'Google+'; ?>:</legend>
		<p>
			<label for="<?php echo $this->get_field_id('google_plus'); ?>"><?php echo 'Google+ URL:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google_plus'); ?>" name="<?php echo $this->get_field_name('google_plus'); ?>" type="text" value="<?php echo esc_attr($google_plus); ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('google_plus_label'); ?>"><?php echo 'Google+ '.theme_locals("label"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google_plus_label'); ?>" name="<?php echo $this->get_field_name('google_plus_label'); ?>" type="text" value="<?php echo esc_attr($google_plus_label); ?>" />
		</p>
	</fieldset>


		<p><?php echo theme_locals("display") ?></p>
		<label for="<?php echo $this->get_field_id('icons'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="icons" id="<?php echo $this->get_field_id('icons'); ?>" <?php checked($display, "icons"); ?>></input>  <?php echo theme_locals("icons") ?></label>
		<label for="<?php echo $this->get_field_id('labels'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="labels" id="<?php echo $this->get_field_id('labels'); ?>" <?php checked($display, "labels"); ?>></input> <?php echo theme_locals("labels") ?></label>
		<label for="<?php echo $this->get_field_id('both'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="both" id="<?php echo $this->get_field_id('both'); ?>" <?php checked($display, "both"); ?>></input> <?php echo theme_locals("both") ?></label>
<?php
	}
}?>