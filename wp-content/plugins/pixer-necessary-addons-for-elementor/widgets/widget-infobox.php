<?php 
namespace pixer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Pixerinobox1_widgets extends Widget_Base {
 
   public function get_name() {
      return 'pixer-infobox';
   }
 
   public function get_title() {
      return esc_html__( 'Infobox One', 'pixer-for-elementor' );
   }
 
   public function get_icon() { 
        return 'fa fa-slideshare';
   }
 
   public function get_categories() {
      return [ 'pixer-slider' ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'infobox_section',
         [
            'label' => esc_html__( 'Infobox', 'pixer-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
        'text_align',
        [
          'label' => __( 'Alignment', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::CHOOSE,
          'options' => [
            'left' => [
              'title' => __( 'Left', 'pixer-for-elementor' ),
              'icon' => 'fa fa-align-left',
            ],
            'center' => [
              'title' => __( 'Center', 'pixer-for-elementor' ),
              'icon' => 'fa fa-align-center',
            ],
            'right' => [
              'title' => __( 'Right', 'pixer-for-elementor' ),
              'icon' => 'fa fa-align-right',
            ],
          ],
          'default' => 'center',
          'toggle' => true,
        ]
      );

      $this->add_control(
        'icon_style',
        [
          'label' => __( 'Icon style', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::CHOOSE,
          'options' => [
            'fonticon' => [
              'title' => __( 'Font icon', 'pixer-for-elementor' ),
              'icon' => 'fa fa-icons',
            ],
            'imageicon' => [
              'title' => __( 'Image icon', 'pixer-for-elementor' ),
              'icon' => 'fa fa-images',
            ]
          ],
          'default' => 'fonticon',
          'toggle' => true
        ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => ['icon_style' => 'imageicon']
         ]     
      );

      $this->add_control(
         'font_icon',
         [
            'label' => __( 'Font Icon', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => ['icon_style' => 'fonticon'],
            'default' => 'fa fa-address-card-o'
         ]     
      );

      $this->add_control(
        'font_color',
        [
          'label' => __( 'Font Color', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
            '{{WRAPPER}} .infobox-icon i' => 'color: {{VALUE}}',
          ],
          'default' => '#878787',
          'condition' => ['icon_style' => 'fonticon']
        ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Awesome Design','pixer-for-elementor'),
         ]
      );

      $this->add_control(
        'title_color',
        [
          'label' => __( 'Title Color', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
            '{{WRAPPER}} .infobox-content h4' => 'color: {{VALUE}}',
          ],
          'default' => '#878787'
        ]
      );

      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'pixer-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Lorem ipsum dummy text are used here so replace your app data, ipsum dummy text are used here so','pixer-for-elementor'),
         ]
      );


      $this->add_control(
        'text_color',
        [
          'label' => __( 'Text Color', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
            '{{WRAPPER}} .infobox-content p' => 'color: {{VALUE}}',
          ],
          'default' => '#878787'
        ]
      );

      $this->add_control(
        'button',
        [
           'label' => __( 'Button', 'pixer-for-elementor' ),
           'type' => \Elementor\Controls_Manager::TEXT,
           'default' => __('Readmore','pixer-for-elementor'),
        ]
      );

      $this->add_control(
        'button_color',
        [
          'label' => __( 'Button Color', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
            '{{WRAPPER}} .infobox-content a' => 'color: {{VALUE}}',
          ],
          'default' => '#878787'
        ]
      );

      $this->add_control(
        'website_link',
        [
          'label' => __( 'Link', 'pixer-for-elementor' ),
          'type' => \Elementor\Controls_Manager::URL,
          'placeholder' => __( 'https://your-link.com', 'pixer-for-elementor' ),
          'show_external' => true,
          'default' => [
            'url' => '',
            'is_external' => true,
            'nofollow' => true,
          ],
        ]
      );


      $this->add_control(
         'active',
         [
            'label' => __( 'Active', 'megaaddons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'megaaddons' ),
            'label_off' => __( 'Off', 'megaaddons' ),
            'return_value' => 'active',
         ]
      );

      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
      $settings = $this->get_settings_for_display(); 
      $target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
      $nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';
      ?>
      <div class="infobox style1 <?php echo esc_attr( $settings['text_align'] .' '. $settings['active'] ); ?>" align="<?php echo esc_attr( $settings['text_align'] ); ?>">
        <div class="infobox-icon">
        <?php
          if ( 'fonticon' == $settings['icon_style'] ){ ?>
            <i class="<?php echo esc_attr($settings['font_icon']) ?>"></i>
        <?php } elseif( 'imageicon' == $settings['icon_style'] ){
            echo wp_get_attachment_image( $settings['icon']['id'],'full');
          } 
        ?>
        </div>
        <div class="infobox-content">
          <h4><?php echo esc_html($settings['title']); ?></h4>
          <p><?php echo esc_html($settings['text']); ?></p>
          <a href="<?php echo esc_url( $settings['website_link']['url'] ) ?>" <?php esc_attr( $target . $nofollow ) ?>><?php echo esc_html($settings['button']); ?></a>
        </div>
      </div>

      <?php
   }
 
}