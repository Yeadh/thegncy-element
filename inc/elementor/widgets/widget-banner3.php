<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner Parallax
class thegncy_Widget_BannerPop extends Widget_Base {
 
   public function get_name() {
      return 'banner_pop';
   }
 
   public function get_title() {
      return esc_html__( 'Banner with popup video', 'thegncy' );
   }
 
   public function get_icon() { 
        return 'eicon-slider-video';
   }
 
   public function get_categories() {
      return [ 'thegncy-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'banner_pop_section',
         [
            'label' => esc_html__( 'Banner with popup video', 'thegncy' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Creative business agency make big deals','thegncy')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Lorem ipsum dummy text are usually use. Replace your text bare usuallly use in these section. So i used here. replace your text','thegncy')
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
         'video', [
            'label' => __( 'Video URL', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' =>'#'
         ]
      );

      $button = new \Elementor\Repeater();

      $button->add_control(
         'btn_text', [
            'label' => __( 'Text', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Learn More','thegncy')
         ]
      );

      $button->add_control(
         'btn_url', [
            'label' => __( 'URL', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
         ]
      );

      $this->add_control(
         'button_list',
         [
            'label' => __( 'Buttons', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $button->get_controls(),
            'default' => [
               [
                  'btn_text' => 'Contact Us',
                  'btn_url' => '#',                  
               ],
               [
                  'btn_text' => 'Learn more ',
                  'btn_url' => '#',
               ]
            ],
            'feature' => '{{{ button_list }}}',
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
      $this->add_inline_editing_attributes( 'button_list', 'basic' );
      ?>

      <section id="banner" class="banner-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-none d-xl-block">
                    <div class="banner-3-content">
                      <h1><?php echo esc_html($settings['title']); ?></h1>
                      <p><?php echo esc_html($settings['description']); ?></p>
                      <div class="bnr-btn">
                        <ul class="list-inline">
                          <?php foreach (  $settings['button_list'] as $key => $button_item ) { ?>
                             <li class="list-inline-item"><a href="<?php echo esc_url( $button_item['btn_url'] ); ?>"><?php echo esc_attr( $button_item['btn_text'] ); ?></a></li>
                           <?php } ?>
                        </ul>
                      </div>
                    </div>
                </div>
                <div class="col-lg-12 d-block d-lg-block d-sm-block d-xl-none">
                    <div class="banner-3-content">
                      <h1><?php echo esc_html($settings['title']); ?></h1>
                      <p><?php echo esc_html($settings['description']); ?></p>
                      <div class="bnr-btn">
                        <ul class="list-inline">
                          <?php foreach (  $settings['button_list'] as $key => $button_item ) { ?>
                             <li class="list-inline-item"><a href="<?php echo esc_url( $button_item['btn_url'] ); ?>"><?php echo esc_attr( $button_item['btn_text'] ); ?></a></li>
                           <?php } ?>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner4-image">
          <img src="<?php
            if ($settings['image']['id']) { 
               echo wp_get_attachment_url( $settings['image']['id'], 'full' );
            } else {
               echo get_template_directory_uri().'/img/bnr-popup.png';
            } ?>" alt="images">

            <a class="popup-video" href="<?php echo esc_url( $settings['video'] ) ?>">
              <span class="aboutme_image_icon"><i class="fa fa-play"></i></span>
            </a>

        </div>
      </section>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new thegncy_Widget_BannerPop );