<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Page Title Widget
 */

class Elementor_Page_Title_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA Page Title";
	}

	public function get_title() {
		return esc_html__( 'HiA Page Title', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-archive-title';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'header', 'title', 'page' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_page_title_section_1',
			[
				'label' => esc_html__( 'Inhalt', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_page_title_content',
			[
				'label' 		=> esc_html__( 'Titel', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::WYSIWYG,
				'default'		=> '',
				'placeholder'	=> ''
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_page_title_section_2',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_page_title_animation',
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
			'hundimauto_page_title_animation_delay',
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

		if ( empty( $settings['hundimauto_page_title_content'] ) ) {
			return;
		}

		if ( $settings['hundimauto_page_title_animation'] !== 'none' ) {
			$os_animation['class'] 	= ' os-animation';
			$os_animation['data']	= ' data-animation="animate__' . $settings['hundimauto_page_title_animation'] . '"';
			$os_animation['delay']	= ' data-delay="' . $settings['hundimauto_page_title_animation_delay'] . 'ms"';
		}

		?><div class="page-title<?php echo $os_animation['class']; ?>"<?php echo $os_animation['data']; ?><?php echo $os_animation['delay']; ?>>
			<hgroup>
				<?php echo $settings['hundimauto_page_title_content']; ?>
			</hgroup>
		</div>
		<?php
	}
	
	protected function _content_template() {}
}
?>