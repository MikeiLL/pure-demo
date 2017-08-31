<?php
use  Roots\Sage\HeroRender;
use  Roots\Sage\Extras;
?>
<div id="header" class="header pure-u-1" >
  <header id="masthead" class="site-header pure-g" role="banner">
    <div id="branding" class="site-branding pure-u-1">
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
    <!--[if lte IE 8]>
          <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
      <![endif]-->
      <!--[if gt IE 8]><!-->
          <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
      <!--<![endif]-->
      <style>

      .site-header {
          position: relative;
      }

      .custom-wrapper {
          margin-bottom: 1em;
          -webkit-font-smoothing: antialiased;
          height: 2.1em;
          overflow: hidden;
          -webkit-transition: height 0.5s;
          -moz-transition: height 0.5s;
          -ms-transition: height 0.5s;
          transition: height 0.5s;
      }

      .custom-wrapper.open {
          height: 14em;
      }

      .custom-wrapper {
          height: 0;
      }

      .custom-toggle {
          width: 34px;
          height: 34px;
          position: absolute;
          top: 0;
          right: 0;
          display: none;
      }

      .custom-toggle {
          display: block;
      }

      .custom-toggle .bar {
          background-color: #777;
          display: block;
          width: 20px;
          height: 2px;
          border-radius: 100px;
          position: absolute;
          top: 18px;
          right: 7px;
          -webkit-transition: all 0.5s;
          -moz-transition: all 0.5s;
          -ms-transition: all 0.5s;
          transition: all 0.5s;
      }

      .custom-toggle .bar:first-child {
          -webkit-transform: translateY(-6px);
          -moz-transform: translateY(-6px);
          -ms-transform: translateY(-6px);
          transform: translateY(-6px);
      }

      .custom-toggle .bar:last-child {
          -webkit-transform: translateY(+6px);
          -moz-transform: translateY(+6px);
          -ms-transform: translateY(+6px);
          transform: translateY(+6px);
      }

      .custom-toggle.x .bar:last-child {
          display: none;
      }

      .custom-toggle.x .bar {
          -webkit-transform: rotate(45deg);
          -moz-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
      }

      .custom-toggle.x .bar:first-child {
          -webkit-transform: rotate(-45deg);
          -moz-transform: rotate(-45deg);
          -ms-transform: rotate(-45deg);
          transform: rotate(-45deg);
      }

      .pure-menu-has-children {
        position: relative;
      }

      .pure-menu-children {
          display: none;
          position: absolute;
          left: 45%;
          top: 2em;
          margin: 0;
          padding: 0;
      }

      @media (min-width: 47.999em) {
        .custom-toggle {
            display: none;
        }

        .custom-wrapper {
          height: 3.2em;
          overflow: visible;
        }

        .pure-menu-children {
          display: none;
          left: 100%;
          top: 0;
          margin: 0;
          padding: 0;
      }

        .pure-menu-children .pure-menu-item {
          background-color: magenta;
        }
      }
      </style>

      <!--<div class="custom-wrapper pure-g" id="menu">
              <div class="pure-menu pure-u-1 pure-u-md-1-2">
                  <a href="#" class="pure-menu-heading custom-brand">Brand</a>
                  <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
              </div>
              <div class=" pure-u-1 pure-u-md-1-2 pure-menu pure-menu-horizontal custom-can-transform">
                  <ul class="pure-menu-list">
                      <li class="pure-menu-item"><a href="#" class="pure-menu-link">Home</a></li>
                      <li class="pure-menu-item"><a href="#" class="pure-menu-link">About</a></li>
                      <li class="pure-menu-item"><a href="#" class="pure-menu-link">Contact</a></li>

                      <li class="pure-menu-item"><a href="#" class="pure-menu-link">Yahoo</a></li>
                      <li class="pure-menu-item"><a href="#" class="pure-menu-link">W3C</a></li>
                  </ul>
              </div>
      </div>-->


    <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s><s class="bar"></s></a>
    <nav class="custom-wrapper pure-menu custom-restricted-width pure-u-1" id="menu">
    <?php
    if ( has_nav_menu( 'primary_navigation' ) ) :
    wp_nav_menu(array('theme_location' =>'primary_navigation',
                          'menu_class' => 'pure-menu-list',
                          'container_class' => 'pure-menu pure-menu-horizontal custom-can-transform',
                          'walker' => new Extras\pure_walker_nav_menu()
                          ));
    endif; ?>
    </nav>

      <script>
      (function (window, document) {
      var menu = document.getElementById('menu'),
          WINDOW_CHANGE_EVENT = ('onorientationchange' in window) ? 'orientationchange':'resize';

      function toggleHorizontal() {
          [].forEach.call(
              document.getElementById('menu').querySelectorAll('.custom-can-transform'),
              function(el){
                  el.classList.toggle('pure-menu-horizontal');
              }
          );
      };

      function toggleMenu() {
          // set timeout so that the panel has a chance to roll up
          // before the menu switches states
          if (menu.classList.contains('open')) {
              setTimeout(toggleHorizontal, 500);
          }
          else {
              toggleHorizontal();
          }
          menu.classList.toggle('open');
          document.getElementById('toggle').classList.toggle('x');
      };

      function closeMenu() {
          if (menu.classList.contains('open')) {
              toggleMenu();
          }
      }

      document.getElementById('toggle').addEventListener('click', function (e) {
          toggleMenu();
          e.preventDefault();
      });

      window.addEventListener(WINDOW_CHANGE_EVENT, closeMenu);
      })(this, this.document);

      </script>
  </header>
</div><?php if (HeroRender\puredemo_has_hero()) HeroRender\puredemo_get_her(); ?>

