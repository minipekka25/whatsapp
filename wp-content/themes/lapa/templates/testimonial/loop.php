<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;
$loop_style     = isset($lapa_loop['loop_style']) ? $lapa_loop['loop_style'] : 1;
$title_tag      = (isset($lapa_loop['title_tag']) && !empty($lapa_loop['title_tag']) ? $lapa_loop['title_tag'] : 'div');
$role           = Lapa()->settings()->get_post_meta(get_the_ID(),'role');
$content        = Lapa()->settings()->get_post_meta(get_the_ID(),'content');
$avatar         = Lapa()->settings()->get_post_meta(get_the_ID(),'avatar');
$rating         = Lapa()->settings()->get_post_meta(get_the_ID(),'rating');
$post_class     = array('loop-item','grid-item','testimonial_item');

?>
<div <?php post_class($post_class)?>>
    <div class="testimonial_item--inner item-inner">
        <?php if($avatar): ?>
            <div class="testimonial_item--image"><span<?php
                if(wp_attachment_is_image($avatar)){
                    echo ' class="la-lazyload-image"';
                    echo ' data-background-image="'. esc_url( wp_get_attachment_image_url( $avatar, 'full' ) ) .'"';
                }
            ?>></span></div>
        <?php endif; ?>
        <div class="testimonial_item--info">
            <div class="testimonial_item--excerpt"><?php echo esc_html($content);?></div>
        </div>
        <div class="testimonial_item--bottom">
            <div class="testimonial_item--title-role">
                <?php
                printf(
                    '<%1$s class="%4$s">%3$s</%1$s>',
                    esc_attr($title_tag),
                    'javascript:;',
                    get_the_title(),
                    'testimonial_item--title'
                );
                if(!empty($role)){
                    printf(
                        '<p class="testimonial_item--role">%s</p>',
                        esc_html($role)
                    );
                }
                if(!empty($rating)){
                    printf(
                        '<p class="item--rating"><span class="star-rating"><span style="width: %1$s"></span></span></p>',
                        esc_attr(absint($rating) * 10) . '%'
                    );
                }
                ?>
            </div>
        </div>
    </div>
</div>