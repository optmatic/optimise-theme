<?php
/**
 * Minimal Headless WordPress Theme
 * -------------------------------
 * Structured for use with a headless frontend (e.g. Next.js).
 */

class HeadlessWPTheme {
    public function __construct() {
        add_theme_support('post-thumbnails');

        $this->init_security();
        $this->init_cleanup();
        $this->init_access_control();
        $this->init_cors_headers();
    }

    /**
     * Clean up unnecessary WordPress frontend features
     */
    private function init_cleanup() {
        add_action('init', function () {
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wp_generator');
            remove_action('wp_head', 'feed_links', 2);
            remove_action('wp_head', 'feed_links_extra', 3);
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'rest_output_link_wp_head', 10);
            remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
            remove_action('template_redirect', 'rest_output_link_header', 11);
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
        }, 20);
    }

    /**
     * Set up security-related headers and behaviours
     */
    private function init_security() {
        // Disable XML-RPC
        add_filter('xmlrpc_enabled', '__return_false');

        // X-Robots-Tag header for all non-API requests
        add_action('init', function () {
            if (!defined('REST_REQUEST')) {
                header('X-Robots-Tag: noindex, nofollow', true);
            }
        });

        // REST API-specific header
        add_filter('rest_pre_serve_request', function ($served, $result, $request, $server) {
            header('X-Robots-Tag: noindex, nofollow');
            return $served;
        }, 10, 4);
    }

    /**
     * Redirect any frontend access to /wp-admin, deny homepage
     */
    private function init_access_control() {
        add_action('template_redirect', function () {
            if (!is_admin() && !defined('REST_REQUEST')) {
                wp_redirect(admin_url());
                exit;
            }
        });

        // Optional: disable theme from rendering index if requested directly
        add_action('after_setup_theme', function () {
            if (defined('REST_REQUEST') || is_admin()) return;
            add_filter('template_include', function () {
                status_header(403);
                exit('Headless mode: frontend disabled.');
            });
        });
    }

    /**
     * Enable global CORS headers for API access
     */
    private function init_cors_headers() {
        add_action('rest_api_init', function () {
            remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
            add_filter('rest_pre_serve_request', function ($served, $result, $request, $server) {
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE');
                header('Access-Control-Allow-Headers: Content-Type, Authorization');
                return $served;
            }, 15, 4);
        });
    }
}

// Initialise the theme
new HeadlessWPTheme();
