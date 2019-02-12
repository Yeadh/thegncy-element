<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Banner
class thegncy_Widget_Banner extends Widget_Base {
 
   public function get_name() {
      return 'banner';
   }
 
   public function get_title() {
      return esc_html__( 'Banner', 'thegncy' );
   }
 
   public function get_icon() { 
        return 'eicon-banner';
   }
 
   public function get_categories() {
      return [ 'thegncy-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'banner_section',
         [
            'label' => esc_html__( 'Banner', 'thegncy' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Make present for future ready','thegncy')
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Lorem ipsum dummy text are usually use. Replace your text','thegncy')
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

      $social = new \Elementor\Repeater();

      $social->add_control(
         'social_icon', [
            'label' => __( 'Icon', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-facebook',
         ]
      );

      $social->add_control(
         'social_url', [
            'label' => __( 'URL', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->add_control(
         'social_list',
         [
            'label' => __( 'Social Media', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $social->get_controls(),
            'default' => [
               [
                  'social_icon' => 'fa fa-facebook',
                  'social_url' => '#',                  
               ],
               [
                  'social_icon' => 'fa fa-twitter',
                  'social_url' => '#',
               ],
               [
                  'social_icon' => 'fa fa-dribbble',
                  'social_url' => '#',
               ],
               [
                  'social_icon' => 'fa fa-linkedin',
                  'social_url' => '#',
               ]
            ],
            'feature' => '{{{ social_list }}}',
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

      $counter = new \Elementor\Repeater();

      $counter->add_control(
         'counter_text', [
            'label' => __( 'Text', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Projects done','thegncy')
         ]
      );

      $counter->add_control(
         'counter_value', [
            'label' => __( 'Value', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 566,
         ]
      );

      $this->add_control(
         'counter_list',
         [
            'label' => __( 'Counter', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $counter->get_controls(),
            'default' => [
               [
                  'counter_text' => 'Projects done',
                  'counter_value' => 458,                  
               ],
               [
                  'counter_text' => 'Happy clients',
                  'counter_value' => 524,                  
               ],
               [
                  'counter_text' => 'Projects running',
                  'counter_value' => 458,                  
               ]
            ],
            'feature' => '{{{ counter_list }}}',
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

      <section id="banner" class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-8 wow fadeInLeft" data-wow-duration="2.5s">
                    <div class="bnr-social">
                        <ul class="list-inline">
                           <?php foreach (  $settings['social_list'] as $key => $social_item ) { ?>
                             <li class="list-inline-item"><a href="<?php echo esc_url( $social_item['social_url'] ); ?>"><i class="fa-fw <?php echo esc_attr( $social_item['social_icon'] ); ?>"></i></a></li>
                           <?php } ?>
                        </ul>
                    </div>
                    <h1><?php echo esc_html($settings['title']); ?></h1>
                    <p><?php echo esc_html($settings['description']); ?></p>

                    <div class="bnr-btn">
                        <ul class="list-inline">
                           <?php foreach (  $settings['button_list'] as $key => $button_item ) { ?>
                             <li class="list-inline-item"><a href="<?php echo esc_url( $button_item['btn_url'] ); ?>"><?php echo esc_attr( $button_item['btn_text'] ); ?></a></li>
                           <?php } ?>
                        </ul>
                    </div>
                    <div class="bnr-left-sape">
                        <img src="<?php echo get_template_directory_uri() ?>/img/side-shape-left.png" alt="shape">
                    </div>

                    <div class="bnr-counter">
                        <ul class="list-inline">
                           <?php foreach (  $settings['counter_list'] as $key => $counter_item ) { ?>
                              <li class="list-inline-item">
                                <span class="counter"><?php echo esc_attr( $counter_item['counter_value'] ); ?></span>
                                <p><?php echo esc_attr( $counter_item['counter_text'] ); ?></p>
                              </li>
                           <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="bnr-shape-img" style="background: url('<?php
         if ($settings['image']['id']) { echo wp_get_attachment_url( $settings['image']['id'], 'full' );
         } else {
            echo get_template_directory_uri().'/img/bnr-shape.png';
         } ?>');">
         </div>

   </section>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new thegncy_Widget_Banner );