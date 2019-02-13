<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner Parallax
class thegncy_Widget_BannerParallax extends Widget_Base {
 
   public function get_name() {
      return 'banner_para';
   }
 
   public function get_title() {
      return esc_html__( 'Banner Parallax', 'thegncy' );
   }
 
   public function get_icon() { 
        return 'eicon-parallax';
   }
 
   public function get_categories() {
      return [ 'thegncy-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'banner_parallax_section',
         [
            'label' => esc_html__( 'Banner Parallax', 'thegncy' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'subtitle',
         [
            'label' => __( 'Sub Title', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Best Digital agency','thegncy')
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Make the right choice for future!','thegncy')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Lorem ipsum dummy text are usually use in this industry. replace your','thegncy')
         ]
      );
      
      $this->add_control(
         'image',
         [
            'label' => __( 'Choose a image', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_control(
         'btn_text', [
            'label' => __( 'Text', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
            'default' => __('Learn More','thegncy')
         ]
      );

      $this->add_control(
         'btn_url', [
            'label' => __( 'URL', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'description', 'basic' );
      ?>


      <section id="banner" class="banner-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 d-none d-xl-block">
                    <div class="banner-3-content">
                        <span><?php echo esc_html($settings['subtitle']); ?></span>
                        <h1><?php echo esc_html($settings['title']); ?></h1>
                        <p><?php echo esc_html($settings['description']); ?></p>
                        <a href="<?php echo esc_url($settings['btn_url']); ?>"><?php echo esc_html($settings['btn_text']); ?></a>
                    </div>
                </div>
                <div class="col-lg-7 d-block d-lg-block d-sm-block d-xl-none">
                    <div class="banner-3-content">
                        <span><?php echo esc_html($settings['subtitle']); ?></span>
                        <h1><?php echo esc_html($settings['title']); ?></h1>
                        <p><?php echo esc_html($settings['description']); ?></p>
                        <a href="<?php echo esc_url($settings['btn_url']); ?>"><?php echo esc_html($settings['btn_text']); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-shape-animate">
            <img src="<?php
            if ($settings['image']['id']) { 
               echo wp_get_attachment_url( $settings['image']['id'], 'full' );
            } else {
               echo get_template_directory_uri().'/img/illustration.png';
            } ?>" alt="images">
        </div>
   </section>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new thegncy_Widget_BannerParallax );