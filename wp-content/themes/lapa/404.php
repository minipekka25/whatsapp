<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header(); ?>
<?php do_action( 'lapa/action/before_render_main' ); ?>
<?php $content_404 = Lapa()->settings()->get('404_page_content'); ?>
<div id="main" class="site-main<?php echo ($content_404 ? ' has-custom-404-content' : ''); ?>">
    <div class="container">
        <div class="row">
            <main id="site-content" class="<?php echo esc_attr(Lapa()->layout()->get_main_content_css_class('col-xs-12 site-content'))?>">
                <div class="site-content-inner">

                    <?php do_action( 'lapa/action/before_render_main_inner' );?>

                    <div class="page-content">
                        <?php
                        if(!empty($content_404)) : ?>
                            <div class="customerdefine-404-content">
                                <?php echo Lapa_Helper::remove_js_autop($content_404); ?>
                            </div>
                        <?php else : ?>
                            <div class="default-404-content">
                                <div class="col-md-5">
                                    <div class="bg-404"><span></span></div>
                                </div>
                                <div class="col-md-4 col-md-offset-1" style="padding-bottom: 5%">
                                    <h5 class="three-font-family"><?php echo esc_html_x('404', 'front-end', 'lapa') ?></h5>
                                    <h6 class="three-font-family"><?php echo esc_html_x('Page cannot be found !', 'front-end', 'lapa') ?></h6>
                                    <p><?php echo esc_html_x('It looks like nothing was found at this location. Maybe try a search?', 'front-end', 'lapa')?></p>
                                    <p class="btn-wrapper"><a class="btn text-uppercase btn-style-outline btn-color-gray" href="<?php echo esc_url(home_url('/')) ?>"><?php echo esc_html_x('Back to home', 'front-view','lapa')?></a></p>
                                </div>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>

                    <?php do_action( 'lapa/action/after_render_main_inner' );?>
                </div>
            </main>
            <!-- #site-content -->
            <?php get_sidebar();?>
        </div>
    </div>
</div>
<!-- .site-main -->
<?php do_action( 'lapa/action/after_render_main' ); ?>
<?php get_footer();?>