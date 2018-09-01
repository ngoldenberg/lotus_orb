<?php

/*-------------------------------------------------*/
/*	Widget - Social Icons
/*-------------------------------------------------*/

class ML_Social extends WP_Widget {

     function ML_Social() {
       // Instantiate the parent object
       parent::WP_Widget(false, __('Theme - Social Icons', 'meydjer'));
     }
			
			/* call the widget settings */
      function widget($args, $instance) {
			extract($args);
			$social_title = $instance['social_title'];
			$social_delicious = $instance['social_delicious'];
			$social_digg = $instance['social_digg'];
			$social_dribbble = $instance['social_dribbble'];
			$social_email = $instance['social_email'];
			$social_facebook = $instance['social_facebook'];
			$social_flickr = $instance['social_flickr'];
			$social_foursquare = $instance['social_foursquare'];
			$social_github = $instance['social_github'];
			$social_google = $instance['social_google'];
			$social_lastfm = $instance['social_lastfm'];
			$social_linkedin = $instance['social_linkedin'];
			$social_messenger = $instance['social_messenger'];
			$social_myspace = $instance['social_myspace'];
			$social_reddit = $instance['social_reddit'];
			$social_rss = $instance['social_rss'];
			$social_orkut = $instance['social_orkut'];
			$social_skype = $instance['social_skype'];
			$social_stumbleupon = $instance['social_stumbleupon'];
			$social_tumblr = $instance['social_tumblr'];
			$social_twitter = $instance['social_twitter'];
			$social_vimeo = $instance['social_vimeo'];
			$social_yahoo = $instance['social_yahoo'];
			$social_youtube = $instance['social_youtube'];
			
			?>
			
			
			<li id="fiatlux-twitter" class="widget widget_text">
						<h3 class="widgettitle"><?php echo $social_title; ?></h3>
						<ul class="ml_social">
							<?php if($social_delicious){ ?>
								<li><a href="<?php echo $social_delicious; ?>" class="delicious">Delicious</a></li>
							<?php } ?>
							<?php if($social_digg){ ?>
								<li><a href="<?php echo $social_digg; ?>" class="digg">Digg</a></li>
							<?php } ?>
							<?php if($social_dribbble){ ?>
								<li><a href="<?php echo $social_dribbble; ?>" class="dribbble">Dribbble</a></li>
							<?php } ?>
							<?php if($social_email){ ?>
								<li><a href="mailto:<?php echo $social_email; ?>" class="email">Email</a></li>
							<?php } ?>
							<?php if($social_facebook){ ?>
								<li><a href="<?php echo $social_facebook; ?>" class="facebook">Facebook</a></li>
							<?php } ?>
							<?php if($social_flickr){ ?>
								<li><a href="<?php echo $social_flickr; ?>" class="flickr">Flickr</a></li>
							<?php } ?>
							<?php if($social_foursquare){ ?>
								<li><a href="<?php echo $social_foursquare; ?>" class="foursquare">FourSquare</a></li>
							<?php } ?>
							<?php if($social_github){ ?>
								<li><a href="<?php echo $social_github; ?>" class="github">Github</a></li>
							<?php } ?>
							<?php if($social_google){ ?>
								<li><a href="<?php echo $social_google; ?>" class="google">Google</a></li>
							<?php } ?>
							<?php if($social_lastfm){ ?>
								<li><a href="<?php echo $social_lastfm; ?>" class="lastfm">LastFM</a></li>
							<?php } ?>
							<?php if($social_linkedin){ ?>
								<li><a href="<?php echo $social_linkedin; ?>" class="linkedin">LinkedIn</a></li>
							<?php } ?>
							<?php if($social_messenger){ ?>
								<li><a href="<?php echo $social_messenger; ?>" class="messenger">Messenger</a></li>
							<?php } ?>
							<?php if($social_myspace){ ?>
								<li><a href="<?php echo $social_myspace; ?>" class="myspace">MySpace</a></li>
							<?php } ?>
							<?php if($social_orkut){ ?>
								<li><a href="<?php echo $social_orkut; ?>" class="orkut">Orkut</a></li>
							<?php } ?>
							<?php if($social_reddit){ ?>
								<li><a href="<?php echo $social_reddit; ?>" class="reddit">Reddit</a></li>
							<?php } ?>
							<?php if($social_rss){ ?>
								<li><a href="<?php echo $social_rss; ?>" class="rss">RSS</a></li>
							<?php } ?>
							<?php if($social_skype){ ?>
								<li><a href="callto:<?php echo $social_skype; ?>" class="skype">Skype</a></li>
							<?php } ?>
							<?php if($social_stumbleupon){ ?>
								<li><a href="<?php echo $social_stumbleupon; ?>" class="stumbleupon">StumbleUpon</a></li>
							<?php } ?>
							<?php if($social_tumblr){ ?>
								<li><a href="<?php echo $social_tumblr; ?>" class="tumblr">Tumblr</a></li>
							<?php } ?>
							<?php if($social_twitter){ ?>
								<li><a href="<?php echo $social_twitter; ?>" class="twitter">Twitter</a></li>
							<?php } ?>
							<?php if($social_vimeo){ ?>
								<li><a href="<?php echo $social_vimeo; ?>" class="vimeo">Vimeo</a></li>
							<?php } ?>
							<?php if($social_yahoo){ ?>
								<li><a href="<?php echo $social_yahoo; ?>" class="yahoo">Yahoo</a></li>
							<?php } ?>
							<?php if($social_youtube){ ?>
								<li><a href="<?php echo $social_youtube; ?>" class="youtube">YouTube</a></li>
							<?php } ?>
						</ul>
			</li>
       
		<?php }
		
