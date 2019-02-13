<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Button
class thegncy_Widget_Button extends Widget_Base {
 
   public function get_name() {
      return 'button';
   }
 
   public function get_title() {
      return esc_html__( 'Button', 'thegncy' );
   }
 
   public function get_icon() { 
        return 'eicon-button';
   }
 
   public function get_categories() {
      return [ 'thegncy-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'button_section',
         [
            'label' => esc_html__( 'Button', 'thegncy' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'button_text', [
            'label' => __( 'Button Text', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Learn More','thegncy')
         ]
      );

      $this->add_control(
         'button_url', [
            'label' => __( 'Button URL', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );

      $this->add_control(
         'color',
         [
            'label' => __( 'Alternate Color', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'thegncy' ),
            'label_off' => __( 'Off', 'thegncy' ),
            'return_value' => 'yes',
            'default' => 'no',
   
         ]
      );

      $this->add_control(
         'align',
         [
            'label' => __( 'Align', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'solid',
            'options' => [
               'center'  => __( 'Center', 'thegncy' ),
               'left' => __( 'Left', 'thegncy' ),
               'right' => __( 'Right', 'thegncy' )
            ],
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      
      $this->add_inline_editing_attributes( 'button_text', 'basic' );
      $this->add_inline_editing_attributes( 'button_url', 'basic' );
      $this->add_inline_editing_attributes( 'align', 'basic' );
      $this->add_inline_editing_attributes( 'color', 'basic' );
      ?>

      <div class="thegncy-btn <?php if( $settings['color'] == 'yes' ){ echo 'alt-color';} ?>" style="text-align: <?php echo esc_attr($settings['align']) ?>">
         <a class="thegncy-btn" href="<?php echo esc_url( $settings['button_url'] ); ?>">
            <?php echo esc_html( $settings['button_text'] ); ?></a>
      </div>
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new thegncy_Widget_Button );