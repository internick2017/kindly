<?php
/**
 * Title: Donate — Support our work (optional)
 * Slug: kindly/donate
 * Categories: kindly, call-to-action
 * Description: Optional donation call to action. Not part of the default home page — add it only if your organization fundraises. Point the button at your donation page or plugin.
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"accent","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"680px"}} -->
<div class="wp-block-group alignfull has-accent-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":2,"textColor":"contrast"} -->
<h2 class="wp-block-heading has-text-align-center has-contrast-color has-text-color"><?php esc_html_e( 'Support our work', 'kindly' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"contrast","fontSize":"large"} -->
<p class="has-text-align-center has-contrast-color has-text-color has-large-font-size"><?php esc_html_e( 'Your generosity keeps our programs running. Every gift makes a difference.', 'kindly' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"backgroundColor":"contrast","textColor":"base"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-contrast-background-color has-text-color has-background wp-element-button" href="#"><?php esc_html_e( 'Donate', 'kindly' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
