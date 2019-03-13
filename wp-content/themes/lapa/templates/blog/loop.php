<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;

$layout = isset($lapa_loop['loop_layout']) ? $lapa_loop['loop_layout'] : 'grid';
$style = isset($lapa_loop['loop_style']) ? $lapa_loop['loop_style'] : 1;
$title_tag              = 'h2';
$show_featured_image    = (Lapa()->settings()->get('featured_images_blog') == 'on') ? true : false;
$show_format_content    = false;
$tmp_img_size           = Lapa_Helper::get_image_size_from_string(Lapa()->settings()->get('blog_thumbnail_size', 'full'), 'full');
$content_display_type   = ( Lapa()->settings()->get('blog_content_display', 'excerpt') == 'excerpt') ? 'excerpt' : 'full';
$post_class             = array('loop-item','grid-item', 'blog_item');


if($show_featured_image){
    $show_format_content    = (Lapa()->settings()->get('format_content_blog') == 'on') ? true : false;
}

if($show_featured_image){
    $post_class[] = 'show-featured-image';
    if(!has_post_thumbnail()){
        $post_class[] = 'no-featured-image';
    }
}else{
    $post_class[] = 'hide-featured-image';
}
if($show_format_content){
    $post_class[] = 'show-format-content';
}else{
    $post_class[] = 'hide-format-content';
}
if($content_display_type != 'full' && !Lapa()->settings()->get('blog_excerpt_length')){
    $post_class[] = 'hide-excerpt';
}

$thumbnail_size = $tmp_img_size;

$loop_index = isset($lapa_loop['loop_index']) ? $lapa_loop['loop_index'] : 0;
$loop_index++;
$lapa_loop['loop_index'] = $loop_index;


$thumbnail_size = apply_filters('lapa/filter/blog/post_thumbnail', $thumbnail_size, $lapa_loop);

