<?php
//Template Name: China Policy
wp_enqueue_style('china-policy', get_template_directory_uri() . '/assets/dist/css/pages-policy/china-policy.css', ['main'], ASSETS_VERSION);

get_header();

?>

<section class="china-policy">
    <div class="wrapper">
        <div class="title-page">

            <h1 class="blue-txt"><?php echo get_field('title_china_policy'); ?></h1>
        </div>
        <div class="description-china-policy">
            <?php echo get_field('content_china_policy'); ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>