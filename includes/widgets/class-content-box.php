<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Content Box Widget
 */

class Elementor_Content_Box_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA Content Box";
	}

	public function get_title() {
		return esc_html__( 'HiA Content Box', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'content', 'text', 'content box' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_content_box_section_1',
			[
				'label' => esc_html__( 'Inhalt', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_content_box_text',
			[
				'label' 		=> esc_html__( 'Text Editor', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::WYSIWYG,
				'default'		=> '',
				'placeholder'	=> ''
			]
		);

		$this->add_control(
			'hundimauto_content_box_style',
			[
				'label' 		=> esc_html__( 'Stil', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'					=> esc_html__( 'None', 'plugin-hundimauto' ),
					'bg-section-light'		=> esc_html__( 'Hellgrauer Kasten', 'plugin-hundimauto' ),
					'bg-section-brown'		=> esc_html__( 'Hellbrauner Kasten', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_content_box_section_2',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_content_box_animation',
			[
				'label' 		=> esc_html__( 'Stil', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'					=> esc_html__( 'None', 'plugin-hundimauto' ),
					'fadeIn'				=> esc_html__( 'fadeIn', 'plugin-hundimauto' ),
					'fadeInUp'				=> esc_html__( 'fadeInUp', 'plugin-hundimauto' ),
					'fadeInUpBig'			=> esc_html__( 'fadeInUpBig', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->add_control(
			'hundimauto_content_box_animation_delay',
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

		if ( $settings['hundimauto_content_box_animation'] !== 'none' ) {
			$os_animation['class'] 	= ' os-animation';
			$os_animation['data']	= ' data-animation="animate__' . $settings['hundimauto_content_box_animation'] . '"';
			$os_animation['delay']	= ' data-delay="' . $settings['hundimauto_content_box_animation_delay'] . 'ms"';
		}

		?>
		<div class="content-box<?php echo $os_animation['class']; ?>"<?php echo $os_animation['data']; ?><?php echo $os_animation['delay']; ?>>
			<?php if ( $settings['hundimauto_content_box_style'] !== 'none' ) {
				?><div class="<?php echo $settings['hundimauto_content_box_style']; ?>"><?php }	?>
				<?php echo $settings['hundimauto_content_box_text']; ?>
			<?php if ( $settings['hundimauto_content_box_style'] !== 'none' ) { ?></div><?php } ?>
		</div>
		<?php
	}

	protected function _content_template() {}
}
?>