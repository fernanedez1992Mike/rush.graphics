<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixerbanner_widgets extends Widget_Base {
 
   public function get_name() {
      return 'Pixerbannerone';
   }
 
   public function get_title() {
      return esc_html__( 'Banner One', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider', ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'banner_section',
         [
            'label' => esc_html__( 'Banner', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
      'banner_image',
        [
          'label' => __( 'Banner image', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
          ],
        ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Thinking Software High Quality','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit proin leo leo ornare nec vulputate tempus velit nam id purus tellus','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'btn_text', [
            'label' => __( 'Text', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('get started','pixer-for-elementor')
         ]
      );

      $this->add_control(
         'btn_url', [
            'label' => __( 'URL', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>
        
<!-- banner-area -->
          <section class="banner-area1 s-banner-bg slider-area fix p-relative">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-7 col-lg-6">
                            <div class="banner-content s-banner-content">
                                <h2 class="wow fadeInUp" data-wow-delay="0.2s"><?php echo $settings['title'] ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.4s"><?php echo esc_html( $settings['description'] ) ?></p>
                                <a href="<?php echo esc_url( $settings['btn_url'] ) ?>" class="btn wow fadeInLeft" data-wow-delay="0.6s"><?php echo esc_html( $settings['btn_text'] ) ?></a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 d-none d-lg-block">
                            <div class="s-banner-app p-relative">
                                <img src="<?php echo esc_url( $settings['banner_image']['url'] ) ?>" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- banner-area-end -->

      <?php
   }
}