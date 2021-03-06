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

    <!--[if lte IE 8]>
      <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
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

    <?php $js_File = file_get_contents(get_stylesheet_directory() . '/dist/scripts/critical.js'); ?>
    <script><?php echo $js_File; ?></script>
    <?php
    $value = Kirki::get_option( 'puredemo', 'puredemo_custom_js' );
    echo '<script>';
    echo $value;
    echo '</script>';
    ?>
  </body>
</html>
