<?php
/**
 * Template Name: Eventbrite Events
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
			</header><!-- .page-header -->

			<?php
				// Set up and call our Eventbrite query.
				$events = new Eventbrite_Query( apply_filters( 'eventbrite_query_args', array(
					 'display_private' => true, // boolean
					// 'nopaging' => false,        // boolean
					// 'limit' => null,            // integer
					// 'organizer_id' => null,     // integer
					// 'p' => null,                // integer
					// 'post__not_in' => null,     // array of integers
					// 'venue_id' => null,         // integer
					// 'category_id' => null,      // integer
					// 'subcategory_id' => null,   // integer
					// 'format_id' => null,        // integer
				) ) );


				if ( $events->have_posts() ) :
					while ( $events->have_posts() ) : $events->the_post(); ?>


					<div class='group container innerblock' id='event- <?php get_the_ID() ?>  "'>
						<div class='group large " <?php $events->eventbrite_get_post_style()?> "'>
				                <div class ='group photocontainer'>
				                            <?php get_the_post_thumbnail(); ?>
												</div>
				                           <div class='group details'>
				                                <div class ='group detailtext'>

				                                   <p class = 'group detailtext'>
				                                      <?php //$post_string .= eventbrite_event_day(); ?>
				                                       <br>
				                                       <?php //$post_string .=  eventbrite_event_time() .  "</p>"; ?>


				                			 	 <div class='group title'>
				                  	    	<div class='group titletext'>
				                         		<?php get_the_title(); ?>
				    </div></div></div></div></div>


					<?php endwhile;

					// Previous/next post navigation.
					eventbrite_paging_nav( $events );

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;

				// Return $post to its rightful owner.
				wp_reset_postdata();
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
