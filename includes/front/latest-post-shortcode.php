<?php
add_shortcode('wpvcps_scroll', 'wpvcps_scroll_func' );

function wpvcps_scroll_func($atts){

    $randomNum = rand( 0,10000 );

    ob_start();

?>
     <div id="scroll-container_<?php echo $randomNum; ?>" class="wpvcps-scroll-container">
        <ul>
            <?php
                $wpvcps_cpt_val = get_option('wpvcps_cpt_select_value');
                if( empty($wpvcps_cpt_val) ){
                    $wpvcps_cpt_val = 'post';
                }

                $wpvcps_posts_per_page = empty(get_option('wpvcps_cpt_no_of_post')) ? '5' : get_option('wpvcps_cpt_no_of_post');

                $wpvcps_query = array(
                    'posts_per_page' => $wpvcps_posts_per_page,
                    'post_type' => $wpvcps_cpt_val,
                    'post_status' => 'publish',
                    'orderby' => 'publish_date',
                    'order' => 'DESC',
                );
                
                $wpvcps_post_query = new WP_Query( $wpvcps_query );
                while($wpvcps_post_query->have_posts()) : $wpvcps_post_query->the_post();
                $wpvcps_post_thumb = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
            ?>
                <li>
                    <div class="wpvcps-post-thumb">
                        <?php if(!empty($wpvcps_post_thumb)): ?>
                        <div class="wpvcps-thumb">
                            <img src="<?php echo $wpvcps_post_thumb; ?>" alt="<?php the_title(); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="wpvcps-content">
                            <div class="wpvcps-scroller-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <div class="wpvcps-post-desc">
                                <?php echo wp_trim_words( get_the_content(), 20, '...' ); ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php       
                endwhile;
                wp_reset_postdata();
            ?>
        </ul>
    </div>
    <script type="text/javascript">

            <?php $intval= uniqid('interval_');?>
        
            var <?php echo $intval;?> = setInterval(function() {

            if(document.readyState === 'complete') {

                clearInterval(<?php echo $intval;?>);
                jQuery("#scroll-container_<?php echo $randomNum; ?>").css('visibility','visible');
                jQuery(function(){
                    jQuery('#scroll-container_<?php echo $randomNum; ?>').vTicker({ 
                            speed: 700,
                            pause: 4000,
                            animation: '',
                            mousePause: true,
                            height: 400,
                            direction:'up'
                    });                                            
                });
            }    
        }, 100);

    </script>
    <?php
    $output = ob_get_clean();
    return $output; 
}