<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$header_layout = Lapa()->layout()->get_header_layout();

$header_access_icon = Lapa()->settings()->get('header_access_icon_1');

$show_header_top        = Lapa()->settings()->get('enable_header_top');
$header_top_elements    = Lapa()->settings()->get('header_top_elements');
$custom_header_top_html = Lapa()->settings()->get('use_custom_header_top');

$aside_sidebar_name = apply_filters('lapa/filter/aside_widget_bottom', 'aside-widget');
$header_aside_sidebar_name = apply_filters('lapa/filter/header_sidebar_widget_bottom', 'header-sidebar-bottom');

$enable_header_aside = false;

if(!empty($header_access_icon)){
    foreach($header_access_icon as $component){
        if(isset($component['type']) && $component['type'] == 'aside_header'){
            $enable_header_aside = true;
            break;
        }
    }
}

?>

<?php if($enable_header_aside): ?>
    <aside id="header_aside" class="header--aside">
        <div class="header-aside-wrapper">
            <a class="btn-aside-toggle" href="#"><i class="dl-icon-close"></i></a>
            <div class="header-aside-inner">
                <?php if(is_active_sidebar($aside_sidebar_name)): ?>
                    <div class="header-widget-bottom">
                        <?php
                        dynamic_sidebar($aside_sidebar_name);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </aside>
<?php endif;?>


<?php if($show_header_top == 'custom' && !empty($custom_header_top_html) ): ?>
<header id="masthead" class="site-header">
    <div class="site-header-top use-custom-html">
        <div class="container">
            <?php echo Lapa_Helper::remove_js_autop($custom_header_top_html); ?>
        </div>
    </div>
</header>
<?php endif; ?>
<?php if($show_header_top == 'yes' && !empty($header_top_elements) ): ?>
<header id="masthead" class="site-header">
    <div class="site-header-top use-default">
        <div class="container">
            <div class="header-top-elements">
                <?php
                foreach($header_top_elements as $component){
                    if(isset($component['type'])){
                        echo Lapa_Helper::render_access_component($component['type'], $component, 'header_component');
                    }
                }
                ?>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>
<header id="masthead_aside" class="header--aside">
    <div class="site-header-inner">
        <div class="container">
            <div class="header-main clearfix">
                <div class="header-component-outer header-left">
                    <div class="site-branding">
                        <a href="<?php echo esc_url( home_url( '/'  ) ); ?>" rel="home">
                            <figure class="logo--normal"><?php Lapa()->layout()->render_logo();?></figure>
                            <figure class="logo--transparency"><?php Lapa()->layout()->render_transparency_logo();?></figure>
                        </a>
                    </div>
                </div>

                <?php if(!empty($header_access_icon)): ?>
                    <div class="header-component-outer header-middle">
                        <div class="header-component-inner">
                            <?php
                                foreach($header_access_icon as $component){
                                    if(isset($component['type'])){
                                        echo Lapa_Helper::render_access_component($component['type'], $component, 'header_component');
                                    }
                                }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="header-component-outer header-right">
                    <nav class="nav-menu-burger accordion-menu"><?php
                        Lapa()->layout()->render_main_nav(array(
                            'menu_class'    => 'menu',
                            'link_before'   => '',
                            'link_after'    => '',
                            'fallback_cb'   => 'wp_page_menu',
                            'walker'        => ''
                        ));
                        ?></nav>
                </div>
                <?php if(is_active_sidebar($header_aside_sidebar_name)): ?>
                <div class="clearfix"></div>
                <div class="header-component-outer header-bottom">
                    <div class="header-widget-bottom">
                        <?php
                        dynamic_sidebar($header_aside_sidebar_name);
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<!-- #masthead -->