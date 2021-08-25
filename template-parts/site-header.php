<?php
    $blog_info = get_bloginfo( 'name' );
    $headshot_url = get_stylesheet_directory_uri() . '/assets/headshot.jfif';
?>

<header>
    <nav class="navbar navbar-expand navbar-light fixed-top bg-light">
        <div class="align-items-sm-center align-items-start container flex-column flex-sm-row">
            <a class="navbar-brand d-flex align-items-center"
                href="<?php echo get_site_url(); ?>">
                <img class="rounded-circle me-1" height="40" src="<?php echo $headshot_url; ?>" width="40">
                <?php echo esc_html( $blog_info ); ?>
            </a>

            <?php
                wp_nav_menu(
                    array(
                        'container' => false,
                        'fallback_cb' => false,
                        'items_wrap' => '<div class="navbar-nav flex-row">%3$s</div>',
                        'theme_location'  => 'primary',
                        'walker' => new WPDocs_Walker_Nav_Menu(),
                    )
                );
                ?>
        </div>
    </nav>
</header>

<?php
require_once ABSPATH . WPINC . '/class-walker-nav-menu.php';

class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;

        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
        $atts['class']        = 'nav-link' . ($item->current ? ' active' : '');

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = '<a' . $attributes . '>';
        $item_output .= $title;
        $item_output .= '</a>';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "{$n}";
    }
}
