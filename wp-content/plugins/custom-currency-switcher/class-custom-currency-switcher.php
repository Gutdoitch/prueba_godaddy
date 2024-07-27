<?php
class Currency_Switcher
{
    public function __construct()
    {
        add_action('mayosis_header_elements', array($this, 'render_multicurrency_widget'), 10, 1);
        add_action('wp_enqueue_scripts', array($this, 'multicurrency_frontend_scripts_callback'));
        add_action('init', array($this, 'get_visitor_country_code'));
        //Remove price and currency for free product
        add_filter('edd_download_price_after_html', array($this, 'custom_edd_modify_product_price'), 10, 2);
    }

    public function custom_edd_modify_product_price($html, $download_id,)
    {  
        // Check if the product is free
        if (edd_is_free_download($download_id)) {
            // Replace price with "GRATIS"
            return "GRATIS";
        } else {
            if (is_singular('download')) {
                $price = edd_get_download_price($download_id);
                $currency_symbol = edd_get_currency();
                // Concatenate the price value and currency symbol with a space in between
                $formatted_price = $price . ' ' . $currency_symbol;
                return $formatted_price;
            } else {
                return $html;
            }
        }
    }

    public function multicurrency_frontend_scripts_callback()
    {
        wp_enqueue_script('multicurrency-custom-script', plugins_url('/custom-currency-switcher/assets/currency-switcher-custom-script.js'), array('jquery'));
        wp_enqueue_style('multicurrency-custom-style', plugins_url('/custom-currency-switcher/assets/currency-switcher-custom-style.css'));
    }


    public function get_visitor_country_code()
    {
        if (class_exists('Easy_Digital_Downloads')) {
            if ( !empty(EDD()->session->get('currency')) ) {
                $currencyCode = EDD()->session->get( 'currency' );
            }
            
            else {
                // Get the visitor's IP address
                $visitor_ip = $_SERVER['REMOTE_ADDR'];
                // Get user IP address details with ip-api.com
                $ipApiUrl = "https://api.country.is/$visitor_ip";
                $ipApiResponse = json_decode(file_get_contents($ipApiUrl), true);
                if (isset($ipApiResponse['country'])) {
                    $countryCode = $ipApiResponse['country'];
                    // Get currency code based on country code
                    $currencyCode = $this->get_currency_code($countryCode);
                    if ($currencyCode) {
                        // Return currency code
                        EDD()->session->set('currency', $currencyCode);
                    } else {
                        // Return message if currency code is not found
                        return "Currency information not available for $countryCode";
                    }
                } else {
                    // Return message if country code is not found in IP API response
                    return "Country code not found in IP API response";
                }
            }

            
        }
    }

    // Function to get currency code from country code using REST Countries API
    public function get_currency_code($countryCode)
    {
        $url = "https://restcountries.com/v3.1/alpha/$countryCode";
        $data = file_get_contents($url);
        $result = json_decode($data, true);
        $currencies = $result[0]['currencies'];
        $country = array_keys($currencies);
        return $country[0];
    }

    public function render_multicurrency_widget($value)
    {
        if ($value == 'nav' || $value == 'accordion') {
            wp_enqueue_script('edd-multi-currency');
            global $wpdb;
            $table_name = $wpdb->prefix . 'edd_mc_currencies';
            $query = "SELECT * FROM $table_name";
            $currencies = $wpdb->get_results($query);
            $currentCurrency = EDD()->session->get('currency');
?>
            <form class="edd-multi-currency-switcher" method="GET">
                <label for="edd-multi-currency-dropdown" class="screen-reader-text">
                    <?php esc_html_e('Select a currency', 'edd-multi-currency'); ?>
                </label>
                <select id="edd-multi-currency-dropdown" name="currency" class="custom-currency">
                    <?php foreach ($currencies as $currency) : ?>
                        <option value="<?php echo esc_attr($currency->currency); ?>" <?php selected($currency->currency, $currentCurrency); ?>>
                            <?php echo esc_html($currency->currency); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="button custom-multi edd-submit edd-multi-currency-button <?php echo esc_attr(sanitize_html_class(edd_get_option('checkout_color', 'blue'))); ?>">
                    <?php esc_html_e('Set Currency', 'edd-multi-currency'); ?>
                </button>
            </form>
<?php

        }
    }
}
new Currency_Switcher();
