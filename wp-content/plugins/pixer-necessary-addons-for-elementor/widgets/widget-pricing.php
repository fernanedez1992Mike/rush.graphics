<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixerpricing_widgets extends Widget_Base {
 
   public function get_name() {
      return 'Pixerpricing';
   }
 
   public function get_title() {
      return esc_html__( 'Pricing One', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider', ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'pricing_section',
         [
            'label' => esc_html__( 'Pricing', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'title', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Standard Plan'
         ]
      );

      $this->add_control(
         'price',
         [
            'label' => __( 'Price', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '70'
         ]
      );
      
      $this->add_control(
         'package',
         [
            'label' => __( 'Package', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'Yealry',
            'options' => [
               'Daily'  => __( 'Daily', 'pixer-for-elementor' ),
               'Weekly'  => __( 'Weekly', 'pixer-for-elementor' ),
               'Monthly' => __( 'Monthly', 'pixer-for-elementor' ),
               'Yealry' => __( 'Yealry', 'pixer-for-elementor' ),
               'none' => __( 'None', 'pixer-for-elementor' )
            ],
         ]
      );

      $feature = new \Elementor\Repeater();

      $feature->add_control(
         'feature',
         [
            'label' => __( 'Feature', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( '10 Free Domain Names', 'pixer-for-elementor' )
         ]
      );

      $feature->add_control(
         'cross',
         [
            'label' => __( 'Cross', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'pixer-for-elementor' ),
            'label_off' => __( 'Off', 'pixer-for-elementor' ),
            'return_value' => 'item-cross',
            'default' => 'off',
         ]
      );

      $this->add_control(
         'feature_list',
         [
            'label' => __( 'Feature List', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $feature->get_controls(),
            'default' => [
               [
                  'feature' => __( '5GB Storage Space', 'pixer-for-elementor' )
               ],
               [
                  'feature' => __( '20GB Monthly Bandwidth', 'pixer-for-elementor' )
               ],
               [
                  'feature' => __( 'My SQL Databases', 'pixer-for-elementor' )
               ],
               [
                  'feature' => __( '100 Email Account', 'pixer-for-elementor' )
               ],
               [
                  'feature' => __( '10 Free Domain Names', 'pixer-for-elementor' )
               ]
            ],
            'title_field' => '{{{ feature }}}',
         ]
      );

      $this->add_control(
         'btn_text',
         [
            'label' => __( 'button text', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Sng Up Now',
         ]
      );

      $this->add_control(
         'btn_url',
         [
            'label' => __( 'button URL', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
         ]
      );


      $this->end_controls_section();


   }
   protected function render( $instance = [] ) {
 

	// get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="pricing-box mb-30">
           <div class="pricing-head mb-40">
               <h5><?php echo esc_html( $settings['title'] ); ?></h5>
               <h2><?php echo $settings['price']; ?><span>/month</span></h2>
           </div>
           <div class="pricing-type mb-40">
               <h6><?php echo esc_html( $settings['package'] ); ?></h6>
           </div>
           <div class="pricing-list mb-40">
               <ul>
                  <?php foreach( $settings['feature_list'] as $index => $feature ) { ?>
                  <li class="<?php echo esc_attr($feature['cross']) ?>"><i class="fas <?php if ($feature['cross'] == 'item-cross'){echo 'fa-times';}else{echo 'fa-check';} ?>"></i><?php echo $feature['feature'] ?></li>
                  <?php } ?>
               </ul>
           </div>
           <div class="pricing-btn">
               <a href="<?php echo esc_attr( $settings['btn_url'] ) ?>" class="btn"><?php echo esc_html( $settings['btn_text'] ) ?></a>
           </div>
       </div>
      <?php
   }
 
}