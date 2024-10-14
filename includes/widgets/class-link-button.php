<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Content Box Widget
 */

class Elementor_Link_Button_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA Button";
	}

	public function get_title() {
		return esc_html__( 'HiA Link Button', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'button', 'link', 'url' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_link_button_section_1',
			[
				'label' => esc_html__( 'Button', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_link_button_text',
			[
				'label' 		=> esc_html__( 'Produkt Titel', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder'	=> ''
			]
		);

		$this->add_control(
			'hundimauto_link_button_url',
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
			'hundimauto_link_button_section_2',
			[
				'label' => esc_html__( 'Ausrichtung', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_link_button_alignment',
			[
				'label'		=> esc_html__( 'Ausrichtung', 'plugin-hundimauto' ),
				'type'		=> \Elementor\Controls_Manager::CHOOSE,
				'options'	=> [
					'left'	=> [
						'title'	=> esc_html__( 'Links', 'plugin-hundimauto' ),
						'icon'	=> 'eicon-text-align-left'
					],
					'center'	=> [
						'title'	=> esc_html__( 'Mitte', 'plugin-hundimauto' ),
						'icon'	=> 'eicon-text-align-center'
					],
					'right'	=> [
						'title'	=> esc_html__( 'Rechts', 'plugin-hundimauto' ),
						'icon'	=> 'eicon-text-align-right'
					],
				],
				'default'	=> 'left',
				'toggle'	=> true
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_link_button_section_3',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_link_button_animation',
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
			'hundimauto_link_button_animation_delay',
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

		if ( ! empty( $settings[ 'hundimauto_link_button_url'] ) ) {
			$this->add_link_attributes( 'button_link', $settings['hundimauto_link_button_url'] );
		}

		switch ( $settings['hundimauto_link_button_alignment'] ) {
			case 'left':
				$alignment = ' flex-start';
				break;
			case 'center':
				$alignment = ' flex-center';
				break;
			case 'right':
				$alignment = ' flex-end';
				break;
			default:
				$alignment = ' flex-start';
		}

		if ( $settings['hundimauto_link_button_animation'] !== 'none' ) {
			$os_animation['class'] 	= ' os-animation';
			$os_animation['data']	= ' data-animation="animate__' . $settings['hundimauto_link_button_animation'] . '"';
			$os_animation['delay']	= ' data-delay="' . $settings['hundimauto_link_button_animation_delay'] . 'ms"';
		}

		?>
		<div class="button-wrapper<?php echo $alignment; ?><?php echo $os_animation['class']; ?>"<?php echo $os_animation['data']; ?><?php echo $os_animation['delay']; ?>><a <?php $this->print_render_attribute_string( 'button_link' ); ?> class="btn btn-primary"><?php echo $settings[ 'hundimauto_link_button_text' ]; ?></a></div>
		<?php
	}

	protected function _content_template() {}
}
?>