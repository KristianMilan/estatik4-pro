<?php
$posts_count = wp_count_posts( 'agent' );
$status = filter_input( INPUT_GET, 'post_status' );
$status = $status ? $status : 'all'; ?>

<div class="es-wrap">
    <?php do_action( 'es_before_agents_statuses' ); ?>

    <ul class="es-statuses-filter">
        <?php do_action( 'es_before_agents_statuses_list' ); ?>
        <li>
            <a href="<?php echo admin_url( 'edit.php?post_type=agent' ); ?>" class="<?php es_active_class( $status, 'all', 'es-active' ); ?>">
                <?php _e( 'All agents', 'es' ); ?><span class="es-counter"><?php echo $posts_count->all; ?></span>
            </a>
        </li>
        <li>
            <a href="<?php echo admin_url( 'edit.php?post_type=agent&post_status=publish' ); ?>" class="<?php es_active_class( $status, 'publish', 'es-active' ); ?>">
                <?php _e( 'Active', 'es' ); ?><span class="es-counter"><?php echo $posts_count->publish; ?></span>
            </a>
        </li>
        <li>
            <a href="<?php echo admin_url( 'edit.php?post_type=agent&post_status=draft' ); ?>" class="<?php es_active_class( $status, 'draft', 'es-active' ); ?>">
                <?php _e( 'Inactive', 'es' ); ?><span class="es-counter"><?php echo $posts_count->draft; ?></span>
            </a>
        </li>

        <?php do_action( 'es_after_agents_statuses_list' ); ?>
    </ul>

    <?php do_action( 'es_before_agents_filter' ); ?>

    <form action="">
        <div class="es-filter">
            <?php do_action( 'es_before_agents_filter_form' ); ?>

            <input type="hidden" name="post_type" value="agent"/>

            <?php if ( $order = filter_input( INPUT_GET, 'order' ) ) : ?>
                <input type="hidden" name="order" value="<?php echo $order; ?>"/>
            <?php endif; ?>

            <?php if ( $orderby = filter_input( INPUT_GET, 'orderby' ) ) : ?>
                <input type="hidden" name="orderby" value="<?php echo $orderby; ?>"/>
            <?php endif; ?>

            <div class="es-row" style="align-items: flex-end;">
                <div class="es-col-xl-3 es-col-md-6">
                    <?php es_entities_filter_field_render( 's', array(
                        'label' => __( 'Agent search', 'es' ),
                        'type' => 'text',
                        'attributes' => array(
                            'placeholder' => __( 'Search by ID, name or email', 'es' ),
                        ),
                        'wrapper_class' => 'es-field--small'
                    ) ); ?>
                </div>

                <div class="es-col-xl-3 es-col-md-6">
                    <?php es_entities_filter_field_render( 'agency_id', array(
                        'label' => __( 'Agency', 'es' ),
                        'type' => 'select',
                        'attributes' => array(
                            'placeholder' => _x( 'All', 'agents filter select', 'es' ),
                        ),
                        'options' => es_get_agencies_list(),
                        'wrapper_class' => 'es-field--small'
                    ) ); ?>
                </div>

                <div class="es-col-xl-6 es-col-md-6 es-form-manage es-form-manage--top" style="margin-bottom: 10px;">
	                <?php if ( ! empty( $_GET['entities_filter'] ) ) : ?>
                        <a href="<?php echo admin_url( 'edit.php?post_type=agent' ); ?>"><?php _e( 'Reset', 'es' ); ?></a>
	                <?php endif; ?>
                    <button type="submit" class="es-btn es-btn--third es-btn--icon es-btn--small">
                        <span class="es-icon es-icon_search"></span>
                        <?php _e( 'Search' ); ?>
                    </button>
                </div>
            </div>
            <?php do_action( 'after_agents_filter_form' ); ?>
        </div>
        <?php Es_Agents_Archive_Page::sort_dropdown(); ?>
    </form>

    <?php do_action( 'es_after_agents_filter' ); ?>
</div>