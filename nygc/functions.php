<?php

$theme_data = wp_get_theme(get_option('template'));
$theme_version = $theme_data->Version;

/* -- ENQUEUE SCRIPTS -- */

function nygc_scripts_method(){
	
	global $theme_version;
	
	wp_enqueue_script(
		'load',
	 	get_template_directory_uri().'/js/load.min.js',
		array(),
		$theme_version,
		false,
		false
	);

	wp_enqueue_script(
		'jquery_user', 
		"//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", 
		array(), 
		'1.10.2',
		true,
		false
	);

	wp_enqueue_script(
		'dependencies',
	 	get_template_directory_uri().'/js/dependencies.js',
		array(),
		$theme_version,
		true,
		false
	);

	wp_enqueue_script(
		'main',
	 	get_template_directory_uri().'/js/main.min.js',
		array(),
		$theme_version,
		true,
		false
	);
	
	wp_localize_script(
		'main',
		'nygcAjaxPosts',
		array(
			'ajaxURL' => admin_url( 'admin-ajax.php' ),
			'ajaxNonce' => wp_create_nonce( 'get-posts-nonce' )
		)
	);
	
	wp_localize_script(
		'main',
		'nygc',
		array(
			'hostname' => site_url(),
			'templateURL' => get_template_directory_uri()
		)
	);
}

add_action('wp_enqueue_scripts', 'nygc_scripts_method');

/* -- REMOVE WP_HEAD BLOAT -- */

remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'rel_canonical' );
remove_action('wp_head', 'rel_alternate' );

/* -- REGISTER CUSTOM POST TYPES -- */

