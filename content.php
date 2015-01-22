<article id="post-<?php the_ID(); ?>" <?php if ( is_single() ) : post_class(); else: post_class('well page active'); endif; ?>>
	<?php if ( has_post_thumbnail() ) : ?>	
			
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			
				<?php the_post_thumbnail('image'); ?>
			
			</a>
			
			<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>
														
				<p class="caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
				
			<?php endif; ?>
			
	<?php endif; ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Read More', 'material' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'material' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'material' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->
