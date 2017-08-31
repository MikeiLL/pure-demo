<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/include-kirki.php', // Add a mess of options for the theme
  'lib/pure-demo-kirki.php', // Include kirki classes
  'lib/pure-demo-kirki-config.php', // Include our custom Kirki Configuration File
  'lib/page-hero/page-hero.php' // Include our custom Kirki Configuration File
  //'cpt/post-types.php' // Borrowed from Iron Templates
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'pure-demo'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

