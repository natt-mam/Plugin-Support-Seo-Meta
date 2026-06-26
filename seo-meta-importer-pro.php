<?php
/**
 * Plugin Name: SEO Meta Importer Pro
 * Description: Bulk import and export SEO metadata for posts, pages, custom post types, WooCommerce products, and taxonomies from CSV or Google Sheets.
 * Version: 1.0.0
 * Author: Antigravity
 * Author URI: https://github.com/google-deepmind
 * License: GPL2 or later
 * Text Domain: seo-meta-importer-pro
 * Requires PHP: 8.1
 * Requires at least: 6.5
 */

defined('ABSPATH') || exit;

// Require Autoloader
require_once plugin_dir_path(__FILE__) . 'includes/class-autoloader.php';

// Register Autoloader
\SEOMetaImporterPro\Includes\Autoloader::register(__FILE__);

// Initialize Plugin
\SEOMetaImporterPro\Includes\Plugin::get_instance(__FILE__);
