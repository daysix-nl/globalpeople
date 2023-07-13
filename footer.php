<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GlobalPeople
 */

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js" integrity="sha512-jGR1T3dQerLCSm/IGEGbndPwzszJBlKQ5Br9vuB0Pw2iyxOy+7AK+lJcCC8eaXyz/9du+bkCy4HXxByhxkHf+w==" crossorigin="anonymous"></script>
<?php wp_footer(); ?>

<script type="text/javascript"> _linkedin_partner_id = "2503796"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script> 
<noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=2503796&fmt=gif" /> </noscript>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1721822168002844');
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none" 
       src="https://www.facebook.com/tr?id=1721822168002844&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->


</body>
<footer>
    <div class="footer-white">
        <div class="container">
            <div class="top">
                <div class="left">
                    <img src="<?=get_field('footer_logo', 6)?>" alt="GP Logo">
                </div>

                <div class="right">
                    <a href="<?=get_field('footer_join_network_button', 6)['url']?>" class="button-1 mt0">
                        <span> <?=get_field('footer_join_network_button', 6)['title']?> </span>
                        <div></div>
                    </a>
                </div>
            </div>

            <div class="center">
                <div class="left">
                    <h1> <?=get_field('footer_title', 6)?> </h1>
                    <?php if( have_rows('def_socials', 'option') ): ?>
                        <div class="socials">
                            <?php while( have_rows('def_socials', 'option') ): the_row(); 
                                $image = get_sub_field('icon', 'option');
                                $url = get_sub_field('url', 'option');
                            ?>

                                <a target="_blank" href="<?=$url?>">
                                    <img src="<?=$image ?>" alt="fb icon">
                                </a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="right">
                    <div>
                        <b> <?=get_field('footer_menu_1_title', 6)?> </b>
                        <?php 

                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer-menu-1',
                                    'container_class' => 'navbar',
                                    'menu_class' => 'menu-list'
                                )
                            );
                        ?>
                       
                    </div>
                    <div>
                        <b> <?=get_field('footer_menu_2_title', 6)?> </b>

                        <?php 
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer-menu-2',
                                    'container_class' => 'navbar',
                                    'menu_class' => 'menu-list'
                                )
                            );
                        ?>

                    </div>
                    <div>
                        <b> <?=get_field('footer_menu_3_title', 6)?> </b>

                        <?php 
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer-menu-3',
                                    'container_class' => 'navbar',
                                    'menu_class' => 'menu-list'
                                )
                            );
                        ?>

                    </div>
                </div>
            </div>

            <div class="bottom">
                <div class="left">
                    <?=get_field('copyright', 6)?>
                </div>

                <div class="right">
                   <?php wp_nav_menu( array('theme_location' => 'footer-menu-legal-links') );?>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>
