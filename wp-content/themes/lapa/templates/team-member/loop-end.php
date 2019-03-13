<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*
 * Template loop-end
 */
global $lapa_member_loop_index, $lapa_loop;
$lapa_member_loop_index = '';
$loop_style = isset($lapa_loop['loop_style']) ? $lapa_loop['loop_style'] : 1;
?>
</div>
<!-- .team-member-loop -->
