<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * @Packge     : Jony Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author     URI : http://colorlib.com/wp/
 *
 */


/*===========================================================
	Get elementor templates
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

// Section Heading
function jony_section_heading( $title = '', $subtitle = '' ) {
	if( $title || $subtitle ) :
	?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading text-center">
						<?php
						// Sub title
						if ( $subtitle ) {
							echo '<p>' . esc_html( $subtitle ) . '</p>';
						}
						// Title
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'jony_companion_frontend_scripts', 99 );
function jony_companion_frontend_scripts() {

	wp_enqueue_script( 'jony-companion-script', plugins_url( '../js/loadmore-ajax.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jony-common-js', plugins_url( '../js/common.js', __FILE__ ), array( 'jquery' ), '1.0', true );

}
// 
add_action( 'wp_ajax_jony_portfolio_ajax', 'jony_portfolio_ajax' );

add_action( 'wp_ajax_nopriv_jony_portfolio_ajax', 'jony_portfolio_ajax' );
function jony_portfolio_ajax( ){

	ob_start();

	if( !empty( $_POST['elsettings'] ) ):


		$items = array_slice( $_POST['elsettings'], $_POST['postNumber'] );

	    $i = 0;
	    foreach( $items as $val ):

	    $tagclass = sanitize_title_with_dashes( $val['label'] );
	    $i++;
	?>
	<div class="single_gallery_item <?php echo esc_attr( $tagclass ); ?>">
	    <?php 
	    if( !empty( $val['img']['url'] ) ){
	        echo '<img src="'.esc_url( $val['img']['url'] ).'" />';
	    }
	    ?>
	    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
	        <div class="port-hover-text text-center">
	            <?php 
	            if( !empty( $val['title'] ) ){
	                echo jony_heading_tag(
	                    array(
	                        'tag'  => 'h4',
	                        'text' => esc_html( $val['title'] )
	                    )
	                );
	            }

	            if( !empty( $val['sub-title-url'] ) &&  !empty( $val['sub-title'] ) ){
	                echo '<a href="'.esc_url( $val['sub-title-url'] ).'">'.esc_html( $val['sub-title'] ).'</a>';
	            }else{
	                echo '<p>'.esc_html( $val['sub-title'] ).'</p>';
	            }
	            ?>
	            
	        </div>
	    </div>
	</div>

	<?php 

	if( !empty( $_POST['postIncrNumber'] ) ){

	    if( $i == $_POST['postIncrNumber'] ){
	        break;
	    }
	}
	    endforeach;
	endif;
	echo ob_get_clean();
	die();
}

	// Update the post/page by your arguments
	function jony_update_the_followed_post_page_status( $title = 'Hello world!', $type = 'post', $status = 'draft', $message = false ){

		// Get the post/page by title
		$target_post_id = get_page_by_title( $title, OBJECT, $type);

		// Post/page arguments
		$target_post = array(
			'ID'    => $target_post_id->ID,
			'post_status'   => $type,
		);

		if ( $message == true ) {
			// Update the post/page
			$update_status = wp_update_post( $target_post, true );
		} else {
			// Update the post/page
			$update_status = wp_update_post( $target_post, false );
		}

		return $update_status;
	}


	
// Project - Custom Post Type
function project_custom_posts() {	
	$labels = array(
		'name'               => _x( 'Project', 'post type general name', 'jony-companion' ),
		'singular_name'      => _x( 'Project', 'post type singular name', 'jony-companion' ),
		'menu_name'          => _x( 'Projects', 'admin menu', 'jony-companion' ),
		'name_admin_bar'     => _x( 'Projects', 'add new on admin bar', 'jony-companion' ),
		'add_new'            => _x( 'Add New', 'jony', 'jony-companion' ),
		'add_new_item'       => __( 'Add New Project', 'jony-companion' ),
		'new_item'           => __( 'New Project', 'jony-companion' ),
		'edit_item'          => __( 'Edit Project', 'jony-companion' ),
		'view_item'          => __( 'View Project', 'jony-companion' ),
		'all_items'          => __( 'All Projects', 'jony-companion' ),
		'search_items'       => __( 'Search Project', 'jony-companion' ),
		'parent_item_colon'  => __( 'Parent Project:', 'jony-companion' ),
		'not_found'          => __( 'No Project found.', 'jony-companion' ),
		'not_found_in_trash' => __( 'No Project found in Trash.', 'jony-companion' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'jony-companion' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		// 'menu_icon' 		 => 'dashicons-store',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'project' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'project', $args );

}
add_action( 'init', 'project_custom_posts' );

/*=========================================================
    Project Section
========================================================*/
function jony_get_projects( $project_order = 'DESC' ){ 
	$projects = new WP_Query( array(
		'post_type' => 'project',
		'posts_per_page' => 4,
		'order'		=> $project_order
	) );

	function jony_get_single_project( $project_img, $project_type ){
		?>
		<div class="single_gallery">
			<?php
				if( $project_img ) {
					?>
					<div class="thumb">
						<?php echo $project_img?>
					</div>
					<?php
				}
			?>
			<div class="gallery_heading">
				<?php 
				if ($project_type!='') {
					echo '<span>'.esc_html($project_type).'</span>';
				}
				?>
				<a href="<?php the_permalink()?>"><h4><?php the_title()?></h4></a>
			</div>
		</div>
		<?php
	}

	$count = 0;
	if( $projects->have_posts() ) {
		echo '<div class="col-xl-6 col-lg-6 col-md-6">';
			while ( $projects->have_posts() ) {
				$projects->the_post();			
				$portfolio_grid = jony_meta( 'portfolio-grid' ) == 1 ? 'jony_portfolio_img_445x394' : 'jony_portfolio_img_445x553';
				$project_img = get_the_post_thumbnail( get_the_ID(), $portfolio_grid, '', array( 'alt' => get_the_title() ) );
				$project_type = !empty( jony_meta( 'project_type' ) ) ? jony_meta( 'project_type' ) : '';
				$count++;
				if ( $count == 3 ) {
					echo '</div>';
					echo '<div class="col-xl-6 col-lg-6 col-md-6">';
				}
				jony_get_single_project( $project_img, $project_type );
			}
		echo '</div>';
	}
}
