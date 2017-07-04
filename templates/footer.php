<footer class="content-info">
  <div class="pure-g">
  <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
      <?php dynamic_sidebar( 'sidebar-footer' ); ?>
  <?php endif; ?>
  </div>
  <div id="colophon" class="site-footer" role="contentinfo">
  <?php
    if ( has_nav_menu( 'footer_links' ) ) :
       wp_nav_menu(['theme_location' => 'footer_links', 'container_class' => 'pure-menu', 'menu_class' => 'pure-menu-list']);
    endif;
  ?>
  </div>
</footer>

