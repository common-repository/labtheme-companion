<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://labtheme.com/
 * @since      1.0.0
 *
 * @package    Labtheme_Companion
 * @subpackage Labtheme_Companion/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Labtheme_Companion
 * @subpackage Labtheme_Companion/admin
 * @author     Lab Theme <info@labtheme.com>
 */
class Labtheme_Companion_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = LABTC_PLUGIN_VERSION;

	}

	/**
	 * Get the allowed socicon lists.
	 * @return array
	 */
	function labtheme_get_allowed_socicons() {
		return apply_filters( 'labtheme_social_icons_allowed_socicon', array( 'modelmayhem', 'mixcloud', 'drupal', 'swarm', 'istock', 'yammer', 'ello', 'stackoverflow', 'persona', 'triplej', 'houzz', 'rss', 'paypal', 'odnoklassniki', 'airbnb', 'periscope', 'outlook', 'coderwall', 'tripadvisor', 'appnet', 'goodreads', 'tripit', 'lanyrd', 'slideshare', 'buffer', 'disqus', 'vk', 'whatsapp', 'patreon', 'storehouse', 'pocket', 'mail', 'blogger', 'technorati', 'reddit', 'dribbble', 'stumbleupon', 'digg', 'envato', 'behance', 'delicious', 'deviantart', 'forrst', 'play', 'zerply', 'wikipedia', 'apple', 'flattr', 'github', 'renren', 'friendfeed', 'newsvine', 'identica', 'bebo', 'zynga', 'steam', 'xbox', 'windows', 'qq', 'douban', 'meetup', 'playstation', 'android', 'snapchat', 'twitter', 'facebook', 'google-plus', 'pinterest', 'foursquare', 'yahoo', 'skype', 'yelp', 'feedburner', 'linkedin', 'viadeo', 'xing', 'myspace', 'soundcloud', 'spotify', 'grooveshark', 'lastfm', 'youtube', 'vimeo', 'dailymotion', 'vine', 'flickr', '500px', 'instagram', 'wordpress', 'tumblr', 'twitch', '8tracks', 'amazon', 'icq', 'smugmug', 'ravelry', 'weibo', 'baidu', 'angellist', 'ebay', 'imdb', 'stayfriends', 'residentadvisor', 'google', 'yandex', 'sharethis', 'bandcamp', 'itunes', 'deezer', 'medium', 'telegram', 'openid', 'amplement', 'viber', 'zomato', 'quora', 'draugiem', 'endomodo', 'filmweb', 'stackexchange', 'wykop', 'teamspeak', 'teamviewer', 'ventrilo', 'younow', 'raidcall', 'mumble', 'bebee', 'hitbox', 'reverbnation', 'formulr', 'battlenet', 'chrome', 'diablo', 'discord', 'issuu', 'macos', 'firefox', 'heroes', 'hearthstone', 'overwatch', 'opera', 'warcraft', 'starcraft', 'keybase', 'alliance', 'livejournal', 'googlephotos', 'horde', 'etsy', 'zapier', 'google-scholar', 'researchgate' ) );
	}

	/**
	 * Get the icon from supported URL lists.
	 * @return array
	 */
	function labtheme_get_supported_url_icon() {
		return apply_filters( 'labtheme_social_icons_get_supported_url_icon', array(
			'feed'                  => 'rss',
			'ok.ru'                 => 'odnoklassniki',
			'vk.com'                => 'vk',
			'last.fm'               => 'lastfm',
			'youtu.be'              => 'youtube',
			'battle.net'            => 'battlenet',
			'blogspot.com'          => 'blogger',
			'play.google.com'       => 'play',
			'plus.google.com'       => 'google-plus',
			'photos.google.com'     => 'googlephotos',
			'chrome.google.com'     => 'chrome',
			'scholar.google.com'    => 'google-scholar',
			'feedburner.google.com' => 'mail',
		) );
	}

	public function labtheme_icon_list_enqueue(){
		$obj = new Labtheme_Companion_Functions;
		$socicons = $obj->labtheme_icon_list();
		echo '<div class="labtheme-icons-wrap-template"><div class="labtheme-icons-wrap"><ul class="labtheme-icons-list">';
		foreach ($socicons as $socicon) {
			if($socicon == 'rss'){
				echo '<li><i class="fas fa-'.$socicon.'"></i></li>';
			}
			else{
				echo '<li><i class="fab fa-'.$socicon.'"></i></li>';
			}
		}
		echo'</ul></div></div>';
		echo '<style>
		.labtheme-icons-wrap{
			display:none;
		}
		</style>';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Labtheme_Companion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Labtheme_Companion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/labtheme-companion-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'fontawesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'rateyo', plugin_dir_url( __FILE__ ) . 'css/jquery.rateyo.min.css', array(), $this->version, 'all' );
		$screen = get_current_screen();
    	$jquery_ui_cpt = array( 'lab-event'=>'lab-event','lab-course'=>'lab-course' );
    	$myarr = apply_filters( 'labtheme_jquery_ui_cpt',$jquery_ui_cpt );
    	foreach ($myarr as $key => $value) {
			if( $screen->post_type== $key )
			{
				wp_enqueue_style('jquery-style', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version, 'all' );
				wp_enqueue_style('jquery-timepicker-style', plugin_dir_url( __FILE__ ) . 'css/jquery.timepicker.min.css', array(), $this->version, 'all' );
			}
    	}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Labtheme_Companion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Labtheme_Companion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'jquery-ui-sortable' );    
		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/labtheme-companion-admin.js', array( 'jquery','jquery-ui-sortable','jquery-ui-datepicker' ), $this->version, false );

		$screen = get_current_screen(); 
		
		$labthem_emedia_upload_cpt = array( 'lab-course'=>'lab-course', 'lab-event'=>'lab-event' );
    	$myarr = apply_filters( 'labthem_emedia_upload_cpt',$labthem_emedia_upload_cpt );
    	foreach ($myarr as $key => $value) {
			if( $screen->post_type== $key )
			{				
				wp_enqueue_script('jquery-media', plugin_dir_url( __FILE__ ) . 'js/media-upload.min.js', array('jquery'), $this->version, false );
				wp_enqueue_script('jquery-timepicker', plugin_dir_url( __FILE__ ) . 'js/jquery.timepicker.min.js', array('jquery'), $this->version, false );
			}
    	} 
		// Localize socicons.
		$socicons_params = array(
			'allowed_socicons'   => $this->labtheme_get_allowed_socicons(),
			'supported_url_icon' => $this->labtheme_get_supported_url_icon(),
		);
		$confirming = array( 
			'are_you_sure'       => __( 'Are you sure?', 'labtheme-companion' ),
		);
    	wp_localize_script( $this->plugin_name, 'labtheme_companion_uploader', array(
        	'upload' => __( 'Upload', 'labtheme-companion' ),
        	'change' => __( 'Change', 'labtheme-companion' ),
        	'msg'    => __( 'Please upload a valid image file.', 'labtheme-companion' )
    	));
		wp_localize_script( $this->plugin_name, 'social_icons_admin_widgets', $socicons_params );
		wp_localize_script( $this->plugin_name, 'confirming', $confirming );
		wp_localize_script( $this->plugin_name, 'sociconsmsg', array(
				'msg' => __( 'Are you sure you want to delete this Social Media?', 'labtheme-companion' )));
		// print_r($screen);
		if( $screen->parent_base =='edit' )
		{
			wp_enqueue_script( $this->plugin_name.'-shortcodes', plugin_dir_url( __FILE__ ) . 'js/shortcodes.min.js', array( 'jquery' ), $this->version, false );
		}

		wp_enqueue_script( 'font-awesome', plugin_dir_url( __FILE__ ) . 'js/fontawesome/all.min.js', array( 'jquery'), $this->version, false );
		wp_enqueue_script( 'v4-shims', plugin_dir_url( __FILE__ ) . 'js/fontawesome/v4-shims.min.js', array( 'jquery'), $this->version, false );
		wp_enqueue_script( 'rateyo', plugin_dir_url( __FILE__ ) . 'js/jquery.rateyo.min.js', array( 'jquery'), $this->version, false );

	}

	// Declare script for new button
	function labtheme_add_tinymce_plugin( $plugin_array ) {
		$plugin_array['labtheme_mce_button'] = plugins_url( '/js/shortcodes.min.js', __FILE__ );
		return $plugin_array;
	}

	function labtheme_faq_template(){?> 
		<div class="labtheme-faq-template">
			<div class="faqs-repeat" data-id=""><span class="cross"><i class="fas fa-times"></i></span>
	            <label for="widget-labtheme_companion_faqs_widget-2-question-1"><?php _e('Question','labtheme-companion');?></label> 
	            <input class="widefat question" id="widget-labtheme_companion_faqs_widget-2-question-1" name="widget-labtheme_companion_faqs_widget[2][question][1]" type="text" value="">   
	            <label for="widget-labtheme_companion_faqs_widget-2-answer-1"><?php _e('Answer','labtheme-companion');?></label> 
	            <textarea class="answer" id="widget-labtheme_companion_faqs_widget-2-answer-1" name="widget-labtheme_companion_faqs_widget[2][answer][1]"></textarea>         
	        </div>
	    </div>
        <?php
		echo '<style>.labtheme-faq-template{display:none;}</style>';
    }

    function labtheme_client_logo_template(){ ?>
		<div class="labtheme-client-logo-template">
			<div class="link-image-repeat" data-id=""><span class="cross"><i class="fas fa-times"></i></span>
	            <div class="widget-upload">
	            	<label for="widget-labtheme_client_logo_widget-2-image">Upload Image</label><br>
	            	<input id="widget-labtheme_client_logo_widget-2-image" class="labtheme-upload link" type="hidden" name="widget-labtheme_client_logo_widget[2][image][]" value="" placeholder="No file chosen">
					<input id="upload-widget-labtheme_client_logo_widget-2-image" class="labtheme-upload-button button" type="button" value="Upload">
					<div class="labtheme-screenshot" id="widget-labtheme_client_logo_widget-2-image-image"></div>
				</div>
	                <label for="widget-labtheme_client_logo_widget-2-link">Featured Link</label> 
	                <input class="widefat featured-link" id="widget-labtheme_client_logo_widget-2-link" name="widget-labtheme_client_logo_widget[2][link][]" type="text" value="">            
        	</div>
	    </div>
	<?php
	echo '<style>.labtheme-client-logo-template{display:none;}</style>';
	}

	/**
    * 
    * Social icon template for team.
    *
    * @since 1.0.0
    */
    function labtheme_team_social_template() { ?>
        <div class="labtheme-social-team-template">
            <li class="labtheme-social-icon-wrap" data-id="{{indexed}}">
                <span class="labtheme-social-icons-field-handle"><i class="fas fa-plus"></i></span>
                <label for="team-social-profile"><?php esc_html_e( 'Social Icon', 'labtheme-companion' ); ?></label>
            	<span class="example-text">Example: facebook</span>
            	<input class="team-social-profile" placeholder="<?php _e('Search Social Icons','labtheme-companion');?>" name="labtheme_setting[team][social_profile][{{indexed}}]" type="text" value="" />
            	<label for="team-social-length"><?php esc_html_e( 'Link', 'labtheme-companion' ); ?></label>
            	<span class="example-text">Example: http://facebook.com</span>                	
                <input class="team-social-length" name="labtheme_setting[team][social][{{indexed}}]" type="text" value="" />
                <span class="del-team-icon"><i class="fas fa-times"></i></span>
            </li>
        </div>
    	<?php
        echo 
        '<style>
        	.labtheme-social-team-template{
        		display: none;
        	}
        </style>';
    }

    /**
	 * return array of post types that should use the Post Type Archive Description
	 * @return array post types to use description with (default, all non-built-in with archive)
	 */
	function labtheme_get_post_types() {
		// $args = array(
		// 	'_builtin' => false,
		// 	'has_archive' => true
		// );
		$post_types = array( 'team' => 'lab-team', 'faq' => 'lab-faq', 'service' => 'lab-service', 'client' => 'lab-client', 'event' => 'lab-event', 'course' => 'lab-course', 'testimonial' => 'lab-testimonial', 'portfolio' => 'lab-portfolio' );
		$post_types = apply_filters( 'labtheme_post_types_archive_desc', $post_types );

		return $post_types;
	}

	/**
	 * Output filterable name of Settings page
	 * 
	 * @param string $post_type name of post type for the page
	 * @param 'label'|'name' $pt_val whether $post_type is the label (default) or name
	 * @return name for settings page
	 */
	function labtheme_settings_page_title( $post_type, $pt_val = 'label' ) {
		if( $pt_val == 'name' ) {
			$post_type_info = get_post_types( array( 'name' => $post_type ), 'objects' );
			$post_type = $post_type_info[$post_type]->labels->name;
		}
		$settings_page_title = sprintf( __( 'Description for the %1$s Archive', 'labtheme-companion' ), $post_type );
		/**
		 * filter for admin menu label
		 * 
		 * @var string $settings_page_menu_label label text (default: "Description for the {Post Type} Archive")
		 * @var string $post_type post_type name if needed
		 */
		$settings_page_title = apply_filters( 'labtheme_admin_title', $settings_page_title, $post_type );
		return $settings_page_title;
	}

	/**
	 * Output filterable menu label for a post type's description settings page.
	 * @param  string $post_type post_type to create label for
	 * @param 'label'|'name' $pt_val whether $post_type is the label (default) or name
	 * @return string            admin menu label
	 */
	function labtheme_settings_menu_label( $post_type, $pt_val = 'label' ) {
		if( $pt_val == 'name' ) {
			$post_type_info = get_post_types( array( 'name' => $post_type ), 'objects' );
			$post_type = $post_type_info[$post_type]->labels->name;
		}
		$settings_page_menu_label = __( 'Archive Description', 'labtheme-companion' );
		/**
		 * filter for admin menu label
		 * 
		 * @var string $settings_page_menu_label label text (default: "Description")
		 * @var string $post_type post_type name if needed
		 */
		$settings_page_menu_label = apply_filters( 'labtheme_menu_label', $settings_page_menu_label, $post_type );
		return $settings_page_menu_label;
	}

	/****************************************************
	 * 
	 * Register Menu Pages, Settings, and Callbacks
	 * 
	 ****************************************************/

	/**
	 * Register admin pages for description field
	 */

	function labtheme_enable_pages() {

		$post_types = $this->labtheme_get_post_types();

		foreach ( $post_types as $post_type ) {

			if( post_type_exists( $post_type ) ) {

				add_submenu_page(
					'edit.php?post_type=' . $post_type, // $parent_slug
					$this->labtheme_settings_page_title( $post_type, 'name' ), // $page_title
					$this->labtheme_settings_menu_label( $post_type, 'name' ), // $menu_label
					'edit_posts', // $capability
					$post_type . '-description', // $menu_slug
					array( $this, 'labtheme_settings_page' )// $function
				);

			} // end if

		} // end foreach

	}

	/**
	 * Register Setting, Settings Section, and Settings Field
	 */

	function labtheme_register_settings() {

		$post_types = $this->labtheme_get_post_types();

		// A single option will hold all our descriptions


		// add a settings section and field for each $post_type
		foreach ( $post_types as $post_type ) {

			if( post_type_exists( $post_type ) ) {

				register_setting(
					'labtheme_descriptions', // $option_group
					'labtheme_descriptions', // $option_name
					array( $this, 'labtheme_sanitize_inputs' ) // $sanitize_callback
				);
				// Register settings and call sanitization functions
				add_settings_section(
					'labtheme_settings_section_' . $post_type, // $id
					'', // $title
					array( $this, 'labtheme_settings_section_callback' ), // $callback
					$post_type . '-description' // $page
				);

				// Field for our setting
				add_settings_field(
					'labtheme_setting_' . $post_type, // $id
					__( 'Description Text', 'labtheme-companion' ), // $title
					array( $this, 'labtheme_editor_field' ), // $callback
					$post_type . '-description', // $page
					'labtheme_settings_section_' . $post_type, // $section
					array( // $args
						'post_type' => $post_type,
						'field_name' => 'labtheme_descriptions[' . $post_type . ']',
						'label_for' => 'labtheme_descriptions[' . $post_type . ']'
					)
				);

			} // endif

		} // end foreach

	}

	// There is no need for this function at this time.
	function labtheme_settings_section_callback() {}

	/**
	 * Output a wp_editor instance for use by settings fields
	 */
	function labtheme_editor_field( $args ) {

		$post_type = $args['post_type'];
		$descriptions = (array) get_option( 'labtheme_descriptions' );

		if( array_key_exists($post_type, $descriptions) ) {
			$description = $descriptions[$post_type];
		} else {
			$description = '';
		}
		$editor_settings = array(
			'textarea_name' => $args['field_name'],
			'textarea_rows' => 15,
			'media_buttons' => true,
			'classes' 		=> 'wp-editor-area wp-editor'
		);
		$editor_settings = apply_filters( 'labtheme_wp_editor_settings', $editor_settings, $args, $description );

		wp_editor( $description, 'labthemeeditor', $editor_settings );
		
		if ( ! defined( 'QTX_VERSION' ) ) {
			add_filter( 'the_editor', 'qtranslate_admin_loadConfig' );
		}
		
	}

	/**
	 * Output settings pages
	 */
	function labtheme_settings_page() {
		$screen = get_current_screen();
		$post_type = $screen->post_type;
		?>
		<div class="wrap">
			<h2><?php echo $this->labtheme_settings_page_title( $post_type, 'name' ); ?></h2>
			<form action="options.php" method="POST">
					<?php settings_fields( 'labtheme_descriptions' ); ?>
					<?php do_settings_sections( $post_type . '-description' ); ?>
					<?php submit_button(); ?>
			</form>
		</div> <?php
	}

	/**
	 * sanitize description inputs before saving option
	 */
	function labtheme_sanitize_inputs( $input ) {
		// get all descriptions
		$all_descriptions = (array) get_option( 'labtheme_descriptions' );
		// sanitize input
		foreach( $input as $post_type => $description ) {
			$sanitized_input[$post_type] = wp_kses_post( $description );
		}
		// merge with other descriptions into array setting
		$input = array_merge( $all_descriptions, $sanitized_input );

		return $input;
	}

	/**
	 * Return capability that's allowed to edit posts
	 * 
	 * See: http://core.trac.wordpress.org/ticket/14365
	 */
	function labtheme_allow_edit_posts() {
		$capability = 'edit_posts';
		/**
		 * filter the capability for who can edit descriptions
		 * 
		 * @var string $capability capability required to edit post type descriptions (default: edit_posts)
		 */
		$capability = apply_filters( 'labtheme_description_capability', $capability );
		
		return esc_attr( $capability );
	}
	/* Set options page permissions to honor specific permissions for editing the description */

	/**
	 * add links to view/edit archive in the admin bar
	 */
	function labtheme_admin_bar_links( $admin_bar ) {

		if(
			!is_admin()
			&& is_post_type_archive( $this->labtheme_get_post_types() )
			&& current_user_can( $this->labtheme_allow_edit_posts() )
		 ) {
			global $post_type;
			$post_type_object = get_post_type_object( $post_type );
			$post_type_name = $post_type_object->labels->name;

			$link_text = sprintf( __( 'Edit %1$s Description', 'labtheme-companion' ), $post_type_name );
			/**
			 * filter the "Edit {Post Type} Description" link
			 * @var $link_text string default test
			 * @var $post_type_name string name of post type for targeting specific type
			 */
			$link_text = apply_filters( 'labtheme_edit_description_link', $link_text, $post_type_name );

			$args = array(
				'id'    => 'wp-admin-bar-edit',
				'title' => $link_text,
				'href'  => admin_url( 'edit.php?post_type=' . $post_type . '&page=' . $post_type . '-description' )
			);
			$admin_bar->add_menu( $args );
		}

		if( is_admin() ) {

			$screen = get_current_screen();
			$post_type = $screen->post_type;
			$description_page = $post_type . '_page_' . $post_type . '-description';

			if( $screen->base == $description_page ) {
				$post_type_object = get_post_type_object( $post_type );
				$post_type_name = $post_type_object->labels->name;

				$link_text = sprintf( __( 'View %1$s Archive', 'labtheme-companion' ), $post_type_name );
				/**
				 * filter the "View {Post Type} Archive" link
				 * @var $link_text string default test
				 * @var $post_type_name string name of post type for targeting specific type
				 */
				$link_text = apply_filters( 'labtheme_view_archive_link', $link_text, $post_type_name );

				$post_type_object = get_post_type_object( $post_type );
				$args = array(
					'id'    => 'wp-admin-bar-edit',
					'title' => $link_text,
					'href'  => get_post_type_archive_link( $post_type )
				);
				$admin_bar->add_menu( $args );
			}
		}

	}

	/****************************************************
	 * 
	 * Automatically display content if using *_archive_description() introduced in 4.1!
	 * 
	 ****************************************************/
	/**
	 * filter the_archive_description & get_the_archive_description to show post type archive
	 * @param  string $description original description
	 * @return string              post type description if on post type archive
	 */
	function labtheme_archive_description( $description ) {
		if( is_post_type_archive( $this->labtheme_get_post_types() ) ) {
			$description = $this->labtheme_get_post_type_description();
		}
		return wp_kses_post( $description );
	}

	/****************************************************
	 * 
	 * Functions to get Description Page Content
	 * 
	 ****************************************************/
	/**
	 * echo post type archive description
	 * 
	 * if on a post type archive, automatically grabs current post type
	 * 
	 * @param  string $post_type slug for post type to show description for (optional)
	 * @return string            post type description
	 */
	function labtheme_the_post_type_description( $post_type = '' ) {
		echo $this->labtheme_get_post_type_description( $post_type );
	}

	/**
	 * return post type archive description
	 * 
	 * if on a post type archive, automatically grabs current post type
	 * 
	 * @param  string $post_type slug for post type to show description for (optional)
	 * @return string            post type description
	 */
	function labtheme_get_post_type_description( $post_type = '' ) {
		
		// get global $post_type if not specified
		if ( '' == $post_type ) {
			global $post_type;
		}

		$all_descriptions = (array) get_option( 'labtheme_descriptions' );
		if( array_key_exists($post_type, $all_descriptions) ) {
			$post_type_description = $all_descriptions[$post_type];
		} else {
			$post_type_description = '';
		}
		$description = apply_filters( 'the_content', $post_type_description );

		return wp_kses_post( $description );

	}


	/**
	 * filter editor settings to add necessary text editor classes for support
	 * @param  array $editor_settings tinymce settings array
	 * @return array                  filtered settings
	 */
	function labtheme_qtranslate_editor_args( $editor_settings ) {
		 $editor_settings['classes'] = $editor_settings['classes'] . ' multilanguage-input qtranxs-translatable';

		 return $editor_settings;
	}
	
	/**
	 * filter qtranslate so it knows to pay attention on archive description editor pages
	 */
	function labtheme_qtranslate_support( $page_configs ) {

			//edit.php?post_type=$post_type&page=
		$page_config = array();
		
		//get post types
		$post_types = $this->labtheme_get_post_types();

		// add a settings section and field for each $post_type
		foreach ( $post_types as $post_type ) {

			if( post_type_exists( $post_type ) ) {
				$page_config['pages'] = array( 'edit.php' => 'post_type=' . $post_type . '&page=' );
			}
			
		}

		$page_config['forms'] = array();

		$f = array();

		$f['fields'] = array();
		$fields = &$f['fields'];

		//textarea support
		$fields[] = array( 'tag' => 'textarea' );

		$page_config['forms'][] = $f;
		$page_configs[] = $page_config;

		return $page_configs;
	}

	/**
	 * Adds metabox for testimonials. 
	 * 
	 * @since 1.0.0
	 */
	function labtheme_create_boxes(){
		$adminobj = new Labtheme_Companion_Admin_Post_Type;
		$myarray = $adminobj->labtheme_get_posttype_array();
		foreach ($myarray as $key => $value) {
			add_meta_box(
				'labtheme_'.$key.'_id', //assuming each key is different
				__( 'Details', 'labtheme-companion' ),
				array($this,'labtheme_testimonials_metabox_callback'),
				$key, // WP_Screen
				'side',
				'high',
				array('key' => $key,'value' => $value) // This is what you need
			);
		}
	}

	public function labtheme_testimonials_metabox_callback( $post, $callback_args ){
		$key = $callback_args['args']['key'];
		$value = $callback_args['args']['value'];
		include $value['path'].'labtheme-'.$key.'-template.php';
	}
	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function labtheme_save_meta_box_data( $post_id ) {
		
	    /*
	     * We need to verify this came from our screen and with proper authorization,
	     * because the save_post action can be triggered at other times.
	     */
	    // Sanitize user input.
	    if(isset($_POST['labtheme_setting']))
	    {
		    $settings = $_POST['labtheme_setting'];
		    update_post_meta( $post_id, '_labtheme_setting', $settings );
	    }  
	}
}