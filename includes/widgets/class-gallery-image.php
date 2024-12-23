<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Gallery Image Widget
 */

class Elementor_Gallery_Image_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA Gallery Image";
	}

	public function get_title() {
		return esc_html__( 'HiA Gallery Image', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-image';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'image', 'gallery', 'lightbox' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_gallery_image_section_1',
			[
				'label' => esc_html__( 'Inhalt', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_gallery_image_id',
			[
				'label'			=> esc_html__( 'Bild (empfohlenes Format 1:1)', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::MEDIA,
				'default'		=> [
					'url'		=> \Elementor\Utils::get_placeholder_image_src()
				],
				'description'	=> esc_html__( 'Wichtig: das Format der Bilder sollte innerhalb der Gallerie identisch sein.')
			]
		);

		$this->add_control(
			'hundimauto_gallery_image_caption',
			[
				'label' 		=> esc_html__( 'Beschreibung', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder'	=> ''
			]
		);

		$this->add_control(
			'hundimauto_gallery_image_media_modal_ratio',
			[
				'label' 		=> esc_html__( 'Modal Image Ratio', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> '1x1',
				'options'		=> [
					'1x1'			=> esc_html__( '1:1', 'plugin-hundimauto' ),
					'4x3'			=> esc_html__( '4:3', 'plugin-hundimauto' ),
					'16x9'			=> esc_html__( '16:9', 'plugin-hundimauto' ),
					'21x9'			=> esc_html__( '21:9', 'plugin-hundimauto' ),
				],
				'selectors' => [

				],
				'description'	=> esc_html__( 'Hinweis: Bestimmt das Format des Modals, wenn das Bild geöffnet wird.')
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_gallery_image_section_2',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_gallery_image_animation',
			[
				'label' 		=> esc_html__( 'Stil', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'					=> esc_html__( 'None', 'plugin-hundimauto' ),
					'fadeInUp'				=> esc_html__( 'Fade in Up', 'plugin-hundimauto' ),
					'fadeInLeft'			=> esc_html__( 'Fade in Left', 'plugin-hundimauto' ),
					'fadeInRight'			=> esc_html__( 'Fade in Right', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->add_control(
			'hundimauto_gallery_image_animation_delay',
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

		if ( empty( $settings['hundimauto_gallery_image_id'] ) ) {
			return;
		}

		$imgURL = $settings['hundimauto_gallery_image_id']['url'];
		$imgCaption = $settings['hundimauto_gallery_image_caption'];
		$modalRatio = $settings['hundimauto_gallery_image_media_modal_ratio'];


		if ( $settings['hundimauto_gallery_image_animation'] !== 'none' ) {
			$os_animation['class'] 	= ' os-animation';
			$os_animation['data']	= ' data-animation="animate__' . $settings['hundimauto_gallery_image_animation'] . '"';
			$os_animation['delay']	= ' data-delay="' . $settings['hundimauto_gallery_image_animation_delay'] . 'ms"';
		}

		?>

		<div class="gallery-image overflow-hidden<?php echo $os_animation['class']; ?>"<?php echo $os_animation['data']; ?><?php echo $os_animation['delay']; ?>>
			<a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal" data-media-type="image" data-media-src="<?php echo $imgURL; ?>" data-media-ratio="<?php echo $modalRatio; ?>" data-media-title="<?php echo $imgCaption; ?>"><img src="<?php echo $imgURL; ?>" class="image w-100" alt="<?php echo $imgCaption; ?>"></a>
		</div><?php
	}
	
	protected function _content_template() {}
}
?>