		/* update the widget settiings */
		function update ($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['social_title'] = $new_instance['social_title'];
			$instance['social_delicious'] = $new_instance['social_delicious'];
			$instance['social_digg'] = $new_instance['social_digg'];
			$instance['social_dribbble'] = $new_instance['social_dribbble'];
			$instance['social_email'] = $new_instance['social_email'];
			$instance['social_facebook'] = $new_instance['social_facebook'];
			$instance['social_flickr'] = $new_instance['social_flickr'];
			$instance['social_foursquare'] = $new_instance['social_foursquare'];
			$instance['social_github'] = $new_instance['social_github'];
			$instance['social_google'] = $new_instance['social_google'];
			$instance['social_lastfm'] = $new_instance['social_lastfm'];
			$instance['social_linkedin'] = $new_instance['social_linkedin'];
			$instance['social_messenger'] = $new_instance['social_messenger'];
			$instance['social_myspace'] = $new_instance['social_myspace'];
			$instance['social_reddit'] = $new_instance['social_reddit'];
			$instance['social_rss'] = $new_instance['social_rss'];
			$instance['social_orkut'] = $new_instance['social_orkut'];
			$instance['social_skype'] = $new_instance['social_skype'];
			$instance['social_stumbleupon'] = $new_instance['social_stumbleupon'];
			$instance['social_tumblr'] = $new_instance['social_tumblr'];
			$instance['social_twitter'] = $new_instance['social_twitter'];
			$instance['social_vimeo'] = $new_instance['social_vimeo'];
			$instance['social_yahoo'] = $new_instance['social_yahoo'];
			$instance['social_youtube'] = $new_instance['social_youtube'];		
			return $instance;
		}
		
