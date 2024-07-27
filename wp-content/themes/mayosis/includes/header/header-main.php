<?php

$mainheaderlayout = get_theme_mod( 'main_header_layout_type','one');
$middlealign = get_theme_mod( 'middle_header_align','flexleft');
$leftalign = get_theme_mod( 'left_header_align','flexleft');
$rightalign = get_theme_mod( 'right_header_align','flexright');
$mobilealign = get_theme_mod( 'mobile_header_align','flexright');

?>
<div class="d-none d-lg-block">
    <?php if ($mainheaderlayout == 'two'): ?>
    <div class="to-flex-row th-flex-equal-sides">
        <?php else : ?>
        <div class="to-flex-row  th-flex-flex-middle">
            <?php endif; ?>

            <!-- Start Desktop Content -->
            <div class="to-flex-col th-col-left  default-logo-box  <?php echo  esc_html($leftalign); ?>">
                <?php mayosis_header_elements('header_elements_left'); ?>
            </div>




            <div class="to-flex-col th-col-center  <?php echo  esc_html($middlealign); ?>">

                <?php mayosis_header_elements('header_elements_center'); ?>

            </div>


            <div class="to-flex-col th-col-right  <?php echo  esc_html($rightalign); ?>">

                <?php mayosis_header_elements('header_elements_right'); ?>

            </div>
        </div>
    </div>
    <!-- End Desktop Content -->

    <!-- Start Mobile Content -->
    <div class="d-block d-lg-none">
        <?php if ($mainheaderlayout == 'two'): ?>
        <div class="to-flex-row th-flex-equal-sides">
            <?php else : ?>
            <div class="to-flex-row  th-flex-flex-middle">
                <?php endif; ?>
                <div class="to-flex-col th-col-left">

                    <?php mayosis_header_elements('header_mobile_elements_left','mobile'); ?>

                </div>

                <div class="to-flex-col th-col-center ">

                    <?php mayosis_header_elements('header_mobile_elements_center','mobile'); ?>

                </div>


                <div class="to-flex-col th-col-right  <?php echo  esc_html($mobilealign); ?>">

                    <?php mayosis_header_elements('header_mobile_elements_right','mobile'); ?>

                </div>

            </div>
        </div>

        <!-- End Mobile Content -->
     