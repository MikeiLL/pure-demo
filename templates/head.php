<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <?php $css_File = file_get_contents(get_stylesheet_directory() . '/dist/styles/critical.min.css'); ?>
  <style><?php echo $css_File; ?></style>
</head>
