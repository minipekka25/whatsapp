<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

    <?php

    global $post;

    $product_cols = shortcode_atts(
        array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1, 'mb' => 1),
        Lapa()->settings()->get('upsell_products_columns')
    );
    $design = Lapa()->settings()->get('shop_catalog_grid_style', '1');
    $loopCssClass = array('products','grid-items');
    $loopCssClass[] = 'products-grid';
    $loopCssClass[] = 'grid-space-default';
    $loopCssClass[] = 'products-grid-' . $design;
    foreach( $product_cols as $screen => $value ){
        $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
    }
    $title = Lapa()->settings()->get('upsell_product_title') ? Lapa()->settings()->get('upsell_product_title') : _x( 'You may also like&hellip;', 'front-view', 'lapa' );
    $sub_title = Lapa()->settings()->get('upsell_product_subtitle') ? Lapa()->settings()->get('upsell_product_subtitle') : '';
    ?>
    <div class="custom-product-wrap upsells">
        <div class="custom-product-ul">
            <div class="row block_heading">
                <div class="col-xs-12">
                    <h2 class="block_heading--title"><?php echo esc_html($title); ?></h2>
                    <div class="block_heading--subtitle"><?php echo esc_html($sub_title); ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>">

                        <?php foreach ( $upsells as $related_product ) : ?>

                            <?php
                            $post_object = get_post( $related_product->get_id() );

                            $post = $post_object;
                            setup_postdata($post);

                            wc_get_template_part( 'content', 'product' ); ?>

                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
    <div>

<?php endif;

wp_reset_postdata();