<?php
function jony_page_metabox( $meta_boxes ) {

	$jony_prefix = '_jony_';
	$meta_boxes[] = array(
		'id'        => 'jony_metaboxes',
		'title'     => esc_html__( 'Project Options', 'jony-companion' ),
		'post_types'=> array( 'project' ),
		'priority'  => 'high',
		'context'  => 'side',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'name'    => esc_html__( 'Gird Image Size', 'jony-companion' ),
				'id'      => $jony_prefix . 'portfolio-grid',
				'type'    => 'select',
				'options' => array(
					'0' => 'Select Size',
					'1' => 'Gird Size [445x394]',
					'2' => 'Grid Size [445x553]',
				),
				'inline' => true,
			),			
			array(
				'id'    => $jony_prefix . 'project_type',
				'type'  => 'text',
				'name'  => esc_html__( 'Project Type', 'jony-companion' ),
				'placeholder' => esc_html__( 'Project Type', 'jony-companion' ),
			),			
			array(
				'id'    => $jony_prefix . 'project_url',
				'type'  => 'text',
				'name'  => esc_html__( 'Project URL', 'jony-companion' ),
				'placeholder' => esc_html__( 'Project URL', 'jony-companion' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'jony_page_metabox' );
