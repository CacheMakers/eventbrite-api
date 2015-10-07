<!--  Notes

           *****Current****
               Working on image slider 
               finish two css styles. one for full screen
               switch on the fly
              
               

                TODO
                *finish css group meta
                *add announcement text
                *create tempalte files for slider, sidebar 
                *fix overlapping group meta slider 
                *dual slider css to make announcements fall beneath slider when resized
                *onclick go to next announcement / add overlay arrows
                
                LOG
10/1/15  - instantiate new query object and create new loop to get announcements in announcements block

            enque styles and javascript - call within eventbrite-index template
            add functions in functions_php
            Having trouble getting link to single event details page
            
10/2/15  - Add Image slider announcements. Slick Slider?
           working on Link Text color style
           

                
                General Notes

eventbrite_event_meta() located in eventbrite/functions.php
query methods located in eventbrite/query.php - Create new query for new wordpress loop


           *****Updates******

10/2/15 - added post_num and get_post_num to get group styles in eventbrite-query
10/5/15 - finished group post template. located in eventbrite-api/functions.php



-->



<style>
    .blockwrapper{width:100%; height:100%; /*padding-bottom:300px;*/}

    html, body{height:100%;}
    .group
        {


        }

   .group.container{height:150px; width:300px; display:inline-block;padding-bottom:100px;}
    .group.large
        {
              height:100%; width:100%; font-family:sans-serif; position:relative;
        }

    /* TODO dynamically position blocks to fill row space */
    .group.groupblock-inner {/*padding-left:10px; padding-right:10px;*/}
    .groupblock-left{}
    .groubblock-right{}


    .group.photocontainer
        {
            height:100%; width:100%; position:relative; z-index:2;
        }
    .group.photo{height:100%; width:100%;}
    
    .group.blue{background-color:#75afc9;  color:white;}
    .group.maroon{background-color:#79575d;  color:white;}
    .group.green{background-color:#8f9b50;  color:white;}
    
    
    .group.yellow{background-color:#FF820B;  color:white;}
    .group.yellow a{color: #ffffff;}

    
    .group.red{background-color:#FF2F19; }
    .group.red a:hover{color:#ffffff;}
    .group.red a{color:#ffffff;}

    .group.pastelgreen{background-color:#549431; color:white;}
    .group.pastelgreen a{color: #ffffff;}

    .group.pastelblue{background-color:#265B6A; color:white;}
    .group.pastelblue a{color: #ffffff;}

    
/*  a:link - a normal, unvisited link
    a:visited - a link the user has visited
    a:hover - a link when the user mouses over it
    a:active - a li
*/
    .group.title{text-align:center; margin:0 auto; font-weight:100; font-size:30px; height: 60px; word-spacing:8px; position:relative;}
    .group.details
        {
            text-align:center; font-size:12; font-family:sans-serif;
            position:absolute; bottom:-60px; z-index:1; /*z-index:-10;*/ background-color:inherit; width:inherit;
            color:white;

        }
    .group.details a{ font-size:18; font-family:sans-serif; font-weight:bold;}
    
    .group.detailtext{margin:10px; font-size:16; padding-bottom:0px; line-height:1; padding-top:10px;}
    /*.group.linktext{font-size:18; font-family:sans-serif; font-weight:bold;}*/
    /*.group.linktext  a{color: #000000;}*/
    .cachemakers.container{width:75%;}
    
    

    .cachemakers.slider.holder{width:100%;position:relative; height:auto;}
    .cachemakers.slider.image{/*height:100%; width:100%;*/ width:100%; height:auto;}
     .cachemakers.slider.announcement{background-color:#727272; width:200px; /*display:inline-block;*/ height:383px;}
     
     .cachemakers.slider.slid.full{/*center horizontally*/ margin-left: auto; margin-right:auto; width:60%; /*display:inline-block;*/}
     .cachemakers.left-side{float:left; position:absolute; left:0px; top:0px;}
     .cachemakers.right-side{float:right; position:absolute; right:0px; top:0px;}
     
     /*styles to position announcement divs beneath slider */
     .cachemakers.left-beneath{ /*display:inline-block;*/ margin:auto; width:1000px; }
     .cachemakers.right-beneath{/* display:inline-block;  /*position:absolute; /*right:0px; margin:auto; */ display:none;}
     .cachemakers.slider.slid.full{width:100%; height:auto;}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cache-makers-test-server-nbenoit14.c9.io/slick/slick.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cache-makers-test-server-nbenoit14.c9.io/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cache-makers-test-server-nbenoit14.c9.io/slick/slick-theme.css"/>

<script>
jQuery(document).ready(function()
    {

       /* OnMouseOver Animation  */

            $(".group",this).mouseenter(
                    function()
                        {
                            $("div.details", this).animate({"bottom":'-' + $("div.details",this).height() + 'px'}, 200);

                        });

            $(".group",this).mouseleave(
                    function()
                        {
                           $("div.details", this).animate({"bottom":'-' + $("div.title",this).height() + 'px'}, 200);

                        });

        /*  Slider Script */   
              $('.cachemakers.slider.slid').slick(
                    {
                        centerMode: true,
                         dots: true,
                          infinite: true,
                          speed: 300,
                          slidesToShow: 1,
                          adaptiveHeight:true,
                          arrows:false,
                          breakpoint:400,
                          fade: true,
                        cssEase: 'linear'
                    });
        
        /*if screen size shrinks change announcement box style to fit underneat photo slider*/
            
        //if($(.cachemakers.slider.holder).height() < 1100){console.log($(.cachemakers.slider.holder).height());}

        $(window).resize(function()
            {
                console.log($(window).width());
            });
     
    });
</script>

<?php
/**
 * Template Name: Eventbrite Events
 */

get_header(); ?>


<!--	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<h1 class="page-title">
					<?//php the_title(); ?>
				</h1>
			</header>
-->

<!--<div class="cachemakers container">	-->

    <div class="cachemakers slider holder"> 
        <div class="cachemakers slider slid full"> <!-- Announcement Slider -->
            
            <div><img src="https://cache-makers-test-server-nbenoit14.c9.io/wp-includes/images/3767927_orig.jpg" alt="test" class="cachemakers slider image"></div>
            <div><img src="https://cache-makers-test-server-nbenoit14.c9.io/wp-includes/images/6523880_orig.jpg" alt="test" class="cachemakers slider image"></div>
            <div><img src="https://cache-makers-test-server-nbenoit14.c9.io/wp-includes/images/7020318_orig.jpg" alt="test" class="cachemakers slider image"></div>
                
        </div>
        <div class="cachemakers slider announcement left-beneath"></div>
        <div class="cachemakers slider announcement right-beneath"></div>

   </div>
    <?php get_sidebar(); ?>


<div class="blockwrapper">
			<?php
			
			
				// Set up and call our Eventbrite query.
				$events = new Eventbrite_Query( apply_filters( 'eventbrite_query_args', array(
					// 'display_private' => false, // boolean
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
					
	 
	 <?php /*
        <div class="group container innerblock" id="event-<?php the_ID(); ?>" >
                    <div class="group large <?php $events->eventbrite_get_post_style(); ?>">
                            <div class ="group photocontainer"><?php the_post_thumbnail(); ?></div> 



                            <div class="group details"> 
                                <div class ="group detailtext">
                                  
                                   
                                   <p class = "group detailtext">
                                       <?php echo eventbrite_event_day(); ?>
                                       <br>
                                       <?php echo eventbrite_event_time(); ?>
                                   </p>
                                   
                                   <a href="<?php echo get_the_permalink(); ?>"> Details</a> - <a href="<?php echo eventbrite_event_venue()->name; ?>"</a> <a href="<?php echo eventbrite_event_eb_url(); ?>"> <?php echo eventbrite_event_venue()->name; ?></a> -<a href="<?php echo eventbrite_event_eb_url();?>"> Sign Up</a>
                                   
                                </div>
                                <div class="group title">
                                  <div class="group titletext">
                                      <?php the_title()?>
                                  </div>
                            </div>
                            </div>
                    </div>
                </div>
     
                
*/ ?>
    

                <?php echo eventbrite_group_post($events);?>

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
			
</div>

		</main><!-- #main -->
	</div><!-- #primary -->
 <!--</div> cachemakers container div	-->
<?php get_footer(); ?>
