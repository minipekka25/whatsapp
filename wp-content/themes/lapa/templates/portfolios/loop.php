<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;

$loop_index     = isset($lapa_loop['loop_index']) ? absint($lapa_loop['loop_index']) : 0;
$loop_index++;
$lapa_loop['loop_index'] = $loop_index;

$loop_id        = isset($lapa_loop['loop_id']) ? $lapa_loop['loop_id'] : uniqid('la_pf_');

$image_size     = isset($lapa_loop['image_size']) && !empty($lapa_loop['image_size']) ? $lapa_loop['image_size'] : 'full';
$title_tag      = isset($lapa_loop['title_tag']) && !empty($lapa_loop['title_tag']) ? $lapa_loop['title_tag'] : 'h3';
$post_class     = array('loop-item','grid-item','portfolio-item');

$item_sizes     = !empty($lapa_loop['item_sizes']) ? $lapa_loop['item_sizes']: array();
$item_w         = 1;
$item_h         = 1;
if(!empty($item_sizes[$loop_index-1]['w']) && ( $_tmp_size = $item_sizes[$loop_index-1]['w'] )){
    $item_w = $_tmp_size;
}
if(!empty($item_sizes[$loop_index-1]['h']) && ( $_tmp_size = $item_sizes[$loop_index-1]['h'] )){
    $item_h = $_tmp_size;
}
if(!empty($item_sizes[$loop_index-1]['s'])){
    $thumbnail_size = $item_sizes[$loop_index-1]['s'];
}else{
    $thumbnail_size = $image_size;
}

$thumbnail_css_class = array('la-lazyload-image portfolio-thumbnail-bg');
$thumbnail_attr = '';
$thumb_src = '';
if(has_post_thumbnail()){
    if($thumbnail_obj = Lapa()->images()->get_attachment_image_src( get_post_thumbnail_id(), $thumbnail_size )){
        list( $thumb_src, $thumb_width, $thumb_height ) = $thumbnail_obj;
        if( $thumb_width > 0 && $thumb_height > 0 ) {
            $thumbnail_attr = 'padding-bottom:' . round( ($thumb_height/$thumb_width) * 100, 2 ) . '%';
        }
    }
    else{
        $thumbnail_css_class[] = 'no-image';
    }
}
else{
    $thumbnail_css_class[] = 'no-image';
}
$thumbnail_url = Lapa()->images()->get_post_thumbnail_url( get_the_ID(), $thumbnail_size);
?>
<div <?php post_class($post_class); ?> data-width="<?php echo esc_attr($item_w);?>" data-height="<?php echo esc_attr($item_h);?>">
    <div class="item-inner">
        <div class="item_image--cover">
            <div class="item_image--cover-holder">
                <a href="<?php the_permalink()?>" data-id="<?php the_ID()?>">
                   <div class="<?php echo esc_attr( join(' ', $thumbnail_css_class) ) ?>" data-background-image="<?php echo esc_url($thumb_src) ?>" style="<?php echo esc_attr($thumbnail_attr) ?>"></div>
                </a>
            </div>
        </div>
        <div class="item--info">
            <div class="item--info-inner item--holder">
                <div class="entry-header">
                    <?php the_title( sprintf( '<%s class="entry-title"><a href="%s">',$title_tag, esc_url( get_the_permalink() ) ), sprintf('</a></%s>', $title_tag) ); ?>
                </div>
                <div class="entry-tax-list">
                    <?php echo get_the_term_list(get_the_ID(), 'la_portfolio_skill', '', ', ');?>
                </div>
            </div>
        </div>
        <?php the_title( sprintf( '<a href="%s" class="item--link-overlay"><span class="icon-plus"></span><span class="hidden">', esc_url( get_the_permalink() ) ), '</span></a>' ); ?>
    </div>
</div>