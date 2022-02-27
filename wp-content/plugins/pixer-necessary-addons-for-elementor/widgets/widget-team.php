<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixerteam_widgets extends Widget_Base {
 
   public function get_name() {
      return 'Pixerteam';
   }
 
   public function get_title() {
      return esc_html__( 'Team One', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider', ];
   }
   protected function _register_controls() {
      $this->start_controls_section(
         'service_section',
         [
            'label' => esc_html__( 'Team', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      $this->add_control(
         'image',
         [
            'label' => __( 'Choose photo', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );
      
      $this->add_control(
         'name',
         [
            'label' => __( 'Name', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Pailsabis Tony',
         ]
      );
      $this->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Company Director',
         ]
      );
      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'social_icon', [
            'label' => __( 'Social Icon', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-facebook',
         ]
      );
      $repeater->add_control(
         'social_url', [
            'label' => __( 'Socia URL', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
         ]
      );
      $this->add_control(
         'social_media',
         [
            'label' => __( 'social profile', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => 'Social Item',
            'default' => [
               [
                  'social_icon' => 'Facbook',
                  'social_url' => '#'
               ]
            ],
            'feature' => '{{{ social_media }}}',
         ]
      );
      
      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'image', 'basic' );
      $this->add_inline_editing_attributes( 'name', 'basic' );
      $this->add_inline_editing_attributes( 'designation', 'basic' );
      $this->add_inline_editing_attributes( 'social_icon', 'basic' );
      $this->add_inline_editing_attributes( 'social_url', 'basic' );
      ?>
      <div class="team"> 
         <?php echo wp_get_attachment_image( $settings['image']['id'],'full'); ?>
         <div class="team-content">  
            <ul class="list-inline">
               <?php 
               foreach (  $settings['social_media'] as $single_social ) { ?>
                  <li class="list-inline-item"><a href="<?php echo $single_social['social_url'] ?>"><i class="fa-fw <?php echo $single_social['social_icon'] ?>"></i></a></li>
               <?php 
               } ?>
            </ul>
         </div>
         <h5 <?php echo $this->get_render_attribute_string( 'name' ); ?>><?php echo esc_html($settings['name']); ?></h5>
            <span <?php echo $this->get_render_attribute_string( 'designation' ); ?>><?php echo esc_html($settings['designation']); ?></span>    
      </div>

      <?php
   }
 
}