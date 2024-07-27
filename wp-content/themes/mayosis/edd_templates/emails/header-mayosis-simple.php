<?php
/**
 * Email Header
 *
 * @author 		Easy Digital Downloads
 * @package 	Easy Digital Downloads/Templates/Emails
 * @version     2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$acccolor=get_theme_mod( 'accent_color','#5a00f0');
$acctextcolor=get_theme_mod( 'accent_color_text','#ffffff');
$primarytextcolor = get_theme_mod('regular_text_color','#28375a');
$primarycoloropacitygradient = mayosis_hexto_rgb($acctextcolor, 0.5);
// For gmail compatibility, including CSS styles in head/body are stripped out therefore styles need to be inline. These variables contain rules which are added to the template inline. !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
$body = "
	background-color: #ffffff;
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: $primarytextcolor;
";
$wrapper = "
	width:100%;
	-webkit-text-size-adjust:none !important;
	margin:0;
	padding: 70px 0 70px 0;
";
$template_container = "
	box-shadow:0 0 0 1px #f3f3f3 !important;
	border-radius:3px !important;
	background-color: #F0F1FA;
	border: 1px solid #F0F1FA;
	border-radius:3px !important;
	padding: 0 0px 20px 0px;
";
$template_header = "
	color: #ffffff;
	border-top-left-radius:3px !important;
	border-top-right-radius:3px !important;
	border-bottom: 0;
	font-weight:bold;
	line-height:100%;
	text-align: center;
	vertical-align:middle;
	
";
$body_content = "
	border-radius:3px !important;
font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
";
$body_content_inner = "
	color: $primarytextcolor;
	font-size:13px;
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
	line-height:150%;
	text-align:left;
    color:#1D134D;
    line-height:18px;
";
$main_logo_style = "
	max-width:100%;
";

$logo_style_pg = "
    background: #fff;
    border-radius: 50%;
    box-shadow: 0px 0px 24px rgba(25, 18, 70, 0.08);
";
$header_content_h1 = "
	color:$primarytextcolor;
	margin:0;
	display:block;
	font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
	font-size: 32px;
    font-weight: 700;
    line-height: 1.2;
    padding: 8.5px 40px;
	text-align:center;
";
$header_img = edd_get_option( 'email_logo', '' );

$header_banner_img = edd_get_option( 'mayosis_header_cover', '' );

$heading    = EDD()->emails->get_heading();
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
   
    <style>
    #template_header{
        padding: 23px 24px 37px 24px;
        width:100%;
    }
        #template_header{
        <?php if($header_banner_img){?>
            background-image:url(<?php echo esc_url($header_banner_img);?>);
            background-repeat:no-repeat;
        <?php } else { ?>

            background-image: linear-gradient(69.68deg, <?php echo esc_html($acccolor);?> 0%, <?php echo esc_html($primarycoloropacitygradient);?> 181.82%);

        <?php } ?>
        }
        .max-recipet-text{
            position:relative;
        }
        .mayosis-simple-top{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .mayosis-payment-property{
            display:flex;
        }
        .mayosis-simple-payment-h h2{
            font-size:32px;
        }
        .mayosis-simple-payment-h{
            padding-left:15px;
        }
        .mayosis-simple-order-s ul{
            list-style:none;
        }
        .mayosis-simple-order-s ul li{
            font-size: 14px;
            font-weight: bold;
            margin: 12px 0;
            background: #F0F1FA;
            padding: 10px;
            border-radius: 3px
        }
        .mayosis-simple-order-s ul li a,.mayosis-simple-order-s div{
            font-size:16px;
            font-weight:400;
        }
        .mayosis-simple-order-s ul li a{
            color:<?php echo esc_html($acccolor);?>;
            text-decoration:none;
        }

        a,.mayosis-email-p-td a{
            color:<?php echo esc_html($acccolor);?>;
            text-decoration:none;
        }
        .reciept-link{
            float:right;
            color:#ffffff;
        }
        .logo-p-box{
            margin-top:-40px;
            border-radius: 50%;
            box-shadow: 0px 0px 24px rgba(25, 18, 70, 0.08);
            position:relative;
            z-index: 99;
        }
        .mayosis-full-description-simple{
            color: #142864;
            font-size: 14px;
    line-height: 24px;
        }
        .mayo-simple-ui{
            padding:0;
            width:100%;
            background:#ffffff;
            border-radius:3px;
            overflow:hidden;
            margin-top: 20px;
        }
        .mayo-simple-ui .every-product-term-thg{
            list-style:none;
            padding:24px;
            border-bottom:1px solid #F0F1FA;
            overflow:hidden;
        }
       
        .email-first-pd-tf{
            width: 80%;
            float: left;
        }
        .extra-information-email-df{
            width:20%;
            float:right;
            text-align:right;
            color:<?php echo esc_html($primarytextcolor);?>;
        }
        .extra-information-email-df a{
            text-decoration: underline;
            font-weight:bold;
        }
        .email-first-pd-tf img{
            float:left;
            border-radius:3px;
        }
        .email-first-pd-tf .m-i-title{
            display: inline-block;
            width: 60%;
            float: left;
            padding-left: 15px;
            margin:0;
            color:<?php echo esc_html($primarytextcolor);?>;
        }
        .bottom-payment-gateway-email{
            width:45%;
            float:left;
            padding: 16px 0;
            line-height: 20px;
            color:<?php echo esc_html($primarytextcolor);?>;
        }
        .bottom-payment-gateway-email span{
            float:left;
            width:100%;
            color:<?php echo esc_html($primarytextcolor);?>;
            font-style:italic;
            font-size: 13px;
            opacity: .65;
        }
        .bottom-tag-detailsout{
            width:45%;
            float:right;
            list-style:none;
        }
        .bottom-tag-detailsout li{
            text-align:right;
            line-height: 24px;
            color:<?php echo esc_html($primarytextcolor);?>;
        }
        .bottom-tag-detailsout li span,.bottom-tag-detailsout li .strong-caps-left{
            width:50%;
            float:left;
            text-align:left;
            color:<?php echo esc_html($primarytextcolor);?>;
        }
        .view-it-box-sample{
            background:#ffffff;
            padding:20px 40px;
            color:<?php echo esc_html($primarytextcolor);?>;
            text-align: center;
            line-height: 24px;
        }
        .view-it-box-sample a{
            color:<?php echo esc_html($acccolor);?>;
            text-decoration:underline;
            font-style:italic;
        }
        .ms-body-top-part{
            padding:0 20px;
            color:<?php echo esc_html($primarytextcolor);?>;
        }
        .ms-padding{
            padding:20px;
            color:<?php echo esc_html($primarytextcolor);?>;
        }
        .logo-p-box{
        padding:15px;
        }
        @media only screen and (max-width: 600px)  {
        .email-first-pd-tf {
    width: 68%;
    float: left;
}
.extra-information-email-df {
    width: 30%;
    float: right;
}
.email-first-pd-tf .m-i-title{
font-size:13px;
width:100%;
padding-left:0;
}
.email-first-pd-tf img{
display:none;
}
.bottom-tag-detailsout {
    width: 100%;
    float: right;
    list-style: none;
}
.bottom-payment-gateway-email {
    width: 100%;
    float: left;
    }
    #template_header{
        padding: 35px 24px 55px 24px;
        width:100%;
    }
    .view-it-box-sample {
    padding: 20px 20px;
    text-align: center;
    line-height: 20px;
    font-size:12px;
}
.logo-p-box{
        padding:5px !important;
        
        }
       
        }
    </style>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="<?php echo esc_attr($body); ?>">
<div style="<?php echo esc_attr($wrapper); ?>">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tr>
            <td align="center" valign="top">

                <table border="0" cellpadding="0" cellspacing="0" width="520" id="template_container" style="<?php echo esc_attr($template_container); ?>">
                    <?php if ( ! empty ( $heading ) ) : ?>
                        <tr>

                            <td align="center" valign="top" class="max-recipet-text">

                                <!-- Header -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header" style="<?php echo esc_attr($template_header); ?>">
                                    <tr>
                                        <td>



                                            <?php if( ! empty( $header_img ) ) : ?>
                                                <div id="template_header_image" style="max-width:15%;margin:25.5px auto 0 auto;">
                                                    <?php echo '<p style="'.$logo_style_pg.'" class="logo-p-box"><img src="' . esc_url( $header_img ) . '" alt="' . get_bloginfo( 'name' ) . '" style="'.$main_logo_style .'" /></p>'; ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                                <!-- End Header -->
                                <table  border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td><h1 style="<?php echo esc_attr($header_content_h1); ?>"><?php echo esc_attr($heading); ?></h1></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td align="center" valign="top">
                            <!-- Body -->
                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body" style="margin-top: -50px;">
                                <tr>
                                    <td valign="top" style="<?php echo esc_attr($body_content); ?>">

                                        <!-- Content -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td valign="top">
                                                    <div style="<?php echo esc_attr($body_content_inner); ?>">