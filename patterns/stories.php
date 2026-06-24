<?php
/**
 * Title: Stories — Testimonials
 * Slug: kindly/stories
 * Categories: kindly, testimonials
 * Description: Two short stories or testimonials side by side.
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Stories from our community', 'kindly' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote {"className":"is-style-large"} -->
<blockquote class="wp-block-quote is-style-large"><!-- wp:paragraph -->
<p><?php esc_html_e( 'When we lost everything in the flood, this community showed up before we even asked. I will never forget it.', 'kindly' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'María, neighbor', 'kindly' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote {"className":"is-style-large"} -->
<blockquote class="wp-block-quote is-style-large"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Volunteering here gave me a place to belong. I came to give, and I received so much more.', 'kindly' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'David, volunteer', 'kindly' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