		/* widget settings form */
		function form($instance) {
		$defaults = array('numbertweets' => '2');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<h3><?php _e('Social Icons', 'meydjer'); ?></h3>
		
		<p><?php _e('Please, enter the FULL URL.', 'meydjer'); ?></p>
		<p>
			<label for="<?php echo $this->get_field_id('social_title'); ?>"><?php _e('Widget Title', 'meydjer'); ?>:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_title') ?>" id="<?php echo $this->get_field_id('social_title') ?> " value="<?php echo $instance['social_title'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_delicious'); ?>">Delicious:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_delicious') ?>" id="<?php echo $this->get_field_id('social_delicious') ?> " value="<?php echo $instance['social_delicious'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_digg'); ?>">Digg:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_digg') ?>" id="<?php echo $this->get_field_id('social_digg') ?> " value="<?php echo $instance['social_digg'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_dribbble'); ?>">Dribbble:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_dribbble') ?>" id="<?php echo $this->get_field_id('social_dribbble') ?> " value="<?php echo $instance['social_dribbble'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_email'); ?>"><?php _e('Email (e.g. johndoe@gmail.com)', 'meydjer'); ?>:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_email') ?>" id="<?php echo $this->get_field_id('social_email') ?> " value="<?php echo $instance['social_email'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_facebook'); ?>">Facebook:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_facebook') ?>" id="<?php echo $this->get_field_id('social_facebook') ?> " value="<?php echo $instance['social_facebook'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_flickr'); ?>">Flickr:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_flickr') ?>" id="<?php echo $this->get_field_id('social_flickr') ?> " value="<?php echo $instance['social_flickr'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_foursquare'); ?>">FourSquare:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_foursquare') ?>" id="<?php echo $this->get_field_id('social_foursquare') ?> " value="<?php echo $instance['social_foursquare'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_github'); ?>">Github:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_github') ?>" id="<?php echo $this->get_field_id('social_github') ?> " value="<?php echo $instance['social_github'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_google'); ?>">Google:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_google') ?>" id="<?php echo $this->get_field_id('social_google') ?> " value="<?php echo $instance['social_google'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_lastfm'); ?>">LastFM:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_lastfm') ?>" id="<?php echo $this->get_field_id('social_lastfm') ?> " value="<?php echo $instance['social_lastfm'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_linkedin'); ?>">LinkedIn:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_linkedin') ?>" id="<?php echo $this->get_field_id('social_linkedin') ?> " value="<?php echo $instance['social_linkedin'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_messenger'); ?>">Messenger:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_messenger') ?>" id="<?php echo $this->get_field_id('social_messenger') ?> " value="<?php echo $instance['social_messenger'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_myspace'); ?>">MySpace:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_myspace') ?>" id="<?php echo $this->get_field_id('social_myspace') ?> " value="<?php echo $instance['social_myspace'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_reddit'); ?>">Reddit:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_reddit') ?>" id="<?php echo $this->get_field_id('social_reddit') ?> " value="<?php echo $instance['social_reddit'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_rss'); ?>">RSS:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_rss') ?>" id="<?php echo $this->get_field_id('social_rss') ?> " value="<?php echo $instance['social_rss'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_orkut'); ?>">Orkut:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_orkut') ?>" id="<?php echo $this->get_field_id('social_orkut') ?> " value="<?php echo $instance['social_orkut'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_skype'); ?>"><?php _e('Skype (Only Username)', 'meydjer'); ?>:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_skype') ?>" id="<?php echo $this->get_field_id('social_skype') ?> " value="<?php echo $instance['social_skype'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_stumbleupon'); ?>">StumbleUpon:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_stumbleupon') ?>" id="<?php echo $this->get_field_id('social_stumbleupon') ?> " value="<?php echo $instance['social_stumbleupon'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_tumblr'); ?>">Tumblr:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_tumblr') ?>" id="<?php echo $this->get_field_id('social_tumblr') ?> " value="<?php echo $instance['social_tumblr'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_twitter'); ?>">Twitter:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_twitter') ?>" id="<?php echo $this->get_field_id('social_twitter') ?> " value="<?php echo $instance['social_twitter'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_vimeo'); ?>">Vimeo:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_vimeo') ?>" id="<?php echo $this->get_field_id('social_vimeo') ?> " value="<?php echo $instance['social_vimeo'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_yahoo'); ?>">Yahoo:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_yahoo') ?>" id="<?php echo $this->get_field_id('social_yahoo') ?> " value="<?php echo $instance['social_yahoo'] ?>" size="27">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_youtube'); ?>">YouTube:</label>
			<input type="text" name="<?php echo $this->get_field_name('social_youtube') ?>" id="<?php echo $this->get_field_id('social_youtube') ?> " value="<?php echo $instance['social_youtube'] ?>" size="27">
		</p>

		<?php }
}
register_widget('ML_Social');
?>