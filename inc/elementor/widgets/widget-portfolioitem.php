<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// portfolio
class thegncy_Widget_Portfolio_Item extends Widget_Base {
 
   public function get_name() {
      return 'portfolio_item';
   }
 
   public function get_title() {
      return esc_html__( 'Portfolio Item', 'thegncy' );
   }
 
   public function get_icon() { 
        return 'eicon-image-rollover';
   }
 
   public function get_categories() {
      return [ 'thegncy-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'portfolio_section',
         [
            'label' => esc_html__( 'Portfolio Item', 'thegncy' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'post',
         [
            'label' => esc_html__( 'Portfolio Item', 'thegncy' ),
            'type' => Controls_Manager::SELECT2, 
            'title' => esc_html__( 'Select a portfolio', 'thegncy' ),
            'options' => thegncy_get_portfolio_dropdown_array([
              'post_type' => 'portfolio',
            ]),
         ]
      );


      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();

      $portfolio = new \WP_Query( array(
      'post_type' => 'portfolio',
      'posts_per_page' => 1,
      'p' => $settings['post'],

     ));
     /* Start the Loop */
     while ( $portfolio->have_posts() ) : $portfolio->the_post();
     $portfolio_terms = get_the_terms( get_the_ID() , 'portfolio_category' );
     ?>

        <div data-tilt class="single_item">
          <?php the_post_thumbnail() ?>
          <div class="single_item_content">
             <a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-eye"></i></a>
             <span></span>
             <?php the_title( '<h6>', '</h6>' ) ?>
          </div>
        </div>

         <?php endwhile; wp_reset_postdata(); ?>
            
    <?php }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new thegncy_Widget_Portfolio_Item );