<?php
//Template Name: Terms of Use
wp_enqueue_style('terms-of-use', get_template_directory_uri() . '/assets/dist/css/pages-policy/terms-of-use.css', ['main'], ASSETS_VERSION);

get_header();

?>

<section class="china-policy">
    <div class="wrapper">
        <div class="title-page">

            <h1 class="blue-txt"><?php echo get_field('title_terms_of_use'); ?></h1>
        </div>
        <div class="description-china-policy">
            <?php echo get_field('content_terms_of_use'); ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>