?>
<article <?php post_class($post_class); ?>>
    <div class="blog_item--inner item-inner">
        <div class="blog_item--inner2 item-inner-wrap">
            <?php

            if (($layout == 'grid' && $style == '4') || $layout == 'list' && $style == '2') {
                ?>
                <div class="thumb-overlay la-lazyload-image" data-background-image="<?php
                if(has_post_thumbnail()){
                    echo Lapa()->images()->get_post_thumbnail_url(get_the_ID(), $thumbnail_size);
                }
                ?>"></div>
                <?php
            }
            else{
                if($show_featured_image){
                    $flag_format_content = false;
                    if($show_format_content){
                        switch(get_post_format()){
                            case 'link':
                                $link = Lapa()->settings()->get_post_meta( get_the_ID(), 'format_link' );
                                if(!empty($link)){
                                    printf(
                                        '<div class="blog_item--thumbnail format-link">%2$s<div class="format-content">%1$s</div><a class="post-link-overlay" href="%1$s"></a></div>',
                                        esc_url($link),
                                        (has_post_thumbnail() ? Lapa()->images()->get_post_thumbnail(get_the_ID(), $thumbnail_size) : '')
                                    );
                                    $flag_format_content = true;
                                }
                                break;
                            case 'quote':
                                $quote_content = Lapa()->settings()->get_post_meta(get_the_ID(), 'format_quote_content');
                                $quote_author = Lapa()->settings()->get_post_meta(get_the_ID(), 'format_quote_author');
                                $quote_background = Lapa()->settings()->get_post_meta(get_the_ID(), 'format_quote_background');
                                $quote_color = Lapa()->settings()->get_post_meta(get_the_ID(), 'format_quote_color');
                                if(!empty($quote_content)){
                                    $quote_content = '<p class="format-quote-content">'. $quote_content .'</p>';
                                    if(!empty($quote_author)){
                                        $quote_content .= '<span class="quote-author">'. $quote_author .'</span>';
                                    }
                                    $styles = array();
                                    $styles[] = 'background-color:' . $quote_background;
                                    $styles[] = 'color:' . $quote_color;
                                    if(has_post_thumbnail()){
                                        $styles[] = 'background-image: url(' . get_the_post_thumbnail_url(get_the_ID(), 'full') . ')';
                                    }
                                    printf(
                                        '<div class="blog_item--thumbnail format-quote"><div class="fq-wrapper" style="%3$s">%4$s<div class="format-content">%1$s</div><a class="post-link-overlay" href="%2$s"></a></div></div>',
                                        $quote_content,
                                        get_the_permalink(),
                                        esc_attr( implode(';', $styles) ),
                                        (has_post_thumbnail() ? Lapa()->images()->get_post_thumbnail(get_the_ID(), $thumbnail_size) : '')
                                    );
                                    $flag_format_content = true;
                                }

                                break;

                            case 'gallery':
                                $ids = Lapa()->settings()->get_post_meta(get_the_ID(), 'format_gallery');
                                $ids = explode(',', $ids);
                                $ids = array_map('trim', $ids);
                                $ids = array_map('absint', $ids);
                                $__tmp = '';

                                if(has_post_thumbnail()){
                                    $__tmp .= sprintf('<div><a href="%1$s">%2$s</a></div>',
                                        get_the_permalink(),
                                        Lapa()->images()->get_post_thumbnail(get_the_ID(), $thumbnail_size )
                                    );
                                }

                                if(!empty( $ids )){
                                    foreach($ids as $image_id){
                                        $__tmp .= sprintf('<div><a href="%1$s">%2$s</a></div>',
                                            get_the_permalink(),
                                            Lapa()->images()->get_attachment_image( $image_id, $thumbnail_size)
                                        );
                                    }
                                }

                                if(!empty($__tmp)){
                                    printf(
                                        '<div class="blog_item--thumbnail format-gallery"><div data-la_component="AutoCarousel" class="js-el la-slick-slider" data-slider_config="%1$s">%2$s</div></div>',
                                        esc_attr(json_encode(array(
                                            'slidesToShow' => 1,
                                            'slidesToScroll' => 1,
                                            'dots' => false,
                                            'arrows' => true,
                                            'speed' => 300,
                                            'autoplay' => false,
                                            'fade' => true,
                                            'prevArrow'=> '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
                                            'nextArrow'=> '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>'
                                        ))),
                                        $__tmp
                                    );
                                    $flag_format_content = true;
                                }
                                break;

                        }
                    }
                    if(!$flag_format_content && has_post_thumbnail()){ ?>
                        <div class="blog_item--thumbnail blog_item--thumbnail-with-effect">
                            <a href="<?php the_permalink();?>">
                                <?php Lapa()->images()->the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
                                <span class="pf-icon pf-icon-<?php echo get_post_format() ? get_post_format() : 'standard' ?>"></span>
                                <div class="item--overlay"></div>
                            </a>
                        </div>
                        <?php
                    }
                }
            }

            ?>
            <div class="blog_item--info clearfix">
                <?php lapa_entry_meta_item_category_list('<div class="blog_item--category-link">', '</div>', ''); ?>
                <div class="blog_item--info2">
                    <div class="blog_item--title entry-header">
                        <?php the_title(sprintf('<%s class="entry-title"><a href="%s">', $title_tag, esc_url(get_the_permalink())), sprintf('</a></%s>', $title_tag)); ?>
                    </div>
                    <div class="blog_item--meta entry-meta clearfix"><?php
                        lapa_entry_meta_item_author();
                        lapa_entry_meta_item_postdate();
                        ?></div><!-- .entry-meta -->
                    <div class="blog_item--excerpt entry-excerpt"><?php the_excerpt(); ?></div>
                    <div class="blog_item--meta-footer clearfix">
                        <?php
                        if ($layout == 'grid' && $style == '2') {
                            ?>
                            <div class="la-sharing-posts">
                                <span><i class="fa fa-share-alt"></i></span>
                                <?php lapa_social_sharing(get_the_permalink(), get_the_title(), (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '')); ?>
                            </div>
                            <?php
                            lapa_get_favorite_link();
                            lapa_entry_meta_item_comment_post_link_with_icon();
                        }
                        else{
                            $readmore_class = 'btn btn-readmore';
                            if ($layout == 'grid' && $style == '4') {
                                $readmore_class = 'btn-readmore';
                            }
                            printf(
                                '<a class="%3$s" href="%1$s">%2$s</a>',
                                get_the_permalink(),
                                esc_html_x('Read more', 'front-view', 'lapa'),
                                esc_attr($readmore_class)
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
