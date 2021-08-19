<?php
namespace Jonyelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Jony services Contents section widget.
 *
 * @since 1.0
 */
class Jony_Services extends Widget_Base {

	public function get_name() {
		return 'jony-services';
	}

	public function get_title() {
		return __( 'Services', 'jony-companion' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'jony-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  services contents  ------------------------------
		$this->start_controls_section(
			'services_content',
			[
				'label' => __( 'Services Contents', 'jony-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label'         => __( 'Section Title', 'jony-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'My Services', 'jony-companion' )
            ]
        );
		$this->add_control(
            'services', [
                'label' => __( 'Create New', 'jony-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'item_icon',
                        'label' => __( 'Select Icon', 'jony-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::SELECT,
                        'options' => jony_themify_icon(),
                        'default' => '',
                    ],
                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'jony-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Web & Mobile Design', 'jony-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Text', 'jony-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Sed eleifend sed nibh nec fringilla. Donec eu cursus sem vitae tristique ante ibero', 'jony-companion' ),
                    ],
                ],
                'default'   => [
                    [
                        'item_icon'        => 'webdesign-icon',
                        'item_title'        => __( 'Web & Mobile Design', 'jony-companion' ),
                        'text' => __( 'Sed eleifend sed nibh nec fringilla. Donec eu cursus sem vitae tristique ante ibero', 'jony-companion' ),
                    ],
                    [
                        'item_icon'        => 'development-icon',
                        'item_title'        => __( 'Web Development', 'jony-companion' ),
                        'text' => __( 'Sed eleifend sed nibh nec fringilla. Donec eu cursus sem vitae tristique ante ibero', 'jony-companion' ),
                    ],
                    [
                        'item_icon'        => 'ecommerce-icon',
                        'item_title'        => __( 'E-commerce', 'jony-companion' ),
                        'text' => __( 'Sed eleifend sed nibh nec fringilla. Donec eu cursus sem vitae tristique ante ibero', 'jony-companion' ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_team_member', [
                'label' => __( 'Style Member Section', 'jony-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_title_col', [
                'label' => __( 'Section Title Color', 'jony-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'jony-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .section_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        
        $this->add_control(
            'single_item_styles_seperator',
            [
                'label' => esc_html__( 'Single Item Styles', 'jony-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'item_title_color', [
                'label' => __( 'Title Color', 'jony-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .single_team .team_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'item_text_color', [
                'label' => __( 'Text Color', 'jony-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .single_team .team_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $services  = !empty( $settings['services'] ) ? $settings['services'] : '';
    ?>

    <!-- service_area start  -->
    <div class="service_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-50">
                        <?php
                            if ( $sec_title ) {
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if( is_array( $services ) && count( $services ) > 0 ){
                    foreach ( $services as $item ) {
                        $item_icon = !empty( $item['item_icon'] ) ? JONY_DIR_ICON_IMG_URI . $item['item_icon'] . '.svg' : '';
                        $item_title = !empty( $item['item_title'] ) ? $item['item_title'] : '';
                        $text = !empty( $item['text'] ) ? $item['text'] : '';
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_service text-center">
                                <?php
                                    if ( $item_icon ) {
                                        echo '
                                        <div class="icon">
                                            <img src="'.esc_url( $item_icon ).'" alt="'.esc_attr( $item_title ).'">
                                        </div>
                                        ';
                                    }
                                    if ( $item_title ) {
                                        echo '<h3>'.esc_html( $item_title ).'</h3>';
                                    }
                                    if ( $text ) {
                                        echo '<p>'.wp_kses_post( $text ).'</p>';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- service_area_end  -->
    <?php

    }
}
