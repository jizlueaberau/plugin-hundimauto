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

	}

	protected function render() {
		?>

			<article class="product-item alignment-left">
				<div class="product-image">
					<div class="box"><div><a href="#"><?php echo wp_get_attachment_image( 666, 'full', false, array( 'class' => 'w-100' ) ); ?></a></div></div>
				</div>
				<div class="product-info">
					<h3><a name="dogboard">Das DogBoard</a></h3>
					<p>Das DogBoard ist eine ultraleichte und einfach anzuwendende Einstiegshilfe für Ihr Fahrzeug, die Ihrem Hund und letztendlich auch Ihnen den täglichen Umgang miteinander erleichtern wird. Das DogBoard ist einfach anzuwenden und wir der auf der Anhängerkupplung montiert. Das DogBoard zeichnet sich auch durch das geringe Eigenwicht von 2.6kg. aus und benötigt nur einen kleinen Platzbedarf.</p>
					<p><strong>Preis CHF 219.- inkl. MwSt.</strong></p>
				</div>
			</article><!-- /end product-item -->

			<article class="product-item alignment-right">
				<div class="product-image">
					<div class="box"><div><a href="#"><?php echo wp_get_attachment_image( 666, 'full', false, array( 'class' => 'w-100' ) ); ?></a></div></div>
				</div>
				<div class="product-info">
					<h3><a name="hundetreppen">Hundetreppen</a></h3>
					<p>Das DogBoard ist eine ultraleichte und einfach anzuwendende Einstiegshilfe für Ihr Fahrzeug, die Ihrem Hund und letztendlich auch Ihnen den täglichen Umgang miteinander erleichtern wird. Das DogBoard ist einfach anzuwenden und wir der auf der Anhängerkupplung montiert. Das DogBoard zeichnet sich auch durch das geringe Eigenwicht von 2.6kg. aus und benötigt nur einen kleinen Platzbedarf.</p>
					<p><strong>Preis CHF 219.- inkl. MwSt.</strong></p>
				</div>
			</article><!-- /end product-item -->

			<article class="product-item alignment-left">
				<div class="product-image">
					<div class="box"><div><a href="#"><?php echo wp_get_attachment_image( 666, 'full', false, array( 'class' => 'w-100' ) ); ?></a></div></div>
				</div>
				<div class="product-info">
					<h3>Das DogBoard</h3>
					<p>Das DogBoard ist eine ultraleichte und einfach anzuwendende Einstiegshilfe für Ihr Fahrzeug, die Ihrem Hund und letztendlich auch Ihnen den täglichen Umgang miteinander erleichtern wird. Das DogBoard ist einfach anzuwenden und wir der auf der Anhängerkupplung montiert. Das DogBoard zeichnet sich auch durch das geringe Eigenwicht von 2.6kg. aus und benötigt nur einen kleinen Platzbedarf.</p>
					<p><strong>Preis CHF 219.- inkl. MwSt.</strong></p>
				</div>
			</article><!-- /end product-item -->

		<?php
	}

	protected function _content_template() {}
}
?>