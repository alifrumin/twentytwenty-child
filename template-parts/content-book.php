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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


	<?php
  $thumbnail = get_field('book_cover');
  ?>
    <img class="thumbnail" src="<?php echo $thumbnail['url']; ?>" />
  <?php
  $entry_header_classes = '';

  if ( is_singular() ) {
	   $entry_header_classes .= ' header-footer-group';
   }

   ?>

   <header class="entry-header has-text-align-center<?php echo esc_attr( $entry_header_classes ); ?>">

  	<div class="entry-header-inner section-inner medium">

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

  		if ( is_singular() ) {
  			the_title( '<h1 class="entry-title">', '</h1>' );
  		} else {
  			the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
  		}
      ?>
      <h2>
        <?php the_field('book_author');?>
      </h2>
      <h3>
      </h3>
      <?php
  		$intro_text_width = '';

  		if ( is_singular() ) {
  			$intro_text_width = ' small';
  		} else {
  			$intro_text_width = ' thin';
  		}

  		if ( has_excerpt() && is_singular() ) {
  			?>

  			<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
  				<?php the_excerpt(); ?>
  			</div>

  			<?php
  		}

  		// Default to displaying the post meta.
  		twentytwenty_the_post_meta( get_the_ID(), 'single-top' );
  		?>

  	</div><!-- .entry-header-inner -->

  </header><!-- .entry-header -->

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">
      <?php the_field('background_color'); ?>
      <?php the_field('text_color'); ?>
      <?php the_field('date'); ?>
			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
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

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

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
