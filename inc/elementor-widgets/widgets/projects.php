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
 * Jony projects Contents section widget.
 *
 * @since 1.0
 */
class Jony_Projects extends Widget_Base {

	public function get_name() {
		return 'jony-projects';
	}

	public function get_title() {
		return __( 'Projects', 'jony-companion' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'jony-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  projects contents  ------------------------------
		$this->start_controls_section(
			'projects_content',
			[
				'label' => __( 'Projects Contents', 'jony-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label'         => __( 'Section Title', 'jony-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'My Works', 'jony-companion' )
            ]
        );
        $this->add_control(
            'project_order',
            [
                'label'         => __( 'Project Order', 'jony-companion' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_block'   => true,
                'label_on' => __( 'DESC', 'jony-companion' ),
				'label_off' => __( 'ASC', 'jony-companion' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label'         => __( 'Button Title', 'jony-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'More Works', 'jony-companion' )
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label'         => __( 'Button URL', 'jony-companion' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
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
    $project_order = !empty( $settings['project_order'] ) ? $settings['project_order'] : '';
    $project_order = $project_order == 'yes' ? 'DESC' : 'ASC';
    $btn_title  = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url  = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <!-- gallery_area start  -->
    <div class="gallery_area">
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
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <div class="row">
                        <?php
                            jony_get_projects( $project_order );
                        ?>
                    </div>
                    <?php
                        if ( $btn_title ) {
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="more_works">
                                        <a class="boxed-btn3-line" href="<?php echo esc_url( $btn_url )?>"><?php echo esc_html( $btn_title )?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    }
}
