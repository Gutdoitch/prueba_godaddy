<?php

$bottomheaderlayout = get_theme_mod( 'bottom_header_layout','one');
?>

<div class="d-none d-lg-block">
    <?php if ($bottomheaderlayout == 'two'): ?>
    <div class="to-flex-row th-flex-equal-sides">
        <?php else : ?>
        <div class="to-flex-row  th-flex-flex-middle">
            <?php endif; ?>

            <div class="to-flex-col th-col-left ">

                <?php mayosis_header_elements('header_elements_bottom_left'); ?>

            </div>

            <div class="to-flex-col th-col-center ">

                <?php mayosis_header_elements('header_elements_bottom_center'); ?>

            </div>

            <div class="to-flex-col th-col-right ">

                <?php mayosis_header_elements('header_elements_bottom_right'); ?>

            </div>


            

        </div><!-- .to-flex-row -->

    </div>
    
    <div class="d-block d-md-none">
<div class="to-flex-row th-flex-equal-sides">
        <div class="to-flex-col  flex-grow">
            <?php mayosis_header_elements('header_mobile_elements_bottom'); ?>
        </div>
         </div>
    </div>
