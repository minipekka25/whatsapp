<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;

$tmp = $lapa_loop;

$loop_layout = Lapa()->settings()->get('portfolio_display_type', 'grid');
$loop_style = Lapa()->settings()->get('portfolio_display_style', '1');

$lapa_loop['loop_layout'] = $loop_layout;
$lapa_loop['loop_style'] = $loop_style;
$lapa_loop['responsive_column'] = Lapa()->settings()->get('portfolio_column', array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1));
$lapa_loop['image_size'] = Lapa_Helper::get_image_size_from_string(Lapa()->settings()->get('portfolio_thumbnail_size', 'full'),'full');
$lapa_loop['title_tag'] = 'h4';
$lapa_loop['excerpt_length'] = 15;
$lapa_loop['item_space'] = (int) Lapa()->settings()->get('portfolio_item_space', 0);

echo '<div id="archive_portfolio_listing" class="la-portfolio-listing">';

if( have_posts() ){

    get_template_part("templates/portfolios/start", $loop_style);

    while( have_posts() ){

        the_post();

        get_template_part("templates/portfolios/loop", $loop_style);

    }

    get_template_part("templates/portfolios/end", $loop_style);

}

echo '</div>';
/**
 * Display pagination and reset loop
 */

lapa_the_pagination();

wp_reset_postdata();

$lapa_loop = $tmp;