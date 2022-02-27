<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixercontentwithvideo_widgets extends Widget_Base {
 
   public function get_name() {
      return 'Pixercontentwithvideo';
   }
 
   public function get_title() {
      return esc_html__( 'Content with Video', 'pixer-for-elementor' );
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
            'label' => esc_html__( 'Video', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
            'default' => __('Featured Tranding of the week','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'sub-title',
         [
            'label' => __( 'Sub Title', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('pricing strategy','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Build Digital Market place Sell Downloads','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'desc',
         [
            'label' => __( 'Description', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Online marketplace is type of e-commerce site where product or service information provided by multiple third parties where transactions are processed operator.','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'video-quote',
         [
            'label' => __( 'Video quote', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('“Primary type multichannel ecommerce and can way streamline”','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'video-background',
         [
            'label' => __( 'Video Background', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );
      $this->add_control(
         'video-url',
         [
            'label' => __( 'Video Background', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'sub-title', 'basic' );
      
      ?>

      <!-- video-area -->
      <section class="video-area pt-75 pb-100">
          <div class="container">
              <div class="video-wrap">
                  <div class="row align-items-center">
                      <div class="col-lg-6 order-0 order-lg-2">
                          <div class="video-thumb">
                              <img src="<?php echo esc_url($settings['video-background']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                              <a href="<?php echo esc_url($settings['video-url']); ?>" class="pulse pixer-popup-video"><span><i class="fa fa-play"></i></span></a>
                          </div>
                      </div>
                      <div class="col-lg-6 pr-80">
                          <div class="section-title mb-20">
                              <span><?php echo esc_html($settings['sub-title']); ?></span>
                              <h2><?php echo esc_html($settings['title']); ?></h2>
                          </div>
                          <div class="video-content">
                              <p><?php echo esc_html($settings['desc']); ?></p>
                              <div class="video-quote">
                                  <?php echo esc_html($settings['video-quote']); ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- video-area-end -->
      <?php
   }
 
}