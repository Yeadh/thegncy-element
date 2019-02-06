<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// aboutme_image
class thegncy_Widget_TiltImage extends Widget_Base {
 
   public function get_name() {
      return 'tiltimage_image';
   }
 
   public function get_title() {
      return esc_html__( 'Image', 'thegncy' );
   }
 
   public function get_icon() { 
        return 'eicon-image-rollover';
   }
 
   public function get_categories() {
      return [ 'thegncy-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'aboutme_image_section',
         [
            'label' => esc_html__( 'Image', 'thegncy' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_control(
         'tilt',
         [
            'label' => __( 'Tilt Effect', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'thegncy' ),
            'label_off' => __( 'No', 'thegncy' ),
            'return_value' => 'yes',
            'default' => 'yes',
         ]
      );

      $this->add_control(
         'animate',
         [
            'label' => __( 'Spin Animation Effect', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'thegncy' ),
            'label_off' => __( 'No', 'thegncy' ),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );

      $this->add_control(
         'shadow',
         [
            'label' => __( 'Drop shadow', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'thegncy' ),
            'label_off' => __( 'No', 'thegncy' ),
            'return_value' => 'yes',
            'default' => 'no',
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'image', 'basic' );
      $this->add_inline_editing_attributes( 'tilt', 'basic' );
      $this->add_inline_editing_attributes( 'animate', 'basic' );
      $this->add_inline_editing_attributes( 'shadow', 'basic' );
      ?>

      <img <?php if ($settings['tilt'] == 'yes') {echo "data-tilt";} ?> class="<?php if ( $settings['animate'] == 'yes' ){echo 'circle-img-animate';} ?>img-fluid <?php if ($settings['shadow'] == 'yes') {echo "img-shadow";} ?>" src="<?php echo wp_get_attachment_image_url( $settings['image']['id'], 'full') ?>" alt="img">

      <?php if ( $settings['animate'] == 'yes'  ): ?>
         <ul class="animate-obj">
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-squire-2.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-star.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-triangle.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-squire-shadow.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-triangle.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-squire.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-star.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-tringle-shadow.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-squire-2.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-squire-shadow-2.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-tringle-shadow.png" alt="obj"></li>
           <li><img src="<?php echo get_template_directory_uri() ?>/img/obj-triangle.png" alt="obj"></li>
         </ul>
      <?php endif ?>
         
      <?php 
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new thegncy_Widget_TiltImage );