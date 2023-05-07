<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://kiranpotphode.com/
 * @since      1.0.0
 *
 * @package    Easy_Image_Filters
 * @subpackage Easy_Image_Filters/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Image_Filters
 * @subpackage Easy_Image_Filters/admin
 * @author     Kiran Potphode <kiranpotphode15@gmail.com>
 */
class Easy_Image_Filters_Admin {

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
		$this->version = $version;

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
		 * defined in Easy_Image_Filters_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Image_Filters_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 global $pagenow, $typenow;

		 if( $pagenow === 'upload.php' ){

			if( isset( $_GET['page'] ) && 'easy-image-filters-page' == $_GET['page'] ){
				wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-image-filters-admin.css', array(), $this->version, 'all' );
				wp_enqueue_style( 'material-css', plugin_dir_url( __FILE__ ) . 'css/material.min.css', array(), $this->version, 'all' );
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
		 * defined in Easy_Image_Filters_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Image_Filters_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $pagenow, $typenow;

		if( $pagenow === 'upload.php' ){

			if( isset( $_GET['page'] ) && 'easy-image-filters-page' == $_GET['page'] ){
				wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easy-image-filters-admin.js', array( 'jquery' ), $this->version, false );
				wp_enqueue_script( 'caman-js', plugin_dir_url( __FILE__ ) . 'js/caman.full.min.js', array( 'jquery' ), $this->version, true );
				wp_enqueue_script( 'material-js', plugin_dir_url( __FILE__ ) . 'js/material.min.js', array( 'jquery' ), $this->version, false );

				$translation_array = array(
					'eif_ajax_nonce' => wp_create_nonce( 'eif-ajax-nonce' ),
				);

				wp_localize_script( $this->plugin_name, 'eif_js_obj', $translation_array );
			}

		}

	}

	/**
	 * Init
	 */
	public function init(){
		add_action('wp_ajax_eif_save_image', array( $this,'easy_image_filters_save_image_ajax_callback') );
	}

	/**
	 * attachment_fields_to_edit
	 */
	public function easy_image_filters_attachment_fields_to_edit( $form_fields, $post ){
		if( $post->post_mime_type == 'image/jpeg' || $post->post_mime_type == 'image/jpg' || $post->post_mime_type == 'image/png' ){
			$form_fields['eif-apply-filter-sbutton'] = array(
				'label' => __('Add Image effects', 'easy-image-filters'),
				'input' => 'html',
				'helps' => __('Apply filter effects to image.', 'easy-image-filters'),
				'html' => '<a class="button easy-image-filters-button" href="'.admin_url('upload.php?page=easy-image-filters-page').'&attachment_id='.$post->ID.'">'.__('Add','easy-image-filters').'</a>',
			);
		}
		return $form_fields;
	}

	/**
	 *
	 */
	public function easy_image_filters_admin_menu(){
		add_submenu_page( 'upload.php', __('Easy Image Filters', 'easy-image-filters'), __('Easy Image Filters','easy-image-filters'), 'manage_options', 'easy-image-filters-page', array($this, 'easy_image_filters_page_callback') );
		remove_submenu_page( 'upload.php', 'easy-image-filters-page' );
	}

	public function easy_image_filters_page_callback() {

		require_once plugin_dir_path( __FILE__ ) . 'partials/easy-image-filters-admin-display.php';

	}

	public function easy_image_filters_save_image_ajax_callback() {

		check_ajax_referer( 'eif-ajax-nonce', '_nonce_check' );

		$uploads       = wp_upload_dir();
		$filetype_info = wp_check_filetype( $_POST['old_image'] );
		$file_type     = $filetype_info['type'];
		$file_ext      = $filetype_info['ext'];
		$data          = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['new_image']));
		$filename      = basename( $_POST['old_image'] );
		$filename      = wp_unique_filename( $uploads['path'], $filename );
		$saved_file    = file_put_contents($uploads['path'] . "/" .$filename, $data);

		$attachment = array(
			'post_mime_type' => $file_type,
			'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
			'post_content' => '',
			'post_status' => 'inherit',
			'guid' => $uploads['url'] . "/" .$filename
		);

		$attach_id = wp_insert_attachment( $attachment, $uploads['url'] . "/" . $filename, 0 );
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $uploads['path'] . "/" . $filename );
		$success = wp_update_attachment_metadata( $attach_id,  $attach_data );

		if( ! empty( $attach_id ) && ! is_wp_error( $attach_id ) ){
			echo add_query_arg( 'item', $attach_id, admin_url('upload.php') );
		}else{
			echo 'error';
		}

		wp_die();

	}

}
