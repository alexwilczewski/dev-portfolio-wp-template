<!doctype html>
<html <?php language_attributes(); ?> class="h-100">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('d-flex flex-column h-100'); ?>>
<?php wp_body_open(); ?>

<?php get_template_part('template-parts/site-header'); ?>

<main class="flex-shrink-0" role="main">
    <div class="pt-5"></div>
    <div class="pt-5"></div>
    <div class="pt-5 pt-sm-0"></div>
