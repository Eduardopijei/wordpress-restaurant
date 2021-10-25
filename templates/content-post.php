<?php 
$pid = get_the_ID();
$url = get_the_permalink( $pid );
$title = get_the_title( $pid ); ?>
<section class="post-detail">
    <div class="container">
        <ul class="post-nav">
            <li class="post-nav__prev" data-aos="fade-left">
                <?php previous_post_link('%link', '< Back'); ?>
            </li>
            <li class="post-nav__next" data-aos="fade-right">
                <?php next_post_link('%link', 'Next &gt;'); ?>
            </li>
        </ul>
        <div class="post-detail__inner">
            <div class="post-image" data-aos="fade-down" data-aos-delay="200">
                <img src="<?php echo get_the_post_thumbnail_url( $pid, 'full' ); ?>" alt="<?php echo $title; ?>">
            </div>
            <div class="post-contents" data-aos="fade-down" data-aos-delay="400">
                <?php $categories = get_the_category( $pid );
                if ($categories) : ?>
                <div class="post-category">
                    <?php foreach ($categories as $category) : ?>
                        <span class="text-uppercase"><?php echo $category->name; ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <h1 class="post-title h-2"><?php the_title($pid); ?></h1>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                <div class="post-date">Published on <?php echo get_the_date( 'F j, Y', $pid ); ?></div>
                <div class="post-share">
                    <!-- Facebook Share -->
                    <a href="http://www.facebook.com/share.php?u=<?php echo $url; ?>&title=<?php echo $title; ?>" class="post-share__link" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.59 54.59"><g id="Layer_2" data-name="Layer 2"><g id="Content"><path id="facebook-circle-icon" fill="#00B9BD" d="M27.29,0a27.3,27.3,0,1,0,27.3,27.29A27.29,27.29,0,0,0,27.29,0Zm8.08,16.06H31.56c-1.35,0-1.63.55-1.63,1.94v3.37h5.44l-.52,5.91H29.93V44.93h-7V27.35H19.22v-6h3.66V16.66c0-4.43,2.37-6.74,7.61-6.74h4.88v6.14Z"/></g></g></svg>
                    </a>
                    <!-- Twitter Share -->
                    <a href="http://twitter.com/home?status=<?php echo $title; ?>+<?php echo $url; ?>" class="post-share__link" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.41 54.41"><g id="Layer_2" data-name="Layer 2"><g id="Content"><path id="twitter-4-icon" fill="#00B9BD" d="M27.2,0A27.21,27.21,0,1,0,54.41,27.2,27.2,27.2,0,0,0,27.2,0ZM40.89,22.52c.39,8.87-6.22,18.77-17.94,18.77a17.86,17.86,0,0,1-9.67-2.84,12.65,12.65,0,0,0,9.34-2.61,6.31,6.31,0,0,1-5.89-4.38,6.48,6.48,0,0,0,2.85-.11,6.31,6.31,0,0,1-5.06-6.27,6.26,6.26,0,0,0,2.85.79,6.32,6.32,0,0,1-2-8.42,17.92,17.92,0,0,0,13,6.59,6.31,6.31,0,0,1,10.75-5.76,12.44,12.44,0,0,0,4-1.53,6.3,6.3,0,0,1-2.77,3.49,12.52,12.52,0,0,0,3.62-1A12.68,12.68,0,0,1,40.89,22.52Z"/></g></g></svg>
                    </a>
                    <!-- Linkedin Share -->
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>" class="post-share__link" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.41 54.41"><g id="Layer_2" data-name="Layer 2"><g id="Content"><path fill="#00B9BD" d="M27.2,0A27.21,27.21,0,1,0,54.41,27.2,27.2,27.2,0,0,0,27.2,0ZM20.7,40H15.49V20.92H20.7ZM18.1,18.71a3.06,3.06,0,1,1,3-3.06A3,3,0,0,1,18.1,18.71ZM41.55,40H36.33V30.29c0-5.85-6.94-5.41-6.94,0V40H24.18V20.92h5.21V24c2.42-4.49,12.16-4.82,12.16,4.3Z"/></g></g></svg>
                    </a>
                    <!-- Youtube Share -->
                    <a href="" class="post-share__link" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.59 54.59"><g id="Layer_2" data-name="Layer 2"><g id="Content"><polygon fill="#00B9BD" points="24.11 33.21 33.49 27.79 24.11 22.38 24.11 33.21"/><path fill="#00B9BD" d="M27.29,0a27.3,27.3,0,1,0,27.3,27.29A27.29,27.29,0,0,0,27.29,0ZM45,36.48a4.53,4.53,0,0,1-3.19,3.19c-2.82.76-14.11.76-14.11.76s-11.28,0-14.1-.76a4.53,4.53,0,0,1-3.19-3.19c-.75-2.81-.75-8.69-.75-8.69s0-5.87.75-8.69a4.54,4.54,0,0,1,3.19-3.19c2.82-.75,14.1-.75,14.1-.75s11.29,0,14.11.75A4.54,4.54,0,0,1,45,19.1c.75,2.82.75,8.69.75,8.69S45.77,33.67,45,36.48Z"/></g></g></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>