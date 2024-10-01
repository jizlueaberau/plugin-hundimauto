<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Vimeo Video Widget
 */

class Elementor_LinkBox_Image_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA Link Box Image";
	}

	public function get_title() {
		return esc_html__( 'HiA Link Box Image', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-link';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'image', 'link', 'url', 'box' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_linkbox_image_section_1',
			[
				'label' => esc_html__( 'Inhalt', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_linkbox_image_id',
			[
				'label'			=> esc_html__( 'Bild', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::MEDIA,
				'default'		=> [
					'url'		=> \Elementor\Utils::get_placeholder_image_src()
				]
			]
		);

		$this->add_control(
			'hundimauto_linkbox_image_overlay_text',
			[
				'label' 		=> esc_html__( 'Text', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder'	=> ''
			]
		);

		$this->add_control(
			'hundimauto_linkbox_image_url',
			[
				'label' 		=> esc_html__( 'URL', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::URL,
				'options'		=> [ 'url' ],
				'default'		=> [
					'url'			=> ''
				],
				'label_block'	=> true
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_linkbox_image_section_2',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_linkbox_image_animation',
			[
				'label' 		=> esc_html__( 'Stil', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'					=> esc_html__( 'None', 'plugin-hundimauto' ),
					'bounceInLeft'				=> esc_html__( 'Bounce in Left', 'plugin-hundimauto' ),
					'bounceInRight'				=> esc_html__( 'Bounce in Right', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->add_control(
			'hundimauto_linkbox_image_animation_delay',
			[
				'label'			=> esc_html__( 'Verzögerung in Millisekunden (ms)', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::NUMBER,
				'min'			=> 0,
				'max'			=> 1000,
				'step'			=> 100,
				'default'		=> 0
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$os_animation = [
			'class'		=> '',
			'data'		=> '',
			'delay'		=> ''
		];

		if ( empty( $settings['hundimauto_linkbox_image_id'] ) ) {
			return;
		}

		$imgID = $settings['hundimauto_linkbox_image_id']['id'];

		if ( $settings['hundimauto_linkbox_image_animation'] !== 'none' ) {
			$os_animation['class'] 	= ' os-animation';
			$os_animation['data']	= ' data-animation="animate__' . $settings['hundimauto_linkbox_image_animation'] . '"';
			$os_animation['delay']	= ' data-delay="' . $settings['hundimauto_linkbox_image_animation_delay'] . 'ms"';
		}

		?>

		<div class="link-box overflow-hidden<?php echo $os_animation['class']; ?>"<?php echo $os_animation['data']; ?><?php echo $os_animation['delay']; ?>><?php

		echo wp_get_attachment_image( $imgID, 'full' );

		if ( !empty( $settings['hundimauto_linkbox_image_overlay_text'] ) ) {
			
		?><div class="overlay"><h3><?php 

		if ( !empty( $settings['hundimauto_linkbox_image_url']['url'] ) ) {
			$this->add_link_attributes( 'hundimauto_linkbox_image_url', $settings['hundimauto_linkbox_image_url'] );

		?><a <?php $this->print_render_attribute_string( 'hundimauto_linkbox_image_url' ); ?>><?php

		}

		?><?php echo $settings['hundimauto_linkbox_image_overlay_text']; ?><?php

		if ( !empty( $settings['hundimauto_linkbox_image_url']['url'] ) ) {
		
			?></a><?php

		}

		?></h3></div><?php
		
		}

		?></div><?php
	}
	
	protected function _content_template() {}
}
?>