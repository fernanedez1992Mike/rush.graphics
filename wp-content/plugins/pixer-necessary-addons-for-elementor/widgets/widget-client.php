<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixerclient_widgets extends Widget_Base {
 
   public function get_name() {
      return 'Pixerclient';
   }
 
   public function get_title() {
      return esc_html__( 'Client list One', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider', ];
   }
   protected function _register_controls() {
      $this->start_controls_section(
         'section_content_brand',
         [
            'label' => esc_html__( 'Brand Area', 'pixer-for-elementor' ),
         ]  
      );


      $this->add_control(
         'tabs',
         [
            'label' => esc_html__( 'Brand Items', 'pixer-for-elementor' ),
            'type' => Controls_Manager::REPEATER,
            'default' => [
               [
                  'tab_title'   => esc_html__( 'Brand #1', 'pixer-for-elementor' ),
                  'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'pixer-for-elementor' ),
               ]
            ],
            'fields' => [  
               [
                  'name'    => 'tab_image',
                  'label'   => esc_html__( 'Image', 'pixer-for-elementor' ),
                  'type'    => Controls_Manager::MEDIA,
                  'dynamic' => [ 'active' => true ],
               ], 
            ],
         ]
      );

      $this->end_controls_section();


      $this->start_controls_section(
         'section_content_layout',
         [
            'label' => esc_html__( 'Layout', 'pixer-for-elementor' ),
         ]
      );
        
      $this->add_responsive_control(
         'align',
         [
            'label'   => esc_html__( 'Alignment', 'pixer-for-elementor' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
               'left' => [
                  'title' => esc_html__( 'Left', 'pixer-for-elementor' ),
                  'icon'  => 'fa fa-align-left',
               ],
               'center' => [
                  'title' => esc_html__( 'Center', 'pixer-for-elementor' ),
                  'icon'  => 'fa fa-align-center',
               ],
               'right' => [
                  'title' => esc_html__( 'Right', 'pixer-for-elementor' ),
                  'icon'  => 'fa fa-align-right',
               ],
               'justify' => [
                  'title' => esc_html__( 'Justified', 'pixer-for-elementor' ),
                  'icon'  => 'fa fa-align-justify',
               ],
            ],
            'prefix_class' => 'elementor%s-align-',
            'description'  => 'Use align to match position',
            'default'      => 'center',
         ]
      );

      $this->add_control(
         'show_image',
         [
            'label'   => esc_html__( 'Show Image', 'pixer-for-elementor' ),
            'type'    => Controls_Manager::SWITCHER,
            'default' => 'yes',
         ]
      );



      $this->end_controls_section();

   }

   public function render() {
      $settings  = $this->get_settings_for_display();
      extract($settings); ?>
      
      <div class="brand-area pt-120 pb-120">
                <div class="container">
                    <div class="row brand-active">
                     <?php foreach ( $settings['tabs'] as $item ) : ?>
                        
                              <div class="col-12">
                                 <?php if (( '' !== $item['tab_image'] ) && ( $settings['show_image'] )): ?>
                                  <div class="signle-brand">
                                      <img src="<?php echo wp_kses_post($item['tab_image']['url']); ?>" alt="img">
                                  </div>
                                  <?php endif; ?>  
                              </div>
                           
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
   <?php
   }
 
}