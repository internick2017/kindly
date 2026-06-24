<?php
/**
 * Title: Announcements
 * Slug: kindly/announcements
 * Categories: kindly
 * Description: A compact list of the latest announcements. Layout only.
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Announcements', 'kindly' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":0,"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-query" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true,"fontSize":"medium"} /-->

<!-- wp:post-date {"fontSize":"small","textColor":"primary"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->
<!-- /wp:query --></div>
<!-- /wp:group -->
