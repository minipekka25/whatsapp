<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;

$layout = isset($lapa_loop['loop_layout']) ? $lapa_loop['loop_layout'] : 'grid';
$style = isset($lapa_loop['loop_style']) ? $lapa_loop['loop_style'] : 1;

$loopCssClass = array('la-loop','showposts-loop');
$loopCssClass[] = "$layout-$style";
$loopCssClass[] = 'showposts-' . $layout;


printf(
    '<div class="%1$s"><div class="row"><div class="blog-special-left col-xs-12 col-sm-6">',
    esc_attr(implode(' ', $loopCssClass))
);