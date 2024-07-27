<?php
/**
 * Email Footer
 *
 * @author 		Easy Digital Downloads
 * @package 	Easy Digital Downloads/Templates/Emails
 * @version     2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// For gmail compatibility, including CSS styles in head/body are stripped out therefore styles need to be inline. These variables contain rules which are added to the template inline.

$primarytextcolor = get_theme_mod('regular_text_color','#28375a');
$template_footer = "
	border-top:0;
	-webkit-border-radius:3px;
    color:$primarytextcolor;
";

$credit = "
	border:0;
	color: #000000;
	font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
	font-size:12px;
	line-height:125%;
	text-align:center;
";

global $edd_options;
?>
</div>
</td>
</tr>
</table>
<!-- End Content -->
</td>
</tr>
</table>
<!-- End Body -->
</td>
</tr>
<tr>
    <td align="center" valign="top">
        <!-- Footer -->
        <table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer" style="<?php echo esc_attr($template_footer); ?>">
            <tr>
                <td valign="top">
                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                        <tr>
                            <td colspan="2" valign="middle" id="credit" style="<?php echo esc_attr($credit); ?>">
                                <?php if ($edd_options['mayosis_simple_mailing_address']){?>
                                    <span style="width:100%;float:left;text-align:center;"> <?php esc_html_e('Our mailing address is: ','mayosis');?></span>
                                    <?php echo esc_attr( $edd_options['mayosis_simple_mailing_address'] )?>
                                   
                                <?php }?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- End Footer -->
    </td>
</tr>
</table>
</td>
</tr>
</table>
</div>
</body>
</html>