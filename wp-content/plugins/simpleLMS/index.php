<?php
/*
Plugin Name: Simple LMS Plugin
Plugin URI: #
Description: This is a learning management plugin
Version: 1.51
Author: Shaaban fadil
Author URI:#
*/

/* Register post type Courses */

function course_cpt() {
	$labels = array(
		'name'                  => _x( 'Courses', 'Post type general name', 'textdomain' ),
		'singular_name'         => _x( 'Course', 'Post type singular name', 'textdomain' ),
		'menu_name'             => _x( 'Courses', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar'        => _x( 'course', 'Add New on Toolbar', 'textdomain' ),
		'add_new'               => __( 'Add New', 'textdomain' ),
		'add_new_item'          => __( 'Add New Course', 'textdomain' ),
		'new_item'              => __( 'New Course', 'textdomain' ),
		'edit_item'             => __( 'Edit Course', 'textdomain' ),
		'view_item'             => __( 'View Course', 'textdomain' ),
		'all_items'             => __( 'All Courses', 'textdomain' ),
		'search_items'          => __( 'Search courses', 'textdomain' ),
		'parent_item_colon'     => __( 'Parent Courses:', 'textdomain' ),
		'not_found'             => __( 'No Courses found.', 'textdomain' ),
		'not_found_in_trash'    => __( 'No Courses found in Trash.', 'textdomain' ),
		'featured_image'        => _x( 'Course Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'course' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'             => __( 'dashicons-database-view' ),

	);

	register_post_type( 'courses', $args );
	// Insert DB Tables function
	init_db_table();
}

add_action( 'init', 'course_cpt' );

/* Add custom fields*/
    function CF_Courses_Main(){

       add_meta_box( 
		'cf_courses_Id', // ID
       'Course Custom Field', //Title of custom field
       'CF_Courses', // function down below
       'courses', // Custom post type
       'normal', // priority
       'low'// position of field
       ); 
    }

    function CF_Courses(){
		// Include wp_head() function to enque style in head section
		wp_head();

		//Retreive values from database to show values in input fields inside wordpress user interface
		global $wpdb;
		$ID = get_the_id();
		$ourdb = $wpdb->prefix.'lms_course_details';

		$subtitle= $wpdb->get_var("SELECT `subtitle` FROM `$ourdb`
		WHERE `ID` = '".$ID."'");
		$price= $wpdb->get_var("SELECT `price` FROM `$ourdb`
		WHERE `ID` = '".$ID."'");
		$video= $wpdb->get_var("SELECT `video` FROM `$ourdb`
		WHERE `ID` = '".$ID."'");
		$curriculum= $wpdb->get_var("SELECT `content` FROM `$ourdb`
		WHERE `ID` = '".$ID."'");
		


        ?>
		<div class="bg-blue-1">
			<div class="bg-blue-2 col-90 MA center BR">
				<h2>Subtitle</h2>
				<input type="text" name="subtitle" class="col-90 MA" value="<?php echo $subtitle;?>">
			</div>
		</div>
		<div class="bg-blue-1">
			<br>
			<div class="bg-blue-2 col-90 MA center BR">
				<h2>Course Price</h2>
				<input type="text" name="price" class="col-90 MA" value="<?php echo $price;?>">
			</div>
			<br>
		</div>
		<div class="bg-blue-1">
			<br>
			<div class="bg-blue-2 col-90 MA center BR">
				<h3=2>Video Trailer</h3=2>
				<input type="text" name="video" class="col-90 MA" value="<?php echo $video;?>">
			</div>
			<br>
		</div>
		<div class="bg-blue-1">
			<br>
			<div class="bg-blue-2 col-90 MA center BR">
				<h2>Curriculum</h2>
				<input type="text" name="curriculum" class="col-90 MA" value="<?php echo $curriculum;?>">
			</div>
			<br>
		</div>

        <?php
    }

    add_action( 'admin_init', 'CF_Courses_Main');


/* Include CSS files in our plugin*/

function add_style(){
    wp_register_style( 'style', plugin_dir_url(__FILE__).'scripts/style.css' );
    wp_enqueue_style( 'style', plugin_dir_url(__FILE__).'scripts/style.css' );
}
add_action( 'wp_enqueue_scripts', 'add_style');

/**
 * Enqueue scripts and styles.
 */
function wppremium_scripts() {
	wp_enqueue_style( 'style', get_template_directory_uri() .
    '/plugins/simpleLMS/scripts/style.css');
}
add_action( 'wp_enqueue_scripts', 'wppremium_scripts' );


/* Load post_type course template */

function template_course($template){
	// fire global post
	global $post;
	if('courses' === $post->post_type && locate_template(array('template_courses')) !== $template){
		return plugin_dir_path(__FILE__).'templates/template_course.php';
	}
	return $template;
}

add_filter( 'single_template', 'template_course' );

/* Create database table for post_type - Course_details*/
function init_db_table(){
	global $wpdb;
	$database_table_name = $wpdb->prefix."lms_course_details";
	$charset = $wpdb->get_charset_collate;
	$course_det = "CREATE TABLE $database_table_name(
		ID 		int(9) NOT NULL,
		title 	text(100) NOT NULL,
		subtitle text(50) NOT NULL,
		video varchar(100) NOT NULL,
		price int(9) NOT NULL,
		thumbnail text NOT NULL,
		curriculum text NOT NULL,
		PRIMARY KEY (ID)
	)$charset; ";
	/* Rigester table*/
	require_once(ABSPATH.'wp-admin/includes/upgrade.php');
	dbDelta($course_det);
}

register_activation_hook(__FILE__, 'init_db_table');

/* Save course details into database*/
function save_custom_fields(){
	global $wpdb;
	$ID = get_the_ID();
	$title = get_the_title();
	$subtitle = $_POST['subtitle'];
	$price = $_POST['price'];
	$video = $_POST['video'];
	$curriculum = $_POST['content'];

	$wpdb->insert(
		$wpdb->prefix.'lms_course_details',//Database table name
		[
			'ID' =>$ID,	
		]
		);
	$wpdb->update( //Update custom fields in database upon save
		$wpdb->prefix.'lms_course_details',
		[
			'price'=> $price,
			'title'=> $title,
			'subtitle'=>$subtitle,
			'price'=>$price,
			'video' =>$video,
			'content'=>$curriculum,
		],
		['ID'=>$ID,]
	);
}

add_action( 'save_post', 'save_custom_fields');

 