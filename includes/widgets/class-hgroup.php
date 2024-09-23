<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Heading Widget
 */

class Elementor_hGroup_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA hGroup Heading";
	}

	public function get_title() {
		return esc_html__( 'HiA Title Header', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-site-title';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'header', 'title', 'hgroup' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_hgroup',
			[
				'label' => esc_html__( 'H1', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_hgroup_h1_inner',
			[
				'label' 		=> esc_html__( 'H1', 'plugin_hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::WYSIWYG,
				'default'		=> '',
				'placeholder'	=> esc_html__( 'Inhalt für den H1-Titel', 'plugin_hundimauto' )
			]
		);

		$this->add_control(
			'hundimauto_hgroup_h2_inner',
			[
				'label' 		=> esc_html__( 'H2', 'plugin_hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::WYSIWYG,
				'default'		=> '',
				'placeholder'	=> esc_html__( 'Inhalt für den H2-Titel', 'plugin_hundimauto' )
			]
		);

		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['hundimauto_hgroup_h1_inner'] ) ) {
			return;
		}

		print_r($settings);
		?>
<hgroup>
						<h1 class="os-animation" data-animation="animate__fadeInUp" data-delay=".3s"><a href="/">hundimauto.ch</a><span>&nbsp;&ndash;&nbsp;<?php echo $settings['hundimauto_hgroup_h1_inner']; ?></span></h1>
						<h2 class="os-animation" data-animation="animate__fadeInUp" data-delay=".3s">Ihr Ansprechpartner für <a href="#">optimale Transportlösungen</a>, qualitativ <a href="#">hochwertig und fachmännisch</a> hergestellte <a href="#">Hundegitter</a> und <a href="#">Hundeboxen</a> nach Mass für Ihren <strong>HUND</strong> im <strong>AUTO</strong>.</h2>
					</hgroup>
		<?php
	}
	protected function _content_template() {}
}
?>