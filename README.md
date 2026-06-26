# SEO Meta Importer Pro

A professional, lightweight, secure, and extensible WordPress plugin that allows administrators to bulk update SEO metadata for posts, pages, custom post types, WooCommerce products, and taxonomy archives by importing a CSV file or Google Sheet.

## Key Features

- **Import Methods**: CSV file uploads, public Google Sheets URLs, Google Sheets API, and copy-paste streams.
- **Auto-Plugin Detection**: Automatically detects and writes to Yoast SEO, Rank Math, All in One SEO (AIOSEO), SEOPress, Slim SEO, and The SEO Framework (TSF).
- **Flexible Identifiers**: Matches pages via absolute URLs, relative URLs, page slugs, or numeric Post/Term IDs.
- **Field Mapping Wizard**: Elegant modern UI allowing drag-and-drop or select-menu column mappings, including custom meta keys.
- **Dry Run Simulation**: Validates CSV contents, page matching, and description lengths without altering the database.
- **Rollback Snapshots**: Automatically backs up original meta values before modifying, allowing one-click reverts of imports.
- **Background AJAX Batching**: Processes 100,000+ rows smoothly in AJAX increments with progress indicators and Pause/Resume/Cancel controls.
- **WP-CLI Support**: CLI commands for imports, exports, and sync tasks.
- **WP REST API Endpoints**: Programmatic integration for automation suites.
- **Scheduled Auto-Sync**: Keep SEO data synchronized with Google Sheets hourly, daily, or weekly using WP-Cron.

---

## Directory Structure

```text
seo-meta-importer-pro/
├── seo-meta-importer-pro.php    # Main bootstrap
├── README.md                     # Documentation
├── sample-import.csv             # Sample reference sheet
├── admin/                        # Admin interfaces & AJAX controllers
├── templates/                    # Admin views & tab sheets
├── includes/                     # Autoloader, activator, and utility helpers
├── seo/                          # SEO plugin bridge implementations
├── import/                       # Chunk parsers and import managers
├── export/                       # CSV metadata compilation
├── google/                       # Sheets integrations & WP cron syncer
├── logger/                       # Error tracer and download managers
├── rollback/                     # Snapshots backup and restoration engine
├── api/                          # REST API controllers
├── cli/                          # WP-CLI command wrappers
└── assets/                       # UI assets (jQuery scripts & CSS sheets)
```

---

## WP-CLI Commands Reference

### 1. Import Metadata
```bash
wp seo-import data.csv --seo_plugin=rankmath
```
*Options:*
- `<file>`: Path to the CSV file.
- `--mapping=<json_string>`: Column mappings. Optional (attempts auto-matching if omitted).
- `--seo_plugin=<plugin>`: Bridges override (e.g. `yoast`, `rankmath`, `aioseo`, `seopress`, `slimseo`, `tsf`, `custom`).
- `--dry_run`: Simulates the process and reports status.

### 2. Export Metadata
```bash
wp seo-export --post_types=post,page,product --output=my-seo-backup.csv
```
*Options:*
- `--post_types=<comma_list>`: Defaults to `post,page`.
- `--taxonomies=<comma_list>`: Defaults to `category,post_tag`.
- `--output=<destination>`: Save path.

### 3. Sync from Google Sheets
```bash
wp seo-sync-google
```
Downloads the configured Google Sheets URL and imports metadata directly.

---

## Developer Hook Triggers

### Action Hooks
- `smip_import_row_success($object_id, $object_type, $row, $settings)`: Fires after successfully updating metadata for a page/post/term.
- `smip_import_row_failed($identifier, $row, $settings)`: Fires when an identifier fails to resolve or metadata cannot be written.

### Filters
- `cron_schedules`: Customizes sync intervals.

---

## WP REST API Endpoints

All endpoints require authentication and `manage_options` capability.

- `GET /wp-json/seo-meta-importer-pro/v1/history`: Retrieve recent import actions.
- `GET /wp-json/seo-meta-importer-pro/v1/status`: Get current status.
- `POST /wp-json/seo-meta-importer-pro/v1/sync`: Trigger Sheet sync task.
- `POST /wp-json/seo-meta-importer-pro/v1/import`: Import a local CSV file.
