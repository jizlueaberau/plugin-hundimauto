<?php
namespace Plugin_Hundimauto;

/**
 * Hundimauto Vimeo Video Widget
 */

class Elementor_Vimeo_Video_Widget extends \Elementor\Widget_Base {

	const VIMEO_PLAYER = 'https://player.vimeo.com/video/';

	public function get_name() {
		return "HiA Vimeo Video";
	}

	public function get_title() {
		return esc_html__( 'HiA Vimeo Video', 'plugin-hundimauto' );
	}

	public function get_icon() {
		return 'eicon-youtube';
	}

	public function get_categories() {
		return [ 'hundimauto_custom_widget_category' ];
	}

	public function get_keywords() {
		return [ 'hia', 'video', 'vimeo' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'hundimauto_vimeo_video_section_1',
			[
				'label' => esc_html__( 'Inhalt', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_vimeo_video_list',
			[
				'label'			=> esc_html__( 'Videos', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::REPEATER,
				'fields'		=> [
					[
						'name'			=> 'video_id',
						'label'			=> esc_html__( 'Vimeo ID', 'plugin-hundimauto' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'placeholder'	=> esc_html__( 'e.g. 123456789', 'plugin-hundimauto' )
					],
					[
						'name'			=> 'video_title',
						'label'			=> esc_html__( 'Vimeo Titel', 'plugin-hundimauto' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'placeholder'	=> esc_html__( '', 'plugin-hundimauto' )
					]
				],
				'default'		=> [],
				'title_field'	=> '{{{ name }}}'
			]
		);

		$this->add_control(
			'hundimauto_vimeo_video_fb_image',
			[
				'label'			=> esc_html__( 'Loading Image', 'plugin-hundimauto' ),
				'type'			=> \Elementor\Controls_Manager::GALLERY,
				'show_label'	=> false,
				'description'	=> 'Image displayed while laoding vimeo video.'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hundimauto_vimeo_video_section_2',
			[
				'label' => esc_html__( 'Animation', 'plugin-hundimauto' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'hundimauto_vimeo_video_animation',
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
			'hundimauto_vimeo_video_animation_delay',
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
		$videos = [];
		$video_settings = [
			'autoplay' 	=> '1',
			'loop'		=> '1',
			'color'		=> 'd2ba8b',
			'title'		=> '0',
			'byline'	=> '0',
			'portrait'	=> '0',
			'muted'		=> '1',
			'dnt'		=> '1'
		];
		$os_animation = [
			'class'		=> '',
			'data'		=> '',
			'delay'		=> ''
		];

		if ( empty( $settings['hundimauto_vimeo_video_list'] ) ) {
			return;
		}

		// populating and shuffeling video array container
		foreach ( $settings['hundimauto_vimeo_video_list'] as $key => $value ) {
			array_push( $videos, [ $value['video_id'], $value['video_title'] ] );
		} shuffle( $videos ); $video = array_pop( $videos );

		if ( $settings['hundimauto_vimeo_video_animation'] !== 'none' ) {
			$os_animation['class'] 	= ' os-animation';
			$os_animation['data']	= ' data-animation="animate__' . $settings['hundimauto_vimeo_video_animation'] . '"';
			$os_animation['delay']	= ' data-delay="' . $settings['hundimauto_vimeo_video_animation_delay'] . 'ms"';
		}
		?><div class="video-frame ratio ratio-16x9<?php echo $os_animation['class']; ?>"<?php echo $os_animation['data']; ?><?php echo $os_animation['delay']; ?><?php
			if ( isset ( $settings['hundimauto_vimeo_video_fb_image'][0] ) && !empty ( $settings['hundimauto_vimeo_video_fb_image'][0]['url'] ) ) {
				echo " style=\"background-image:url('". $settings['hundimauto_vimeo_video_fb_image'][0]['url'] . "')\"";
			}
			?>><iframe src="<?php 
			echo self::VIMEO_PLAYER . $video[0];
			// adding hash keys
			$hash = "?";
			foreach ($video_settings as $key => $value) {
				$hash .= $key . "=" . $value . "&";
			}
			echo substr_replace($hash, '', -1);
		?>" frameborder="0" title="<?php echo $video[1]; ?>" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
		<?php
	}
	
	protected function _content_template() {}
}
?>