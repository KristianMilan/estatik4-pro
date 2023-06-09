<?php

/**
 * @var $entity_name string
 * @var $post_type string
 * @var $can_add_new string
 */

?>
<style>.wp-list-table {display: none;}</style>
<div style="text-align: center; margin-top: 24px;">
	<h2 style="font-size: 20px; margin-bottom: 16px;"><?php printf( __( 'You don’t have any %s yet' ), $entity_name ); ?></h2>
    <?php if ( ! isset( $can_add_new ) || ( isset( $can_add_new ) && $can_add_new ) ) : ?>
	    <a href="<?php echo admin_url( 'post-new.php?post_type=' . $post_type ); ?>" class="es-btn es-btn--primary es-btn--large"><?php printf( __( 'Add new %s' ), $entity_name ); ?></a>
    <?php endif; ?>
</div>
