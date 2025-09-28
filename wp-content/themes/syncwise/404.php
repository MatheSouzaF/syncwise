<?php
wp_enqueue_style('404', get_template_directory_uri() . '/assets/dist/css/404/404.css', ['main'], ASSETS_VERSION);

get_header();

?>

<section>
    <div class="background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/bg-404.webp" alt="Let’s work together">
    </div>
    <div class="box-text">
        <h1>Oops! Page not found</h1>
        <p>Looks like the page you are trying to access doesnt exist</p>
        <a href="/">
            <p>Back to Homepage</p>
        </a>
    </div>
</section>
<?php
get_footer();

?>