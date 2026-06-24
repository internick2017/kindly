<?php
/**
 * Title: Hero — Welcome
 * Slug: kindly/hero
 * Categories: kindly, banner
 * Description: Full-width welcome hero with a mission statement and a primary call to action.
 */
?>
<!-- wp:cover {"gradient":"hero","dimRatio":100,"minHeight":70,"minHeightUnit":"vh","contentPosition":"center center","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);min-height:70vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient has-hero-gradient-background"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"base","fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Welcome — come as you are', 'kindly' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large"} -->
<p class="has-text-align-center has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'A community gathered around faith, service, and belonging.', 'kindly' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"backgroundColor":"accent","textColor":"contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-accent-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Plan your visit', 'kindly' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