function nygc_register_post_types(){
	
	// NEWS
 
	/* $nygc_news_labels = array(
		'name' => _x('News', 'post type general name'),
		'singular_name' => _x('News Item', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New News Item'),
		'edit_item' => __('Edit News Item'),
		'new_item' => __('New News Item'),
		'view_item' => __('View News Item'),
		'search_items' => __('Search News'),
		'not_found' =>  __('No News'),
		'not_found_in_trash' => __('No News found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_news_args = array(
		'labels' => $nygc_news_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'supporters','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('news', $nygc_news_args); */
	
	// SUPPORTER GROUPS
 
	// $nygc_supporters_labels = array(
	// 	'name' => _x('Supporters', 'post type general name'),
	// 	'singular_name' => _x('Supporter', 'post type singular name'),
	// 	'add_new' => _x('Add New', 'event'),
	// 	'add_new_item' => __('Add New Supporter'),
	// 	'edit_item' => __('Edit Supporter'),
	// 	'new_item' => __('New Supporter'),
	// 	'view_item' => __('View Supporter'),
	// 	'search_items' => __('Search Supporter'),
	// 	'not_found' =>  __('No Supporters found'),
	// 	'not_found_in_trash' => __('No Supporters found in Trash'),
	// 	'parent_item_colon' => ''
	// );

	// $nygc_supporters_args = array(
	// 	'labels' => $nygc_supporters_labels,
	// 	'public' => true,
	// 	'publicly_queryable' => true,
	// 	'show_ui' => true,
	// 	'query_var' => true,
	// 	'rewrite' => array('slug' => 'supporters','with_front' => false),
	// 	'capability_type' => 'post',
	// 	'hierarchical' => true,
	// 	'menu_position' => null,
	// 	'supports' => array('title','editor','thumbnail','custom-fields')
	// );

	// register_post_type('supporters', $nygc_supporters_args);
	
	/* CASE STUDIES
	
	$nygc_case_studies_labels = array(
		'name' => _x('Case Studies', 'post type general name'),
		'singular_name' => _x('Case Study', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Case Study'),
		'edit_item' => __('Edit Case Study'),
		'new_item' => __('New Case Study'),
		'view_item' => __('View Case Studies'),
		'search_items' => __('Search Case Studies'),
		'not_found' =>  __('No Case Studies found'),
		'not_found_in_trash' => __('No Case Studies found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_case_studies_args = array(
		'labels' => $nygc_case_studies_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'case-studies','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('case-studies', $nygc_case_studies_args); */
	
	// COLLABORATOR EXPERIENCES
	
	$nygc_experiences_labels = array(
		'name' => _x('Collaborator Experiences', 'post type general name'),
		'singular_name' => _x('Collaborator Experience', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Collaborator Experience'),
		'edit_item' => __('Edit Collaborator Experience'),
		'new_item' => __('New Collaborator Experience'),
		'view_item' => __('View Collaborator Experiences'),
		'search_items' => __('Search Collaborator Experiences'),
		'not_found' =>  __('No Collaborator Experiences found'),
		'not_found_in_trash' => __('No Collaborator Experiences found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_experiences_args = array(
		'labels' => $nygc_experiences_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'experiences','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('experiences', $nygc_experiences_args);
	
	// JOBS
	
	$nygc_jobs_labels = array(
		'name' => _x('Jobs', 'post type general name'),
		'singular_name' => _x('Job', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Job'),
		'edit_item' => __('Edit Job'),
		'new_item' => __('New Job'),
		'view_item' => __('View Jobs'),
		'search_items' => __('Search Jobs'),
		'not_found' =>  __('No Jobs found'),
		'not_found_in_trash' => __('No Jobs found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_jobs_args = array(
		'labels' => $nygc_jobs_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'jobs','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('jobs', $nygc_jobs_args);
	
	// EVENTS
	
	$nygc_events_labels = array(
		'name' => _x('Events', 'post type general name'),
		'singular_name' => _x('Event', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Event'),
		'edit_item' => __('Edit Event'),
		'new_item' => __('New Event'),
		'view_item' => __('View Events'),
		'search_items' => __('Search Events'),
		'not_found' =>  __('No Events found'),
		'not_found_in_trash' => __('No Events found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_events_args = array(
		'labels' => $nygc_events_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'events','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('events', $nygc_events_args);
	
	// PEOPLE PROFILES
	
	$nygc_people_labels = array(
		'name' => _x('People', 'post type general name'),
		'singular_name' => _x('Person', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Person'),
		'edit_item' => __('Edit Person'),
		'new_item' => __('New Person'),
		'view_item' => __('View People'),
		'search_items' => __('Search People'),
		'not_found' =>  __('No People found'),
		'not_found_in_trash' => __('No People found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_people_args = array(
		'labels' => $nygc_people_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'people/profiles','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('people', $nygc_people_args);
	
	// MEMBER PROFILES
	
	$nygc_members_labels = array(
		'name' => _x('Members', 'post type general name'),
		'singular_name' => _x('Member', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Member'),
		'edit_item' => __('Edit Member'),
		'new_item' => __('New Member'),
		'view_item' => __('View Members'),
		'search_items' => __('Search Members'),
		'not_found' =>  __('No Members found'),
		'not_found_in_trash' => __('No Members found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_members_args = array(
		'labels' => $nygc_members_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'members','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('members', $nygc_members_args);
	
	// COLLABORATOR PROFILES
	
	$nygc_collaborators_labels = array(
		'name' => _x('Collaborators', 'post type general name'),
		'singular_name' => _x('Collaborator', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Collaborator'),
		'edit_item' => __('Edit Collaborator'),
		'new_item' => __('New Collaborator'),
		'view_item' => __('View Collaborators'),
		'search_items' => __('Search Collaborators'),
		'not_found' =>  __('No Collaborators found'),
		'not_found_in_trash' => __('No Collaborators found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_collaborators_args = array(
		'labels' => $nygc_collaborators_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'collaborators','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('collaborators', $nygc_collaborators_args);
	
	// EVENT SERIES
	
	$nygc_series_labels = array(
		'name' => _x('Event Series', 'post type general name'),
		'singular_name' => _x('Event Series', 'post type singular name'),
		'add_new' => _x('Add New', 'event'),
		'add_new_item' => __('Add New Event Series'),
		'edit_item' => __('Edit Event Series'),
		'new_item' => __('New Event Series'),
		'view_item' => __('View Event Series'),
		'search_items' => __('Search Event Series'),
		'not_found' =>  __('No Event Series found'),
		'not_found_in_trash' => __('No Event Series found in Trash'),
		'parent_item_colon' => ''
	);

	$nygc_series_args = array(
		'labels' => $nygc_series_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'events-education/series','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	);

	register_post_type('series', $nygc_series_args);
}

add_action('init', 'nygc_register_post_types');

/* -- ADD CUSTOM TAXONOMIES FOR CUSTOM POST TYPES -- */

function nygc_register_taxonomies() {
	register_taxonomy(
		'people-groups',
		'people',
		array(
			'label' => __( 'People Groups' ),
			'rewrite' => array( 'slug' => 'people-groups' ),
			'hierarchical' => true,
			'show_admin_column' => true,
			'capabilities' => array(
				'manage_terms' => 'manage_categories',
				'edit_terms' => 'manage_categories',
				'delete_terms' => 'manage_categories',
				'assign_terms' => 'edit_posts'
			)
		)
	);
	
	register_taxonomy(
		'event-types',
		'events',
		array(
			'label' => __( 'Event Types' ),
			'rewrite' => array( 'slug' => 'event-types' ),
			'hierarchical' => true,
			'show_admin_column' => true,
			'capabilities' => array(
				'manage_terms' => 'manage_categories',
				'edit_terms' => 'manage_categories',
				'delete_terms' => 'manage_categories',
				'assign_terms' => 'edit_posts'
			)
		)
	);
	
	register_taxonomy(
		'departments',
		'jobs',
		array(
			'label' => __( 'Departments' ),
			'rewrite' => array( 'slug' => 'departments' ),
			'hierarchical' => true,
			'show_admin_column' => true,
			'capabilities' => array(
				'manage_terms' => 'manage_categories',
				'edit_terms' => 'manage_categories',
				'delete_terms' => 'manage_categories',
				'assign_terms' => 'edit_posts'
			)
		)
	);
}

add_action( 'init', 'nygc_register_taxonomies' );


/* -- ADD CUSTOM ICONS FOR CUSTOM POST TYPES -- */

function cpt_icons() {
    ?>
    <style type="text/css" media="screen">
    	#adminmenu .menu-icon-post div.wp-menu-image:before{content:none;}
    	#adminmenu #menu-posts div.wp-menu-image:before{content:"";}
        #menu-posts-jobs .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/jobs.png) no-repeat 6px -17px !important;
        }
		#menu-posts-jobs:hover .wp-menu-image, #menu-posts-jobs.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }

		#menu-posts-people .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/people.png) no-repeat 6px -17px !important;
        }
		#menu-posts-people:hover .wp-menu-image, #menu-posts-people.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }

		#menu-posts-supporters .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/supporters.png) no-repeat 6px -17px !important;
        }
		#menu-posts-supporters:hover .wp-menu-image, #menu-posts-supporters.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }

		#menu-posts-events .wp-menu-image,
		#menu-posts-series .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/events.png) no-repeat 6px -17px !important;
        }
		#menu-posts-events:hover .wp-menu-image, #menu-posts-events.wp-has-current-submenu .wp-menu-image,
		#menu-posts-series:hover .wp-menu-image, #menu-posts-series.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }

		#menu-posts-case-studies .wp-menu-image,
		#menu-posts-experiences .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/case-studies.png) no-repeat 6px -17px !important;
        }
		#menu-posts-case-studies:hover .wp-menu-image, #menu-posts-case-studies.wp-has-current-submenu .wp-menu-image,
		#menu-posts-experiences:hover .wp-menu-image, #menu-posts-experiences.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }

		#menu-posts-collaborators .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/collaborators.png) no-repeat 6px -17px !important;
        }
		#menu-posts-collaborators:hover .wp-menu-image, #menu-posts-collaborators.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }

		#menu-posts-members .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/members.png) no-repeat 6px -17px !important;
        }
		#menu-posts-members:hover .wp-menu-image, #menu-posts-members.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }

		#menu-posts-news .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/im/admin/news.png) no-repeat 6px -17px !important;
        }
		#menu-posts-news:hover .wp-menu-image, #menu-posts-news.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
<?php } 

add_action( 'admin_head', 'cpt_icons' );

/* --- REGISTER NAV MENUS --- */

function register_my_menus() {
  register_nav_menus(
    array(
		'primary' => __('Primary'),
		'secondary' => __('Secondary'),
		'footer' => __('Footer')
    )
  );
}
add_action( 'init', 'register_my_menus' );

/* --- OVERRIDE WP WYSIWYG IMAGE MARKUP --- */

update_option('image_default_link_type','none');

function attachment_image_link_remove_filter( $content ) {
	$content = preg_replace( '/(width|height)=\"\d*\"\s/', "", $content );
    $content = preg_replace(
		array('{<p><img}','{ /></p>}'),
		array('<div class="image"><img',' onload="imgLoaded(this,true)"/></div>'),
		$content
	);
	
    return $content;
	
}

add_filter( 'the_content', 'attachment_image_link_remove_filter' );

/* --- TRUNCATER --- */

function truncate($string, $length, $stopanywhere=false) {
    //truncates a string to a certain char length, stopping on a word if not specified otherwise.
    if (strlen($string) > $length) {
        //limit hit!
        $string = substr($string,0,($length -3));
        if ($stopanywhere) {
            //stop anywhere
            $string .= '...';
        } else{
            //stop on a word.
            $string = substr($string,0,strrpos($string,' ')).' ...';
        }
    }
    return $string;
};

/* --- PLATFORM DETECTION --- */

function islteIE8(){
    $browserInfo = php_browser_info();
    if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && $browserInfo['majorver'] <= '8')
        return true;
    return false;   
}

function islteIE9(){
    $browserInfo = php_browser_info();
    if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && $browserInfo['majorver'] <= '9')
        return true;
    return false;   
}

function isFF3x(){
	if(isset($_SERVER['HTTP_USER_AGENT'])){
	    $agent = $_SERVER['HTTP_USER_AGENT'];
		if(strlen(strstr($agent,"Gecko")) > 0 && strlen(strstr($agent,"rv:1.9")) > 0){ 
		  return true;
		}
	}
	return false;
}

function isMobile(){
	if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipod')){
	   return true;
	}
	return false;
}

/* --- GET ZONE --- */

function get_zone($id){
	$post = get_post($id);
	$post_title = $post->post_title;
	$post_type = $post->post_type;
	if($post_type == 'page'){
		if(
			(strpos($post_title,'Contact Us') !== false) || 
			(strpos($post_title,'Terms') !== false) ||
			(strpos($post_title,'Privacy') !== false)
		){
			return 'zone-default';	
		} else {
			$parent = $parent = $post->post_parent ? $post->post_parent : $post->ID;
			$parent_title = get_the_title($parent);
			return 'zone-'.strtolower(preg_replace('/\s+/', "-", trim(preg_replace('/[^A-Za-z0-9]/', " ", $parent_title)))); 
		};
	} else {
		if($post_type == 'experiences'){
			return 'zone-genomics';
		} elseif($post_type == 'supporters'){
			return 'zone-support-us';
		} elseif($post_type == 'events'){
			return 'zone-education-events';
		} elseif($post_type == 'post'){
			return 'zone-news';
		} elseif($post_type == 'supporters'){
			return 'zone-support-us';
		} elseif($post_type == 'people'){
			return 'zone-people';
		} elseif($post_type == 'jobs'){
			return 'zone-careers';
		};
	};
}

/* --- EXCPERT ELLIPSES --- */

function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* --- DARKEN/LIGHTEN HEX --- */

function hue_2_rgb($v1,$v2,$vh)
{
        if ($vh < 0)
        {
                $vh += 1;
        };

        if ($vh > 1)
        {
                $vh -= 1;
        };

        if ((6 * $vh) < 1)
        {
                return ($v1 + ($v2 - $v1) * 6 * $vh);
        };

        if ((2 * $vh) < 1)
        {
                return ($v2);
        };

        if ((3 * $vh) < 2)
        {
                return ($v1 + ($v2 - $v1) * ((2 / 3 - $vh) * 6));
        };

        return ($v1);
};

function adjust_color($hexcode, $sat, $lum) {
     // $hexcode is the six digit hex colour code we want to convert

	    $redhex  = substr($hexcode,1,2);
	    $greenhex = substr($hexcode,3,2);
	    $bluehex = substr($hexcode,5,2);

	    // $var_r, $var_g and $var_b are the three decimal fractions to be input to our RGB-to-HSL conversion routine

	    $var_r = (hexdec($redhex)) / 255;
	    $var_g = (hexdec($greenhex)) / 255;
	    $var_b = (hexdec($bluehex)) / 255;

	    // Input is $var_r, $var_g and $var_b from above
	    // Output is HSL equivalent as $h, $s and $l — these are again expressed as fractions of 1, like the input values

	    $var_min = min($var_r,$var_g,$var_b);
	    $var_max = max($var_r,$var_g,$var_b);
	    $del_max = $var_max - $var_min;

	    $l = ($var_max + $var_min) / 2;

	    if ($del_max == 0)
	    {
	            $h = 0;
	            $s = 0;
	    }
	    else
	    {
	            if ($l < 0.5)
	            {
	                    $s = $del_max / ($var_max + $var_min);
	            }
	            else
	            {
	                    $s = $del_max / (2 - $var_max - $var_min);
	            };

	            $del_r = ((($var_max - $var_r) / 6) + ($del_max / 2)) / $del_max;
	            $del_g = ((($var_max - $var_g) / 6) + ($del_max / 2)) / $del_max;
	            $del_b = ((($var_max - $var_b) / 6) + ($del_max / 2)) / $del_max;

	            if ($var_r == $var_max)
	            {
	                    $h = $del_b - $del_g;
	            }
	            elseif ($var_g == $var_max)
	            {
	                    $h = (1 / 3) + $del_r - $del_b;
	            }
	            elseif ($var_b == $var_max)
	            {
	                    $h = (2 / 3) + $del_g - $del_r;
	            };

	            if ($h < 0)
	            {
	                    $h += 1;
	            };

	            if ($h > 1)
	            {
	                    $h -= 1;
	            };
	    };


	    // Calculate new sat and lum

	    $s2 = $s * $sat > 1 ? 1 : $s * $sat;
		$l2 = $l * $lum > 1 ? 1 : $l * $lum;

	       // Input is HSL value of complementary colour, held in $h2, $s, $l as fractions of 1
	       // Output is RGB in normal 255 255 255 format, held in $r, $g, $b
	       // Hue is converted using function hue_2_rgb, shown at the end of this code

	        if ($s2 == 0)
	        {
	                $r = $l2 * 255;
	                $g = $l2 * 255;
	                $b = $l2 * 255;
	        }
	        else
	        {
	                if ($l2 < 0.5)
	                {
	                        $var_2 = $l2 * (1 + $s2);
	                }
	                else
	                {
	                        $var_2 = ($l2 + $s2) - ($s2 * $l2);
	                };

	                $var_1 = 2 * $l2 - $var_2;
	                $r = 255 * hue_2_rgb($var_1,$var_2,$h + (1 / 3));
	                $g = 255 * hue_2_rgb($var_1,$var_2,$h);
	                $b = 255 * hue_2_rgb($var_1,$var_2,$h - (1 / 3));
	        };

	        $rhex = sprintf("%02X",round($r));
	        $ghex = sprintf("%02X",round($g));
	        $bhex = sprintf("%02X",round($b));

	        $rgbhex = $rhex.$ghex.$bhex;

			return '#'.$rgbhex;
};

// AJAX POSTS

add_action('wp_ajax_nygc_ajax_posts', 'nygc_ajax_posts');
add_action('wp_ajax_nopriv_nygc_ajax_posts', 'nygc_ajax_posts');

function nygc_ajax_posts(){

	// Validate Nonce
	
	//if (! isset( $_POST['nonce'] ) ) die('denied');
	//if (! wp_verify_nonce( $_POST['nonce'], 'get-posts-nonce' ) ) die('denied');
	
	$today = date('Ymd');
	
	// Pull Query Variables

	$number_of_posts = $_POST['number_of_posts'];
	$paged = $_POST['paged'];
	$post_type = $_POST['post_type'];
	$type = $_POST['type'];
	$cat = $_POST['category'] == 'all' ? null : $_POST['category'];
	$startdate = $_POST['startdate'] ? $_POST['startdate'] : $today;
	
	// Query Posts
	
	// IF EVENTS
	
	if($post_type == 'events'):
	
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $number_of_posts,
			'event-types' => $cat,
			'meta_key' => 'event_date',
			'orderby' => 'meta_value',
			'order' => $type == 'upcoming' ? 'asc' : 'desc',
			'paged'=> $paged, 
			'meta_query' => array(
				array(
					'key' => 'event_end_date',
					'value' => $startdate,
					'compare' => $type == 'upcoming' ? '>=' : '<'
				)
			)
		);
	
		$query_posts = new WP_Query($args);
	
		while ($query_posts->have_posts()) :
			$query_posts->the_post();
			$id = get_the_ID();
			$serieses = get_field('event_series');
			$series_name = null;
			if($serieses):
			foreach($serieses as $series):
				$series_name = get_the_title($series->ID);
			endforeach;
			endif;
			$date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
			$end_date_obj = DateTime::createFromFormat('Ymd', get_field('event_end_date'));
			$date = $date_obj->format('Y-m-d');
			$categories = get_the_terms($post->ID, 'event-types');
			$category = array_shift(array_values($categories));
			$name = $category->name;
			$slug = $category->slug;
			$time;
			
			if(get_field('event_is_multiday') == 'true'):
				$end_date_obj = DateTime::createFromFormat('Ymd', get_field('event_end_date'));
				if($date_obj->format('F') == $end_date_obj->format('F')):
					$time = $date_obj->format('F j').' - '.$end_date_obj->format('j, Y');
				else:
					$time = $date_obj->format('F j').' - '.$end_date_obj->format('F j, Y');
				endif;
			else:	
				$time = get_field('event_time'); 
			endif;
			
			$title = truncate(get_the_title(), 80);
			$jsonposts[$id] = array(
				'title' => $title,
				'permalink' => apply_filters('the_permalink', get_permalink()),
				'categoryName' => $name,
				'categorySlug' => $slug,
				'date1' => $date_obj->format('D. M'),
				'date2' => $date_obj->format('d'),
				'location' => get_field('event_location'),
				'time' => $time,
				'series' => $series_name,
				'image' => get_field('image'),
				'imageAlign' => get_field('image_alignment')
	 		);
		endwhile;
	
		wp_reset_postdata();
	
	else:
		
	// ELSE BLOG
	
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $number_of_posts,
			'category_name' => $cat,
			'paged'=> $paged
		);
		
		$query_posts = new WP_Query($args);
		
		while ($query_posts->have_posts()) :
			$query_posts->the_post();
			
			$title = truncate(get_the_title(), 80);
			
			$jsonposts[$id] = array(
				'type' => 'blog',
				'title' => $title,
				'permalink' => apply_filters('the_permalink', get_permalink()),
				'categoryName' => $cat,
				'date' => get_the_time('F j, Y'),
				'authorName' => get_field('author_name'),
				'image' => get_field('image'),
				'imageAlign' => get_field('image_alignment')
	 		);
			
	
		endwhile;

		wp_reset_postdata();
		
	
	endif;
	
	$jsonposts = array_values($jsonposts);
	
	echo json_encode($jsonposts);
	
	die();
}

// BUILD CALENDAR

function build_calendar($dayOf,$month,$year,$length = 0) {

     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('S','M','T','W','T','F','S');

     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = $dateComponents['month'];

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];

     // Create the table tag opener and day headers

     $calendar = "<div class='calendar content wysiwyg'>";
     $calendar .= "<h3>$monthName $year</h3><table>";
     $calendar .= "<thead><tr>";

     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th>$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;
	 $multiDayCounter = 0;

     $calendar .= "</tr></thead><tbody><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
          $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>"; 
     }
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

	          // Seventh column (Saturday) reached. Start a new row.

	          if ($dayOfWeek == 7) {

	               $dayOfWeek = 0;
	               $calendar .= "</tr><tr>";

	          }

	          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

	          $date = "$year-$month-$currentDayRel";

		  	  if($currentDayRel == $dayOf){  
					$calendar .= "<td class='day highlight' rel='$date'><b>$currentDay</b></td>"; 
					
					if($length > 0 && $multiDayCounter < $length){
						$dayOf++;
						$multiDayCounter++;
					}
			  } else { 
					$calendar .= "<td class='day' rel='$date'>$currentDay</td>"; 
			  }

	          // Increment counters

	          $currentDay++;
	          $dayOfWeek++;

	 }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
          $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 

     }
     
     $calendar .= "</tr>";

     $calendar .= "</tbody></table></div>";

     return $calendar;

}

// ACF WRITE HOOK

function my_acf_save_post($post_id)
{
	$post_obj = get_post($post_id);
	
	if('events' == get_post_type($post_id)): 
		
		//IF NOT MULTIDATE, MAKE END DATE START DATE
		
		if(get_field('event_is_multiday', $post_id) == 'true'):
		
		else:
			
			$startdate = get_field('event_date', $post_id);
			
			update_field('event_end_date', $startdate, $post_id);

		endif;
		
	elseif($post_id == 'options'):
		
		// SAVE COLOR CSS ON OPTIONS WRITE
		
		$path = WP_PLUGIN_DIR.'/nygc-colors';
		$file = 'zone-colors.css';
		
		ob_start();
		
		include_once('zone-colors-print.php');
		
		$css = ob_get_contents();
		ob_end_clean();
		
		file_put_contents($path.'/'.$file, $css);
		
	endif;
}

// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'my_acf_save_post', 20);

// REWRITE SEARCH URL

function search_url_rewrite_rule() {
	if(!empty($_GET['s'])) {
		wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
		exit();
	}	
}
add_action('template_redirect', 'search_url_rewrite_rule');

/* Search Highlighting ********************************************/
// This highlights search terms in both titles, excerpts and content

function search_excerpt_highlight() {
 $excerpt = truncate(get_the_excerpt(), 200);
 $keys = implode('|', explode(' ', get_search_query()));
 $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);

 echo '<p>' . $excerpt . '</p>';
}


function search_title_highlight() {
 $title = get_the_title();
 $keys = implode('|', explode(' ', get_search_query()));
 $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

 echo $title;
}

// BUTTON SHORTCODE

function button_func($atts){
	extract( shortcode_atts( array('title' => '', 'href' => '', 'zone' => ''), $atts ));
	return '<a href="'.$href.'" class="btn zone-'.$zone.'">'.$title.'</a>';
}
add_shortcode( 'button', 'button_func' );

?>