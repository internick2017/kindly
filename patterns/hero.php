<?php
/**
 * Title: Hero — Welcome
 * Slug: kindly/hero
 * Categories: kindly, banner
 * Description: Full-width welcome hero with a mission statement and a primary call to action.
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-bg.jpg' ); ?>","dimRatio":60,"gradient":"hero","minHeight":80,"minHeightUnit":"vh","contentPosition":"center center","align":"full","isDark":true,"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}}} -->
<div class="wp-block-cover alignfull is-dark" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:80vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-bg.jpg' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim has-background-gradient has-hero-gradient-background"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained","contentSize":"820px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","textColor":"base","style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontSize":"0.9rem","fontWeight":"700"}}} -->
<p class="has-text-align-center has-base-color has-text-color" style="font-size:0.9rem;font-weight:700;letter-spacing:3px;text-transform:uppercase"><?php esc_html_e( 'A place to belong', 'kindly' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"textColor":"base","fontSize":"xx-large","style":{"typography":{"lineHeight":"1.05"}}} -->
<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color has-xx-large-font-size" style="line-height:1.05"><?php esc_html_e( 'Welcome — come as you are', 'kindly' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}}} -->
<p class="has-text-align-center has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'A community gathered around faith, service, and belonging.', 'kindly' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"backgroundColor":"accent","textColor":"contrast","style":{"typography":{"fontSize":"1.05rem"}}} -->
<div class="wp-block-button" style="font-size:1.05rem"><a class="wp-block-button__link has-contrast-color has-accent-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Plan your visit', 'kindly' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"base","className":"is-style-outline","style":{"typography":{"fontSize":"1.05rem"},"border":{"color":"var:preset|color|base","width":"2px"}}} -->
<div class="wp-block-button is-style-outline" style="font-size:1.05rem"><a class="wp-block-button__link has-base-color has-text-color has-border-color wp-element-button" style="border-color:var(--wp--preset--color--base);border-width:2px"><?php esc_html_e( 'Get involved', 'kindly' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
