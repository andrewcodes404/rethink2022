<div>
<h2>this is the programme global</h2>

</div>


<?php

$posts = get_posts(array(
	'posts_per_page'	=> -1,
	'post_type'			=> 'session-2022'
));

if( $posts ): ?>
 <?php $post_id = get_the_ID(); ?>
	<ul>

	<?php foreach( $posts as $post ):

		setup_postdata( $post );

		?>
		<li>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>

	<?php endforeach; ?>

	</ul>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>
