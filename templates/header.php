<?php
use  Roots\Sage\HeroRender;
use  Roots\Sage\Extras;
?>
<div id="header" class="header pure-u-1" >
  <header id="masthead" class="site-header pure-g">
    <div id="branding" class="site-branding pure-u-1">
    <?php $logo_image = Puredemo_Kirki::get_option( 'pure-demo', 'header_logo_setting' );
    if ( $logo_image ) : ?>
        <a class="navmenu-brand" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
            <img src='<?php echo esc_url( $logo_image ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
        </a>
    <?php else : ?>
      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
      <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
    <?php endif; ?>
    </div>
    <!--[if lte IE 8]>
          <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
      <![endif]-->
      <!--[if gt IE 8]><!-->
          <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
      <!--<![endif]-->

    <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s><s class="bar"></s></a>
    <nav class="custom-wrapper overflow-hide navigation-container pure-menu custom-restricted-width pure-u-1" id="menu">
    <?php
    if ( has_nav_menu( 'primary_navigation' ) ) :
    wp_nav_menu(array('theme_location' =>'primary_navigation',
                          'menu_class' => 'pure-menu-list',
                          'container_class' => 'pure-menu pure-menu-horizontal custom-can-transform',
                          'walker' => new Extras\pure_walker_nav_menu()
                          ));
    endif; ?>
    </nav>

  </header>
</div><?php if (HeroRender\puredemo_has_hero()) HeroRender\puredemo_get_her(); ?>

