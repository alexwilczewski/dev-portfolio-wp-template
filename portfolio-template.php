<?php
/* Template Name: Portfolio Template */

get_header();
?>

<div class="container mb-1">
    <h1>Portfolio.</h1>
</div>

<div class="container">
    <div class="d-flex justify-content-around flex-wrap">

<?php
    $query = new WP_Query(array(
        'category_name' => 'portfolio',
        'order' => 'DESC',
        'post_type' => 'post',
    ));

    while ($query->have_posts()) :
        $query->the_post();
?>
    <a class="card btn"
        style="width: 20em;margin: .5em;padding: 0;text-align: left;"
        href="<?php the_permalink(); ?>">
        <div class="card-header"><?php the_title(); ?></div>
        <img alt="Thumbnail"
            class="card-img-top"
            src="<?php echo get_field('card_thumbnail_image'); ?>"/>
        <div class="card-body">
            <p class="card-text"><?php echo get_field('card_description'); ?></p>
            <div class="d-grid">
                <button class="btn btn-secondary">Visit</button>
            </div>
        </div>
    </a>
<?php endwhile; ?>

    </div>
</div>

<div class="pb-5"></div>

<?php
get_footer();
