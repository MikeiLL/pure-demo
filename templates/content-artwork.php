<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <a href="<?php site_url(); ?>/band-art-archive">Return to Archive &larr;</a>
      <?php //get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
      <span class="" style="overflow:auto; padding:0.5em; border:1px solid #999; display: flex; flex-direction: column;"><?php the_post_thumbnail( 'full' ); ?></span>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
