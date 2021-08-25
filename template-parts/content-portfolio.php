<?php
    $portfolio_post = get_page_by_path('portfolio');
    $portfolio_url = get_permalink($portfolio_post);
?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $portfolio_url; ?>">Portfolio</a></li>
            <li aria-current="page"
                class="breadcrumb-item active"><?php echo the_title(); ?></li>
        </ol>
    </nav>
</div>

<?php get_template_part('template-parts/content'); ?>
