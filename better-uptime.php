<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Better Uptime
 * Description:       We call you when your website goes down.
 * Version:           1.0.3
 * Author:            Better Uptime
 * Author URI:        http://betteruptime.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       better-uptime
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'better_uptime_add_settings_link');
add_action('admin_menu', 'better_uptime_add_menu_link');

if(!function_exists('better_uptime_add_settings_link')) {
    function better_uptime_add_settings_link($links) {
        // The menu_page_url ECHOes the URL by default. We set the optional $echo
        // parameter to FALSE to prevent that undesired behavior.
        // https://developer.wordpress.org/reference/functions/menu_page_url/
        $url = menu_page_url('better-uptime', FALSE);
        $link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
        array_push($links, $link);

        return $links;
    }
}

if (!function_exists('better_uptime_add_menu_link')) {
    function better_uptime_add_menu_link() {
        add_options_page('Better Uptime monitoring', 'Better Uptime monitoring', 'administrator', 'better-uptime', 'better_uptime_options_page');
    }
}

if (!function_exists('better_uptime_options_page')) {
    function better_uptime_options_page() {
        ?>
        <div class="wrap">
            <h2>Better Uptime</h2>
            <p>Set up uptime monitoring for your website using <a href="https://betteruptime.com/" target="_blank">Better Uptime</a>. We call you when your website is down.</p>
            
            <form action="https://betteruptime.com/users/sign-up" method="get" target="_blank">
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th><label for="url">Website URL:</label></th>
                            <td>
                                <input name="url" type="url" required="true" value="<?php echo get_site_url(); ?>">
                                <p class="description">We will check this website every 3 minutes and we'll notify you if it goes down.</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="email">Email address:</label></th>
                            <td>
                                <input name="email" type="email" required="true" value="<?php echo get_bloginfo('admin_email'); ?>">
                                <p class="description">If your site goes down, we will send an email to this address.</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="phone">Phone number for notification calls:</label></th>
                            <td>
                                <input name="phone" type="text" value="">
                                <p class="description">If your site goes down, we will call this phone number so you can do something about it as soon as possible.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="submit">
                    <button type="submit" class="button button-primary">
                        <span class="dashicons dashicons-external" style="font-size: inherit; vertical-align: baseline;"></span> Finish sign up on BetterUptime.com
                    </button>
                </p>
            </form>
        </div>
        <?php
    }
}
