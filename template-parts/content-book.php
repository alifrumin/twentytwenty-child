<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" style="background-color: <?php the_field('background_color'); ?>; color: <?php the_field('text_color'); ?>;">
<style>

  .post-<?php the_ID(); ?> .entry-categories-inner a,
  .singular:not(.overlay-header) .bookdetails .entry-header .entry-categories-inner a {
    color: <?php the_field('accent_color'); ?>;
  }

  .single hr.styled-separator,
  .single .comment-respond .comment-notes a,
  .single .comment-respond .logged-in-as a,
  .single .pagination-single-inner a,
  .comment-respond,
  .comment-notes a,
  .comment-respond,
  .logged-in-as a,
  .post-<?php the_ID(); ?> div.watch-action .status,
  .post-<?php the_ID(); ?> div.watch-action .unlbg-style1 .unlc,
  .post-<?php the_ID(); ?> div.watch-action .lbg-style1 .lc {
    color: <?php the_field('text_color'); ?>;
  }

  .single input[type="submit"] {
    background-color: <?php the_field('accent_color'); ?>;
  }

</style>

	<?php
  $thumbnail = get_field('book_cover');
  ?>
    <div class="bookcover"><img class="thumbnail" src="<?php echo $thumbnail['url']; ?>" /></div><div class='bookdetails'>
  <?php
  $entry_header_classes = '';

  if ( is_singular() ) {
	   $entry_header_classes .= ' header-footer-group';
   }

   ?>

   <header class="entry-header <?php echo esc_attr( $entry_header_classes ); ?>">

  	<div>

      <?php

  		if ( is_singular() ) { ?>
        <h1 style="color: <?php the_field('text_color'); ?> ;"> <?php the_title(); ?></h3>
          <?php
  		} else {
        ?>
          <h3><a style="color: <?php the_field('text_color'); ?> ;" href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
        <?php
  		}
      ?>
      <h3 style="font-style:italic;">
        By: <?php the_field('book_author');?>
      </h3>
      <h4>
        <?php the_field('date'); ?>
      </h4>
      <?php
        /**
         * Allow child themes and plugins to filter the display of the categories in the entry header.
         *
         * @since 1.0.0
         *
         * @param bool   Whether to show the categories in header, Default true.
         */
      $show_categories = apply_filters( 'twentytwenty_show_categories_in_entry_header', true );

      if ( true === $show_categories && has_category() ) {
        ?>

        <div class="entry-categories">
          <span class="screen-reader-text"><?php _e( 'Categories', 'twentytwenty' ); ?></span>
          <div class="entry-categories-inner">
            <?php the_category( ' ' ); ?>
          </div><!-- .entry-categories-inner -->
        </div><!-- .entry-categories -->

        <?php
      }
  		$intro_text_width = '';

  		if ( is_singular() ) {
  			$intro_text_width = ' small';
  		} else {
  			$intro_text_width = ' thin';
  		}

  		if ( has_excerpt() && is_singular() ) {
        if (the_field('goodreads_link')) { ?>
          <a href="<?php the_field('goodreads_link'); ?>"><i class="fab fa-goodreads"></i></a>
        }
  			<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
  				<?php the_excerpt(); ?>
  			</div>

  			<?php
  		}
  		?>

  	</div><!-- .entry-header-inner -->

  </header><!-- .entry-header -->

	<div>

		<div>
			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}

      edit_post_link();
      ?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->
</div><!-- .bookdetails -->
	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
