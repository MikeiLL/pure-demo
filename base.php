<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'pure-demo'); ?>
      </div>
    <![endif]-->
    <!-- next line recommended for vanilla javascript menu -->
    <script type="text/javascript">function hasClass(e,t){return e.className.match(new RegExp("(\\s|^)"+t+"(\\s|$)"))}var el=document.body;var cl="no-js";if(hasClass(el,cl)){var reg=new RegExp("(\\s|^)"+cl+"(\\s|$)");el.className=el.className.replace(reg," js-enabled")}</script>

    <!--[if lte IE 8]>
      <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if lt IE 9]>
    <style>
    /* #### - css for IE8 and under - also copy the css for the desktop menu here for IE7/8 compatibility #### */

    /* copy and paste desktop menu css here */

    #menu .toggle-sub { display:none } /* hide arrows (no rotate in IE7/8) */
    #menu ul ul .toggle-sub { display:inline-block } /* reinstate right arrows on subs */
    #menu ul li a { padding-right:1.5em } /* remove extra space previously reserved for down arrows */
    </style>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

    <div class="wrap" role="document">

      <div class="content pure-g">
      <?php $main_grid_eighty_percent = (Setup\display_sidebar() == 1) ? 'pure-u-md-16-24 pure-u-lg-18-24' : ''; ?>
        <main class="main pure-u-1 <?=$main_grid_eighty_percent?>">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar pure-u-1 pure-u-md-8-24 pure-u-lg-6-24">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
    <script type="text/javascript">
        responsivemenu.init({
            wrapper: document.querySelector('.navigation_container')
        });
    </script>
    <?php
    $value = Kirki::get_option( 'puredemo', 'puredemo_custom_js' );
    echo '<script type="text/javascript">';
    echo $value;
    echo '</script>';
    ?>
  </body>
</html>
