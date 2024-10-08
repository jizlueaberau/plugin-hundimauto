<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Product Item Widget
 */

class Elementor_Testimonial_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return "HiA Testimonial Carousel";
	}

	public function get_title() {
		return esc_html__( 'HiA Testimonial Carousel', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-blockquote';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'testimonial', 'carousel', 'image', 'text' ];
	}

	public function get_script_depends() {
		return [ 'swiper' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'hundimauto_testimonial_list_section_1',
			[
				'label' => esc_html__( 'Inhalt', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_testimonial_list',
			[
				'label'			=> esc_html__( 'Testimonial', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::REPEATER,
				'fields'		=> [
					[
						'name'			=> 'testimonial_image',
						'label'			=> esc_html__( 'Bild (Format 1:1)', 'plugin-hundimauto' ),
						'type'			=> \Elementor\Controls_Manager::MEDIA,
						'default'		=> [ 'url' => \Elementor\Utils::get_placeholder_image_src() ]
					],
					[
						'name'			=> 'testimonial_quote',
						'label'			=> esc_html__( 'Rezension', 'plugin-hundimauto' ),
						'type'			=> \Elementor\Controls_Manager::WYSIWYG,
						'show_label'	=> false
					],
					[
						'name'			=> 'testimonial_cite',
						'label'			=> esc_html__( 'Name der Person', 'plugin-hundimauto' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'label_block'	=> true
					]
				],
				'default'			=> [],
				'title_field'		=> 'Testimonial'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_testimonial_list_section_2',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_testimonial_list_animation',
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
			'hundimauto_testimonial_list_animation_delay',
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

		if ( $settings['hundimauto_testimonial_list_animation'] !== 'none' ) {
			$os_animation['class'] 	= ' os-animation';
			$os_animation['data']	= ' data-animation="animate__' . $settings['hundimauto_testimonial_list_animation'] . '"';
			$os_animation['delay']	= ' data-delay="' . $settings['hundimauto_testimonial_list_animation_delay'] . 'ms"';
		}

		?>
		<div class="testimonials-wrapper<?php echo $os_animation['class']; ?>"<?php echo $os_animation['data']; ?><?php echo $os_animation['delay']; ?>>
			<div class="elementor-element elementor-element-testimonial-widget elementor-pagination-position-outside elementor-widget elementor-widget-image-carousel" data-id="testimonial-widget" data-element_type="widget" data-settings="{&quot;slides_to_show&quot;:&quot;2&quot;,&quot;slides_to_show_mobile&quot;:&quot;1&quot;,&quot;slides_to_scroll&quot;:&quot;1&quot;,&quot;navigation&quot;:&quot;dots&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;no&quot;,&quot;speed&quot;:500}" data-widget_type="image-carousel.default">

				<div class="elementor-widget-container">
					<div class="elementor-image-carousel-wrapper swiper-container" dir="ltr">
						<div class="elementor-image-carousel swiper-wrapper" aria-live="off">
							<?php
								if ( $settings[ 'hundimauto_testimonial_list' ] ) {
									foreach ( $settings[ 'hundimauto_testimonial_list' ] as $index => $item ) {
							?>

							<div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="<?php echo ($index + 1); ?> von <?php echo count( $settings[ 'hundimauto_testimonial_list' ] ); ?>">
								<article class="testimonial">
									<div class="portrait">
										<div><?php echo wp_get_attachment_image( $item['testimonial_image']['id'], 'full', false, array( 'class' => 'w-100', 'alt' => $item['testimonial_cite'] ) ); ?></div>
									</div>
									<div class="quote">
										<blockquote>
											<img src="<?php echo get_theme_file_uri(); ?>/assets/images/noun-quote-5767821.svg" alt="" />
											<?php echo $item['testimonial_quote']; ?>
											<cite>&#8212; <?php echo $item['testimonial_cite']; ?></cite>
										</blockquote>
									</div>
								</article>
							</div>
							<?php
									}
								}
							?>

						</div>
							
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {}
}
?>