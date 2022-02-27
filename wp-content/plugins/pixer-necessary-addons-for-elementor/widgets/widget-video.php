<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixervideo_widgets extends Widget_Base {
 
   public function get_name() {
      return 'video-section';
   }
 
   public function get_title() {
      return esc_html__( 'Video Section', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider', ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'video_section',
         [
            'label' => esc_html__( 'Video Image', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_control(
         'overlay',
         [
            'label' => __( 'Image Overlay', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#',
         ]
      );

      $this->add_control(
         'video_url',
         [
            'label' => __( 'Video URL', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>
      <div class="pixer-addons-video-wrap">
          <div class="row align-items-center">
              <div class="col-lg-12">
                  <div class="video-thumb">
                     <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                     <div class="pixer-for-elementor-video-popup-overlay" style="background: <?php echo esc_attr( $settings['overlay'] ); ?>;">
                        <a href="<?php echo esc_url($settings['video_url']); ?>" class="pulse pixer-addon-popup-video"><span><i class="fa fa-play"></i></span></a>
                    </div>
                 </div>
              </div>
          </div>
      </div>
      <?php
   }
 
}