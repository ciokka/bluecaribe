<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_Email_Customer_Reminder extends WC_Email {

    public function __construct() {
        $this->id          = 'customer_reminder';
        $this->title       = 'Customer Reminder';
        $this->description = 'This email is sent to customers as a reminder.';

        $this->template_html  = 'emails/customer-reminder.php';
        $this->template_plain = 'emails/plain/customer-reminder.php';
        $this->template_base  = get_stylesheet_directory() . '/woocommerce/';

        add_action('woocommerce_order_status_pending_to_processing_notification', array($this, 'trigger'), 10, 5);

        // Call parent constructor to load any other defaults not explicity defined here
        parent::__construct();

        // Other settings
        $this->recipient = '';
    }

    public function trigger( $order_id, $customer_mail, $product_name, $product_id, $pickup_date ) {
        if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
            return;
        }

        $this->object         = wc_get_order( $order_id );
        $this->recipient      = $customer_mail;
        $this->placeholders   = array(
            '{order_date}'   => wc_format_datetime( $this->object->get_date_created() ),
            '{order_number}' => $this->object->get_order_number(),
        );
        
        $this->find[] = '{product_name}';
        $this->replace[] = $product_name;
        
        $this->find[] = '{pickup_date}';
        $this->replace[] = $pickup_date;

        $this->setup_locale();
        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        $this->restore_locale();
    }

    public function get_content_html() {
        return wc_get_template_html( $this->template_html, array(
            'order'         => $this->object,
            'email_heading' => $this->get_heading(),
            'sent_to_admin' => false,
            'plain_text'    => false,
            'email'         => $this,
        ), '', $this->template_base );
    }

    public function get_content_plain() {
        return wc_get_template_html( $this->template_plain, array(
            'order'         => $this->object,
            'email_heading' => $this->get_heading(),
            'sent_to_admin' => false,
            'plain_text'    => true,
            'email'         => $this,
        ), '', $this->template_base );
    }

    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'       => 'Enable/Disable',
                'type'        => 'checkbox',
                'label'       => 'Enable this email notification',
                'default'     => 'yes',
            ),
            'subject' => array(
                'title'       => 'Subject',
                'type'        => 'text',
                'description' => sprintf( 'Available placeholders: %s', '<code>{order_date}, {order_number}, {product_name}, {pickup_date}</code>' ),
                'default'     => '',
            ),
            'heading' => array(
                'title'       => 'Email Heading',
                'type'        => 'text',
                'description' => sprintf( 'Available placeholders: %s', '<code>{order_date}, {order_number}, {product_name}, {pickup_date}</code>' ),
                'default'     => '',
            ),
            'email_type' => array(
                'title'       => 'Email type',
                'type'        => 'select',
                'description' => 'Choose which format of email to send.',
                'default'     => 'html',
                'class'       => 'wc-enhanced-select',
                'options'     => $this->get_email_type_options(),
            ),
        );
    }
}
