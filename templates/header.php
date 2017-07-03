<?php
use  Roots\Sage\HeroRender;
?>
<div id="header" class="header pure-u-1" >
  <header id="masthead" class="site-header" role="banner">
    <div id="branding" class="site-branding">
    <?php $logo_image = Puredemo_Kirki::get_option( 'pure-demo', 'header_logo_setting' );
    if ( $logo_image ) : ?>
        <a class="navmenu-brand" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
            <img src='<?php echo esc_url( $logo_image ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
        </a>
    <?php else : ?>
      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <?php endif; ?>
      <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
    </div>
    <nav class="navigation_container">
      <?php
      /**
       * Only get the Primary menu if it is set in the WordPress Admin.
       * The menu_class argument breaks if there is no menu activated in the WordPress Admin
       */
        if ( has_nav_menu( 'primary_navigation' ) ) :
           wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'rm-closed']);
        endif;
      ?>
    </nav>
  </header>
</div><?php if (HeroRender\puredemo_has_hero()) HeroRender\puredemo_get_her(); ?>

