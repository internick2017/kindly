<?php
/**
 * Title: Newsletter — Stay connected
 * Slug: kindly/newsletter
 * Categories: kindly, call-to-action
 * Description: A centered signup callout. Add your newsletter plugin block in the placeholder.
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Stay connected', 'kindly' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'Get news, events, and ways to help in your inbox each month.', 'kindly' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"backgroundColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-base-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","textColor":"primary"} -->
<p class="has-text-align-center has-primary-color has-text-color"><?php esc_html_e( 'Add your newsletter plugin block here.', 'kindly' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
