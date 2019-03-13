<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;
$loop_id = isset($lapa_loop['loop_id']) ? $lapa_loop['loop_id'] : uniqid('la-testimonial-');
$loop_style = isset($lapa_loop['loop_style']) ? $lapa_loop['loop_style'] : 1;
$responsive_column = isset($lapa_loop['responsive_column']) ? $lapa_loop['responsive_column'] : array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1);
$slider_configs = isset($lapa_loop['slider_configs']) ? $lapa_loop['slider_configs'] : '';
$item_space = isset($lapa_loop['item_space']) ? $lapa_loop['item_space'] : '30';

$loopCssClass = array('la-loop','testimonial-loop la_testimonials');
$loopCssClass[] = 'loop-style-' . $loop_style;
$loopCssClass[] = 'la_testimonials--style-' . $loop_style;

$loopCssClass[] = 'grid-items';
$loopCssClass[] = 'grid-space-'. $item_space;
if(!empty($slider_configs)){
    $loopCssClass[] = 'js-el la-slick-slider';
}else{
    foreach( $responsive_column as $screen => $value ){
        $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
    }
}

printf(
    '<div class="%1$s"%2$s>',
    esc_attr(implode(' ', $loopCssClass)),
    (!empty($slider_configs) ? ' data-la_component="AutoCarousel" ' . $slider_configs : '')
);