<?php
/**
* Plugin Name: Simple Contact Form
* Version: 1.0.0
* Description: Simple contact form plugin for wordpress
* Author: Mohamed Karabawy
* Author URI: https://github.com/MohamedKarabawy
* Plugin URI: https://github.com/MohamedKarabawy
* Text Domain: simple-contact-form
* Domain Path: /languages
* License: GPL V3
*/

function simple_contact_form()
{
    $content = '';
	
    if(isset($_POST['simple_contact_form_submit']))
    $content .= '<h3>Thank you For Submiting Your Infomration.</h3>';

    $content .= '<form method="post" action="https://'.$_SERVER["HTTP_HOST"].add_query_arg( $wp->query_vars ).'" enctype="multipart/form-data">';

    $content .= '<label for="full_name">Name </label>';
    $content .= '<input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Your Name"><br>';


    $content .= '<label for="email">Email </label>';
    $content .= '<input type="email" name="email" id="email" class="form-control" placeholder="email@example.com"><br>';


    $content .= '<label for="phone">Phone </label>';
    $content .= '<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number"><br>';


    $content .= '<label for="message">Message </label>';
    $content .= '<textarea name="message" id="message" rows="10" class="form-control" style="resize:none" placeholder="Type Your Message..."></textarea><br>';

    $content .= '<input type="submit" name="simple_contact_form_submit" id="phone" class="form-control" value="Send Message">';


    $content .= '</from>';
	

    return $content;
}

//first argument the shortcode
//second argument callback function
add_shortcode('simple-contact-form','simple_contact_form');

//head -> html head in wordpress
//css_simple_contact_form -> callback function
add_action('wp_head','css_bootstrap_simple_contact_form');

function css_bootstrap_simple_contact_form()
{
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
}

//head -> html head in wordpress
//contact_form_capture -> callback function
add_action('wp_head','contact_form_capture');



function wp_from_email_address( $email ) {
    return 'MohamedKarabawy@hotmail.com';
}
 
function wp_from_mail_name( $name ) {
    return 'Mohamed Karabawy';
}
 
add_filter( 'wp_mail_from', 'wp_from_email_address' );
add_filter( 'wp_mail_from_name', 'wp_from_mail_name' );


function contact_form_capture()
{
    if(isset($_POST['simple_contact_form_submit']))
    {
        $name = sanitize_text_field($_POST['full_name']);
        $email = sanitize_text_field($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $message = sanitize_textarea_field($_POST['message']);

        $to = 'mohamedkarabawy@hotmail.com';

        $subject = 'Form submission';

        $message = $name.' - '.$email.' - '.$phone.' - '.$message;

        wp_mail($to,$subject,$message);
    }
    
}



?>