<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixertitle_widgets extends Widget_Base {
 
   public function get_name() {
      return 'Pixertitle';
   }
 
   public function get_title() {
      return esc_html__( 'Title', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider', ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'newsletter_section',
         [
            'label' => esc_html__( 'Title', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title', [
            'label' => __( 'Title', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Get reguler updates', 'pixer-for-elementor' ),
         ]
      );

      $this->add_control(
         'text', [
            'label' => __( 'Text', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'With Pixer Plugin You can create & customize your website easily with free premade premium quality elements', 'pixer-for-elementor' ),
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="newsletter-area">
        <div class="container">
          <div class="row justify-content-center">
              <div class="col-xl-7 col-lg-10">
                  <div class="section-title text-center border-none">
                      <h2><?php echo $settings['title']; ?></h2>
                      <p><?php echo $settings['text']; ?></p>
                  </div>
              </div>
          </div>
        </div>
      </div>

<?php }
 
}