<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixerfeatures_widgets extends Widget_Base {
 
   public function get_name() {
      return 'Pixerfeatures';
   }
 
   public function get_title() {
      return esc_html__( 'Features One', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider', ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'features',
         [
            'label' => esc_html__( 'Features', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'style',
         [
            'label' => __( 'Service Style', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'center',
            'options' => [
               'center'  => __( 'Center Icon', 'pixer-for-elementor' ),
               'left' => __( 'Left Icon', 'pixer-for-elementor' ),
            ],
         ]
      );
      

      $this->add_control(
        'feature_icon',
        [
          'label' => __( 'Feature Icon', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
        ]
      );
      
      $this->add_control(
         'feature_title', [
            'label' => __( 'Feature Title', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Market Analysis',
         ]
      );

      $this->add_control(
         'feature_text', [
            'label' => __( 'Feature Text', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Orem Ipsum is simply dummy text the printing and typesetting industry sum has been the industrys',
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <?php 
      if ( $settings['style'] == 'center' ){ ?>

      <div class="single-features text-center">
        <div class="features-icon mb-25">
            <?php \Elementor\Icons_Manager::render_icon( $settings['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="features-content">
            <h4><?php echo esc_html( $settings['feature_title'] ) ?></h4>
            <p><?php echo esc_html( $settings['feature_text'] ) ?></p>
        </div>
      </div>

      <?php } elseif( $settings['style'] == 'left' ) { ?>

      <div class="s-single-features">
         <div class="s-features-icon">
            <?php \Elementor\Icons_Manager::render_icon( $settings['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
         </div>
         <div class="features-content">
             <h5><?php echo esc_html( $settings['feature_title'] ) ?></h5>
            <p><?php echo esc_html( $settings['feature_text'] ) ?></p>
         </div>
      </div>

      <?php } ?>


    <?php }
 
}