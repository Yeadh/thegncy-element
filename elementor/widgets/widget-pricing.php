<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Pricing
class thegncy_Widget_Pricing extends Widget_Base {
 
   public function get_name() {
      return 'pricing_plan';
   }
 
   public function get_title() {
      return esc_html__( 'Pricing Plan', 'thegncy' );
   }
 
   public function get_icon() { 
        return 'eicon-price-table';
   }
 
   public function get_categories() {
      return [ 'thegncy-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'pricing_section',
         [
            'label' => esc_html__( 'Pricing Plan', 'thegncy' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'description',
         [
            'label' => __( 'Description', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Price fix with based on your selcectec features','thegncy')
         ]
      );

      $this->add_control(
         'percentage',
         [
            'label' => __( 'Percentage Off', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('40% OFF','thegncy')
         ]
      );
      
      $this->add_control(
         'package',
         [
            'label' => __( 'Package', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'Monthly',
            'options' => [
               'Monthly'  => __( 'Monthly', 'thegncy' ),
               'Yearly' => __( 'Yearly', 'thegncy' )
            ],
         ]
      );

      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'feature', [
            'label' => __( 'Feature', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $repeater->add_control(
         'feature_price', [
            'label' => __( 'Price', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->add_control(
         'feature_list',
         [
            'label' => __( 'Feature list', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
               [
                  'feature' => __( '5GB Storage Space', 'thegncy' ),
                  'feature_price' => 20,                  
               ],
               [
                  'feature' => __( '20GB Monthly Bandwidth', 'thegncy' ),
                  'feature_price' => 30,
               ],
               [
                  'feature' => __( 'My SQL Databases', 'thegncy' ),
                  'feature_price' => 40,
               ],
               [
                  'feature' => __( '100 Email Account', 'thegncy' ),
                  'feature_price' => 10,
               ],
               [
                  'feature' => __( '10 Free Domain Names', 'thegncy' ),
                  'feature_price' => 50,
               ]
            ],
            'feature' => '{{{ feature_list }}}',
         ]
      );

      $this->add_control(
         'button',
         [
            'label' => __( 'Button', 'thegncy' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Order Now', 'thegncy' ),
         ]
      );

      $this->add_control(
         'url',
         [
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
      $this->add_inline_editing_attributes( 'package', 'basic' );
      $this->add_inline_editing_attributes( 'feature_list', 'basic' );
      $this->add_inline_editing_attributes( 'percentage', 'basic' );
      ?>
      
     <div class="pricing-item">
         <div class="pricing-card">
             <ul class="list-inline package-btn">
                 <li class="list-inline-item"><?php echo esc_html($settings['package']); ?> <?php echo esc_html__( 'Package', 'thegncy' ); ?></li>
             </ul>
             <h6><?php echo esc_html($settings['package']); ?> <?php echo esc_html__( 'Package', 'thegncy' ); ?></h6>
             <span>$</span><h1 class="totalPrice">00</h1>
             <p><?php echo esc_html($settings['description']); ?></p>
             <a href="<?php echo esc_url($settings['url']) ?>"><?php echo esc_html($settings['button']) ?></a>
         </div>
         <div class="pricing-features">
             <span><?php echo esc_html( $settings['percentage']); ?></span>
             <h2><?php echo esc_html__( 'All Features', 'thegncy' ); ?></h2>
             <?php 
            foreach (  $settings['feature_list'] as $key => $single_feature ) { ?>
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="check-<?php echo $key ?>" value="<?php echo esc_attr( $single_feature['feature_price'] ) ?>">
                  <label class="form-check-label" for="check-<?php echo $key ?>">
                     <?php echo esc_html( $single_feature['feature'] ); ?> ($<?php echo esc_attr( $single_feature['feature_price'] ) ?>)
                  </label>
               </div>
            <?php 
            } ?>
         </div>
     </div>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new thegncy_Widget_Pricing );