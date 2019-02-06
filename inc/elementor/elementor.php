<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// get posts dropdown
function thegncy_get_portfolio_dropdown_array($args = [], $key = 'ID', $value = 'post_title') {
  $options = [];
  $posts = get_posts($args);
  foreach ((array) $posts as $term) {
    $options[$term->{$key}] = $term->{$value};
  }
  return $options;
}

function thegncy_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'thegncy-elements',
		[
			'title' => esc_html__( 'TheGncy Elements', 'thegncy' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'thegncy_add_elementor_widget_categories' );

//Elementor init

class thegncy_ElementorCustomElement {
 
   private static $instance = null;
 
   public static function get_instance() {
      if ( ! self::$instance )
         self::$instance = new self;
      return self::$instance;
   }
 
   public function init(){
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
   }


   public function widgets_registered() {
 
    // We check if the Elementor plugin has been installed / activated.
    if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

         get_template_part( 'inc/elementor/widgets/widget', 'title' );
         get_template_part( 'inc/elementor/widgets/widget', 'tiltimage' );
         get_template_part( 'inc/elementor/widgets/widget', 'contacts' );
         get_template_part( 'inc/elementor/widgets/widget', 'pricing' );
         get_template_part( 'inc/elementor/widgets/widget', 'counter' );
         get_template_part( 'inc/elementor/widgets/widget', 'service' );
         get_template_part( 'inc/elementor/widgets/widget', 'feature' );
         get_template_part( 'inc/elementor/widgets/widget', 'portfolio' );
         get_template_part( 'inc/elementor/widgets/widget', 'portfolioitem' );
         get_template_part( 'inc/elementor/widgets/widget', 'testimonials' );
         get_template_part( 'inc/elementor/widgets/widget', 'progress' );
         get_template_part( 'inc/elementor/widgets/widget', 'team' );
         get_template_part( 'inc/elementor/widgets/widget', 'blog' );
         get_template_part( 'inc/elementor/widgets/widget', 'button' );
      }
	}

}
 
thegncy_ElementorCustomElement::get_instance()->init();