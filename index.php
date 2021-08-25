<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();

        if (in_category('portfolio')) {
            get_template_part('template-parts/content-portfolio');
        } else {
            get_template_part('template-parts/content');
        }
    }
} else {
    get_template_part('template-parts/content-none');
}

get_footer();
