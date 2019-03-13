<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;
$loop_id            = isset($lapa_loop['loop_id']) ? $lapa_loop['loop_id'] : uniqid('la_pf_');
$layout             = isset($lapa_loop['loop_layout']) ? $lapa_loop['loop_layout'] : 'grid';
$style              = isset($lapa_loop['loop_style']) ? $lapa_loop['loop_style'] : 1;
$item_space         = isset($lapa_loop['item_space']) ? $lapa_loop['item_space'] : 0;
$responsive_column  = isset($lapa_loop['responsive_column']) ? $lapa_loop['responsive_column'] : array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1);
$slider_configs     = isset($lapa_loop['slider_configs']) ? $lapa_loop['slider_configs'] : '';

$loopCssClass = array('la-loop','portfolios-loop');
$loopCssClass[] = 'pf-style-' . $style;
$loopCssClass[] = 'pf-' . $layout;
$loopCssClass[] = 'grid-space-'. $item_space;


if($layout == 'masonry'){
    $column_type            = isset($lapa_loop['column_type']) ? $lapa_loop['column_type'] : 'default';
    $item_width             = isset($lapa_loop['base_item_w']) ? $lapa_loop['base_item_w'] : 300;
    $item_height            = isset($lapa_loop['base_item_h']) ? $lapa_loop['base_item_h'] : 300;
    $mb_column              = isset($lapa_loop['mb_column']) ? $lapa_loop['mb_column'] : array('md'=> 1,'sm'=> 1,'xs'=> 1, 'mb' => 1);
    $enable_skill_filter    = isset($lapa_loop['enable_skill_filter']) ? true : false;
    $filter_style           = isset($lapa_loop['filter_style']) ? $lapa_loop['filter_style'] : '1';
    $filters                = isset($lapa_loop['filters']) ? $lapa_loop['filters'] : '';
    $loopCssClass[]         = 'js-el';
    $loopCssClass[]         = 'la-isotope-container';
    $loopCssClass[]         = 'masonry__column-type-'. $column_type;

    $custom_isotope_configs = array();

    if($column_type != 'custom'){
        $loopCssClass[] = 'grid-items';
        foreach( $responsive_column as $screen => $value ){
            $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
        }
    }

    if($enable_skill_filter){
        $filter_html = '';
        if(!empty($filters)){
            $filters = explode(',', $filters);
            foreach($filters as $filter){
                $category = get_term($filter, 'la_portfolio_skill');
                if(!is_wp_error($category) && $category){
                    $filter_html .= sprintf('<li data-filter="la_portfolio_skill-%s"><a href="#">%s</a></li>',
                        esc_attr($category->slug),
                        esc_html($category->name)
                    );
                }
            }
        }
        echo sprintf(
            '<div data-la_component="MasonryFilter" class="js-el la-isotope-filter-container filter-style-%1$s" data-isotope_container="#%2$s .la-isotope-container"><div class="la-toggle-filter">%3$s</div><ul><li class="active" data-filter="*"><a href="#">%3$s</a></li>%4$s</ul></div>',
            esc_attr($filter_style),
            esc_html($loop_id),
            esc_html_x('All', 'front-view', 'lapa'),
            $filter_html
        );
    }

    ?>
<div class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>"<?php
echo ' data-item_selector=".portfolio-item"';
echo ' data-item_margin="0"';
echo ' data-config_isotope="'.esc_attr(json_encode($custom_isotope_configs)).'"';
echo ' data-item-width="'.esc_attr($item_width).'"';
echo ' data-item-height="'.esc_attr($item_height).'"';
echo ' data-md-col="'.esc_attr($mb_column['md']).'"';
echo ' data-sm-col="'.esc_attr($mb_column['sm']).'"';
echo ' data-xs-col="'.esc_attr($mb_column['xs']).'"';
echo ' data-mb-col="'.esc_attr($mb_column['mb']).'"';
echo ' data-la_component="' . ( $column_type != 'custom' ? 'DefaultMasonry' : 'AdvancedMasonry'). '"';
?>>
<?php

}
else{
    if(!empty($slider_configs)){
        $loopCssClass[] = 'js-el la-slick-slider';
    }
    else{
        $loopCssClass[] = 'grid-items';
        foreach( $responsive_column as $screen => $value ){
            $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
        }
    }
    echo sprintf(
        '<div class="%1$s"%2$s>',
        esc_attr(implode(' ', $loopCssClass)),
        (!empty($slider_configs) ? ' data-la_component="AutoCarousel" ' . $slider_configs : '')
    );
}