<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Product Item Widget
 */

class Elementor_Product_Item_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA Product Item";
	}

	public function get_title() {
		return esc_html__( 'HiA Product Item', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-image';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'image', 'product', 'item' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_product_item_section_1',
			[
				'label' => esc_html__( 'Inhalt', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_product_item_id',
			[
				'label'			=> esc_html__( 'Bild (Format offen)', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::MEDIA,
				'default'		=> [
					'url'		=> \Elementor\Utils::get_placeholder_image_src()
				],
				'description'	=> esc_html__( '' )
			]
		);

		$this->add_control(
			'hundimauto_product_item_info_titel',
			[
				'label' 		=> esc_html__( 'Produkt Titel', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder'	=> ''
			]
		);

		$this->add_control(
			'hundimauto_product_item_info_text',
			[
				'label' 		=> esc_html__( 'Produkt Beschreibung', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::WYSIWYG,
				'default'		=> '',
				'placeholder'	=> ''
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_product_item_section_2',
			[
				'label' => esc_html__( 'Ausrichtung', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_product_item_alignment',
			[
				'label'		=> esc_html__( 'Ausrichtung', 'plugin-hundimauto' ),
				'type'		=> \Elementor\Controls_Manager::CHOOSE,
				'options'	=> [
					'left'	=> [
						'title'	=> esc_html__( 'Bild Links', 'plugin-hundimauto' ),
						'icon'	=> 'eicon-text-align-left'
					],
					'right'	=> [
						'title'	=> esc_html__( 'Bild Rechts', 'plugin-hundimauto' ),
						'icon'	=> 'eicon-text-align-right'
					],
				],
				'default'	=> 'left',
				'toggle'	=> true
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_product_item_section_3',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_product_item_animation_image',
			[
				'label' 		=> esc_html__( 'Animation Bild', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'				=> esc_html__( 'None', 'plugin-hundimauto' ),
					'fadeInUp'			=> esc_html__( 'Fade in Up', 'plugin-hundimauto' ),
					'fadeInSide'		=> esc_html__( 'Fade in Side', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->add_control(
			'hundimauto_product_item_animation_image_delay',
			[
				'label'			=> esc_html__( 'Verzögerung in Millisekunden (ms)', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::NUMBER,
				'min'			=> 0,
				'max'			=> 1000,
				'step'			=> 100,
				'default'		=> 0
			]
		);
		$this->add_control(
			'hundimauto_product_item_animation_text',
			[
				'label' 		=> esc_html__( 'Animation Produkt Beschreibung', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'				=> esc_html__( 'None', 'plugin-hundimauto' ),
					'fadeInUp'			=> esc_html__( 'Fade in Up', 'plugin-hundimauto' ),
					'fadeInSide'		=> esc_html__( 'Fade in Side', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->add_control(
			'hundimauto_product_item_animation_text_delay',
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

		$this->start_controls_section(
			'hundimauto_product_item_section_4',
			[
				'label' => esc_html__( 'Media Modal', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_product_item_media_modal_type',
			[
				'label' 		=> esc_html__( 'Medien Typ', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'				=> esc_html__( 'None', 'plugin-hundimauto' ),
					'image'				=> esc_html__( 'Bild', 'plugin-hundimauto' ),
					'vimeo'				=> esc_html__( 'Vimeo', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->add_control(
			'hundimauto_product_item_media_modal_ratio',
			[
				'label' 		=> esc_html__( 'Bild / Video Ratio', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'default'		=> 'none',
				'options'		=> [
					'none'					=> esc_html__( 'None', 'plugin-hundimauto' ),
					'1x1'				=> esc_html__( '1:1', 'plugin-hundimauto' ),
					'4x3'				=> esc_html__( '4:3', 'plugin-hundimauto' ),
					'16x9'			=> esc_html__( '16:9', 'plugin-hundimauto' ),
					'21x9'			=> esc_html__( '21:9', 'plugin-hundimauto' ),
				],
				'selectors' => [

				]
			]
		);

		$this->add_control(
			'hundimauto_product_item_media_modal_title',
			[
				'label'			=> esc_html( 'Titel', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder' 	=> ''
			]
		);

		$this->add_control(
			'hundimauto_product_item_media_modal_id',
			[
				'label'			=> esc_html__( 'Bild', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::MEDIA,
				'default'		=> [
					'url'		=> \Elementor\Utils::get_placeholder_image_src()
				],
				'description'	=> esc_html__( 'Das Bild wird automatisch anhand des Formats zentriert dargestellt.', 'plugin-hundimauto' )
			]
		);

		$this->add_control(
			'hundimauto_product_item_media_modal_vimeo_id',
			[
				'label'			=> esc_html( 'Vimeo Video ID', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '',
				'placeholder' 	=> esc_html__( 'z. B. 1001908180', 'plugin-hundimauto' ),
				'description'	=> esc_html__( 'Das Vimeo Video Format beträgt normalerweise 16:9', 'plugin-hundimauto' )
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$os_animation = [
			'image-item' => [
				'class'		=> '',
				'data'		=> '',
				'delay'		=> ''
			],
			'text-item' => [
				'class'		=> '',
				'data'		=> '',
				'delay'		=> ''
			]
		];

		$imgID = $settings['hundimauto_product_item_id']['id'];

		switch ( $settings['hundimauto_product_item_alignment'] ) {
			case 'left':
				$alignment = ' alignment-left';
				break;
			case 'right':
				$alignment = ' alignment-right';
				break;
			default:
				$alignment = ' alignment-left';
		}

		if ( $settings['hundimauto_product_item_animation_image'] != 'none' ) {
			// enable animation on image item
			$os_animation['image-item']['class'] 	= ' os-animation';
			$os_animation['image-item']['delay']	= ' data-delay="' . $settings['hundimauto_product_item_animation_image_delay'] . 'ms"';
			// checking animation type side and match alignment
			if ( $settings['hundimauto_product_item_animation_image'] == 'fadeInSide' ) {
				$os_animation['image-item']['data'] = ( $settings['hundimauto_product_item_alignment'] == 'right' ) ? ' data-animation="animate__fadeInRight"' : ' data-animation="animate__fadeInLeft"';
			} else {
				$os_animation['image-item']['data']	= ' data-animation="animate__fadeInUp"';
			}
		}

		if ( $settings['hundimauto_product_item_animation_text'] != 'none' ) {
			// enable animation on image item
			$os_animation['text-item']['class'] 	= ' os-animation';
			$os_animation['text-item']['delay']		= ' data-delay="' . $settings['hundimauto_product_item_animation_text_delay'] . 'ms"';
			// checking animation type side and match alignment
			if ( $settings['hundimauto_product_item_animation_text'] == 'fadeInSide' ) {
				$os_animation['text-item']['data'] = ( $settings['hundimauto_product_item_alignment'] == 'right' ) ? ' data-animation="animate__fadeInLeft"' : ' data-animation="animate__fadeInRight"';
			} else {
				$os_animation['text-item']['data']	= ' data-animation="animate__fadeInUp"';
			}
		}
		?>

			<article class="product-item <?php echo $alignment; ?>">
				<div class="product-image<?php echo $os_animation['image-item']['class']; ?>"<?php echo $os_animation['image-item']['data']; ?><?php echo $os_animation['image-item']['delay']; ?>>
					<div class="box"><div><?php
					if ( $settings['hundimauto_product_item_media_modal_type'] != 'none' ) {
						$dataMediaSource = ( $settings['hundimauto_product_item_media_modal_type'] == 'image' ) ? $settings['hundimauto_product_item_media_modal_id']['url'] : $settings['hundimauto_product_item_media_modal_vimeo_id'];

						?><a href="#" name="<?php echo strtolower( str_replace( ' ', '', $settings[ 'hundimauto_product_item_info_titel' ] ) ); ?>" data-bs-toggle="modal" data-bs-target="#mediaModal" data-media-type="<?php echo $settings['hundimauto_product_item_media_modal_type']; ?>" data-media-src="<?php echo $dataMediaSource; ?>" data-media-ratio="<?php echo $settings['hundimauto_product_item_media_modal_ratio']; ?>" data-media-title="<?php echo $settings['hundimauto_product_item_media_modal_title']; ?>"><?php
					} 
					?><?php echo wp_get_attachment_image( $imgID, 'full', false, array( 'class' => 'w-100' ) ); ?><?php if ( $settings['hundimauto_product_item_media_modal_type'] != 'none' ) { ?></a><?php } ?></div></div>
				</div>
				<div class="product-info<?php echo $os_animation['text-item']['class']; ?>"<?php echo $os_animation['text-item']['data']; ?><?php echo $os_animation['text-item']['delay']; ?>>
					<h3><?php echo $settings[ 'hundimauto_product_item_info_titel' ]; ?></h3>
					<?php echo $settings[ 'hundimauto_product_item_info_text' ]; ?>
				</div>
			</article><!-- /end product-item -->

		<?php
	}

	protected function _content_template() {}
}
?>