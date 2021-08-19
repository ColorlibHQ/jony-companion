<?php
namespace Jonyelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Jony elementor hero section widget.
 *
 * @since 1.0
 */
class Jony_Hero extends Widget_Base {

	public function get_name() {
		return 'jony-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'jony-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'jony-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'jony-companion' ),
			]
        );

        $this->add_control(
            'bg_img',
            [
                'label' => esc_html__( 'BG Image', 'jony-companion' ),
                'description' => esc_html__( 'Best size is 1920x900', 'jony-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'first_title',
            [
                'label' => esc_html__( 'First Line', 'jony-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Hi there, I am Jony', 'jony-companion' ),
            ]
        );
        $this->add_control(
            'color_title',
            [
                'label' => esc_html__( 'Colorful Title', 'jony-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Creative Director', 'jony-companion' ),
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'jony-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'View Works', 'jony-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'jony-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'right_sec_separator',
            [
                'label' => esc_html__( 'Personal Image Section', 'jony-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'personal_img',
            [
                'label' => esc_html__( 'Personal Image', 'jony-companion' ),
                'description' => esc_html__( 'Best size is 487x762', 'jony-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
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
			'style_title', [
				'label' => __( 'Style Hero Section', 'jony-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'sub_title_col', [
				'label' => __( 'Sub Title Color', 'jony-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_col', [
				'label' => __( 'Title Color', 'jony-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'after_title_col', [
				'label' => __( 'After Title Color', 'jony-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_bg_col', [
				'label' => __( 'Button BG Color', 'jony-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_hover_col', [
				'label' => __( 'Button Hover Color', 'jony-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3:hover' => 'color: {{VALUE}} !important; border-color: {{VALUE}}; background: transparent',
				],
			]
		);

        $this->add_control(
            'bg_overlay_col_separator',
            [
                'label'     => __( 'Overlay Styles', 'jony-companion' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_overlay_col',
                'label' => __( 'BG Overlay Color', 'jony-companion' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .slider_area .single_slider.overlay::before',
            ]
        );
		$this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $bg_img = !empty( $settings['bg_img']['url'] ) ? $settings['bg_img']['url'] : '';
    $first_title = !empty( $settings['first_title'] ) ? $settings['first_title'] : '';
    $color_title = !empty( $settings['color_title'] ) ? $settings['color_title'] : '';
    $btn_title = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    $personal_img = !empty( $settings['personal_img']['id'] ) ? wp_get_attachment_image( $settings['personal_img']['id'], 'jony_personal_img_487x762', '', array('alt' => jony_image_alt( $settings['personal_img']['url'] ) ) ) : '';
    ?>

        <!-- slider_area_start -->
        <div class="slider_area">
        <div class="single_slider d-flex align-items-center" <?php echo jony_inline_bg_img( esc_url( $bg_img ) ); ?>>
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-lg-9">
                        <div class="slider_text">
                            <?php 
                                if ( $first_title ) { 
                                    echo '<h3>'.esc_html( $first_title ).($color_title ? '<br> <span>'.esc_html($color_title).'</span>' : '').'</h3>';
                                }
                                if ( $btn_title ) { 
                                    echo '<a class="boxed-btn3-line" href="'.esc_url($btn_url).'">'.esc_html($btn_title).'</a>';
                                }                                            
                            ?>
                        </div>
                    </div>
                    <div class="my_img d-none d-lg-block">
                        <?php 
                            if ( $personal_img ) { 
                                echo $personal_img;
                            }                                         
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->
    <?php
    } 
}