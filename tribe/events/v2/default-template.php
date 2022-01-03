<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();
?>
<div class="event-info custom-wysiwig a-up">
    <div class="container">
        <h1 style="text-align: center;">Events</h1>
        <h6 style="text-align: center;">EVENTS AT BOSTON HARBOR hotel</h6>
        <p style="text-align: center;">Cras vitae mi euismod, maximus lacus posuere, rutrum est. Mauris vulputate congue massa, malesuada euismod erat rhoncus fringilla. Quisque maximus nulla nisi, ac venenatis quam vehicula sed. Praesent odio arcu, rutrum nec nunc a, tristique hendrerit.</p>
    </div>
</div>

<?php
echo tribe( Template_Bootstrap::class )->get_view_html();

get_footer();
