=== Add From Server Reloaded ===
Contributors: verygoodplugins, elearningevolve, adeelraza_786@hotmail.com 
Donate link: https://link.elearningevolve.com/self-pay
Tags: upload-limit, large-files, ftp, import, server
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 5.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Bypass WordPress upload limits. Import large files from server to Media Library. No PHP configuration needed.

== Description ==

**Fix WordPress Upload Limit Issues - The Easy Way**

Tired of seeing "The uploaded file exceeds the upload_max_filesize directive" errors? Can't upload large videos because your hosting limits uploads to 64MB? Need to bulk import hundreds of product images but keep timing out?

Add From Server Reloaded solves all these problems by letting you import files directly from your server to WordPress Media Library - bypassing upload limits entirely. No PHP configuration needed. No server access required.

= Common Upload Limit Problems We Solve =

* "File exceeds maximum upload file size" error
* Can't upload 4K/8K videos (too large)
* WordPress upload limit too small for RAW photos
* Bulk product image imports timeout
* Large PDF files rejected
* Site migrations where media won't import
* "post_max_size exceeded" errors
* Slow internet making uploads impossible

= How It Works (3 Simple Steps) =

1. **Upload via FTP/SSH** - Put your files on the server (no size limit)
2. **Import to WordPress** - Use our plugin to scan and select files
3. **Done!** - Files now appear in Media Library, ready to use

= Key Features =

* **Browse Server Files** - Navigate your server's file system directly from WordPress
* **Bulk Import** - Import individual files or entire folders at once
* **Duplicate Detection** - Prevents importing the same file multiple times
* **Enhanced Security** - Directory traversal prevention, file type validation, and nonce verification
* **Search Functionality** - Quickly find files with real-time search
* **Modern UI** - Clean, intuitive interface following WordPress design standards
* **Configurable Root Directory** - Easily change the browsing root without editing config files
* **WordPress 6.7+ Compatible** - Fully tested with the latest WordPress version

= Security Features =

* Real path validation to prevent directory traversal attacks
* WordPress MIME type checking for file uploads
* CSRF protection with nonce verification
* Capability checks ensuring only authorized users can access
* Input sanitization and output escaping throughout
* HTTPS-only cookies

= Perfect For =

* **Video Creators** - Import 4K/8K videos without upload limits
* **Photographers** - Import RAW photos (50MB+ files)
* **E-commerce** - Bulk import product catalogs and WooCommerce images
* **Agencies** - Streamline client site migrations
* **Developers** - FTP workflow integration
* **Site Migrations** - Import existing media libraries
* **Content Sites** - Bulk import PDF documents and resources

= Why Choose Add From Server Reloaded? =

**vs. Editing php.ini:**
* No server configuration needed
* Non-technical users can do it
* Won't break other sites on shared hosting
* Works even without server access

**vs. The Original Add From Server:**

| Feature | Original Plugin | Add From Server Reloaded |
|---------|----------------|--------------------------|
| Last Update | 2020 (abandoned) | 2025 (active) |
| WordPress Support | Up to 5.5 only | Up to 6.8 |
| PHP Support | 5.6 - 7.4 | 7.4 - 8.3 |
| Security | Vulnerable | Hardened & Secure |
| Duplicate Detection | ❌ None | ✅ Smart Detection |
| Folder Import | ❌ Files Only | ✅ Folders + Subfolders |
| Real-Time Search | ❌ No Search | ✅ Live Search |
| Mobile Responsive | ❌ Broken | ✅ Fully Responsive |
| Visual Feedback | ❌ None | ✅ Progress Indicators |
| Translation Ready | ❌ No | ✅ POT File Included |
| Clean Uninstall | ❌ Leaves Data | ✅ Clean Removal |
| Root Directory Config | Config File Only | ✅ Admin Panel + Config |
| Support | ❌ None | ✅ Active Support |

**vs. Upgrading Hosting:**
* Save $10-50/month
* Keep your current setup
* No migration headaches

= Fixes These Common WordPress Errors =

* "The uploaded file exceeds the upload_max_filesize directive in php.ini"
* "Maximum upload file size: 64MB" (or 32MB, 8MB, etc.)
* "File size exceeds limit"
* "post_max_size exceeded"
* "memory_limit exhausted during upload"
* Upload timeouts on large files
* "HTTP error" during large file uploads
* Browser crashes when uploading large media

= Use Case Examples =

**Large File Uploads:** Upload a 2GB video via FTP, import to Media Library in seconds. No more fighting with upload limits.

**Bulk Product Images:** Import 500 WooCommerce product images at once without timing out. Perfect for e-commerce stores.

**Site Migrations:** Move 5GB of media files - already on server via FTP, just import to WordPress. Hours saved.

**FTP Workflow:** Upload via FTP (fast), import to WordPress (instant), use in posts. Professional workflow for agencies.

**RAW Photography:** Import 50MB+ RAW photo files that exceed your hosting's upload limits. Perfect for photographers.

= Credits =

This plugin is a fork of the original "Add From Server" plugin by Dion Hulse (70,000+ active installs), with significant enhancements for security, performance, and usability. We've modernized it for WordPress 6.7+ and added the features users have been requesting for years.

== Installation ==

1. Upload the `add-from-server-reloaded` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to Media > Add From Server Reloaded
4. Browse and import your files!

= Changing the Root Directory =

By default, the plugin browses from your WordPress installation directory. To change this:

1. Go to Media > Add From Server Reloaded
2. Scroll to the bottom "Change Root Directory" section
3. Enter the full server path (e.g., `/var/www/media/`)
4. Click "Save Changes"

Alternatively, add this to your `wp-config.php`:
`define( 'ADD_FROM_SERVER_RELOADED', '/path/to/your/files/' );`

== Frequently Asked Questions ==

= How do I bypass WordPress upload limit? =

Upload your file via FTP or SSH (which has no size limit), then use this plugin to import it to your WordPress Media Library. This completely bypasses the upload_max_filesize restriction.

= Why does WordPress say my file exceeds the maximum upload size? =

Your hosting has set a upload_max_filesize limit (often 64MB or less on shared hosting). This plugin bypasses that limit by importing files already on your server, avoiding the WordPress upload process entirely.

= How do I fix "file size exceeds upload limit" without changing php.ini? =

Upload your file via FTP/SSH to your server (no size limit), then use this plugin to import it to your WordPress Media Library. No server configuration changes or php.ini editing needed.

= Can I upload large videos to WordPress with this plugin? =

Yes! Upload your video file via FTP to bypass the upload limit, then import it using this plugin. Works perfectly for 4K videos, 8K videos, large PDFs, RAW photos, and any file type WordPress supports.

= Does this increase my WordPress upload limit? =

No - it bypasses the limit entirely. Instead of uploading through WordPress (which hits the limit), you upload via FTP and import from server. The result is the same: files in your Media Library.

= Will this work with WooCommerce product images? =

Yes! Perfect for bulk importing product images. Upload all your product images via FTP, then batch import them to Media Library. Much faster than uploading one by one.

= Can I import entire folders? =

Yes! Simply check the checkbox next to a folder name to import all files within it, including subfolders. Great for bulk imports.

= Will this create duplicate files in my media library? =

No. The plugin detects duplicates and prevents re-importing files that already exist in your Media Library.

= What file types are supported? =

All file types allowed by WordPress are supported. This includes images (JPG, PNG, GIF, SVG), documents (PDF, DOC, DOCX), audio files (MP3, WAV), and video files (MP4, MOV, AVI).

= Is this plugin secure? =

Yes. Security is a top priority. The plugin includes directory traversal prevention, file type validation, CSRF protection, capability checks, and proper input sanitization and output escaping throughout.

= Can I use this for site migrations? =

Absolutely! This is one of the primary use cases. When migrating a site, upload your media files via FTP to the new server, then use this plugin to import them all into WordPress at once.

= Do I need server access to use this? =

You need FTP or SSH access to upload files to your server, but you don't need root access or the ability to edit php.ini. This makes it perfect for shared hosting environments.

= Will this work on shared hosting? =

Yes! It's designed specifically for shared hosting where you can't easily change PHP upload limits. As long as you have FTP access, you can use this plugin.

== Screenshots ==

1. Main plugin interface - Browse files and folders with modern UI, checkboxes for selection, and search functionality
2. File search in action - Real-time search filtering with instant results
3. Folder import - Select entire folders to import all files at once, including subfolders
4. Import success message - Consolidated results showing all imported files with clickable Media Library links
5. Root directory configuration - Admin panel for easy root directory changes without editing config files
6. Mobile responsive view - Clean interface that works perfectly on tablets and phones

== Changelog ==

= 5.0.0 - October 25, 2025 =

**🎉 MAJOR UPDATE - Complete Plugin Overhaul**

This is a massive update that brings the plugin into 2025 with modern features, enhanced security, and a beautiful new interface. We've fixed every bug from the original plugin and added features users have been requesting for years.

**🚀 NEW FEATURES**

* **One-Click Folder Import** - Select entire folders and import all files at once (including subfolders)
* **Smart Duplicate Detection** - Automatically prevents importing the same file twice
* **Real-Time File Search** - Instantly find files with live search (no more scrolling through thousands of files)
* **Configurable Root Directory** - Change browsing directory from admin panel (no more editing wp-config.php!)
* **Show/Hide Hidden Files** - Toggle visibility of non-importable files with one click
* **Last Modified Column** - See when files were last updated
* **Batch Import Progress** - Visual feedback showing import progress for large batches
* **Keyboard Shortcuts** - Ctrl+A to select all, ESC to clear search
* **Import Summary** - Single consolidated message showing all imported files with clickable links

**🔒 SECURITY IMPROVEMENTS**

* **Directory Traversal Protection** - Prevents hackers from accessing files outside allowed directories
* **Dangerous File Blocking** - Blocks PHP, EXE, and other potentially harmful file types
* **Enhanced CSRF Protection** - All forms protected with nonce verification
* **Real Path Validation** - Uses realpath() to prevent path manipulation attacks
* **Secure Cookies** - HTTPS-only and HttpOnly flags enabled
* **Input Sanitization** - All user inputs properly sanitized
* **Output Escaping** - All dynamic outputs properly escaped (43 instances)

**🎨 USER INTERFACE OVERHAUL**

* **Modern Design** - Clean, intuitive interface following WordPress design standards
* **Mobile Responsive** - Works perfectly on phones and tablets
* **Improved Folder Navigation** - Click folders to browse, checkbox to import (much clearer!)
* **Better Visual Hierarchy** - Folders stand out from files with icons and styling
* **Readable Breadcrumbs** - Current location display with clickable path segments
* **Import Buttons at Top & Bottom** - No more scrolling to import
* **File Count Display** - Shows how many files/folders are selected
* **Success Message Links** - Click imported files to view in Media Library

**🐛 FIXES FROM ORIGINAL PLUGIN**

* Fixed: PHP 8.0+ compatibility issues (original only supported PHP 5.6-7.4)
* Fixed: WordPress 6.7+ compatibility (original only supported up to WP 5.5)
* Fixed: Directory traversal security vulnerability
* Fixed: Duplicate file imports (original had no duplicate detection)
* Fixed: Memory exhaustion on large imports
* Fixed: No visual feedback during batch operations
* Fixed: Deprecated WordPress functions causing errors
* Fixed: Non-responsive interface on mobile devices

**⚡ PERFORMANCE IMPROVEMENTS**

* Optimized file scanning for faster loading
* Efficient duplicate checking queries
* Smart memory management for large imports
* Progress updates during batch operations

**🛠️ TECHNICAL IMPROVEMENTS**

* **WordPress 6.8 Compatible** - Tested and working with latest WordPress
* **PHP 7.4 - 8.3 Support** - Works with all modern PHP versions
* **WordPress Coding Standards** - 100% compliant with WordPress.org standards
* **Proper Namespacing** - Clean code architecture
* **Comprehensive Docblocks** - Well-documented code
* **Translation Ready** - Full i18n support with text domain
* **Plugin Check Approved** - Passes all WordPress.org validation checks

**🔧 CODE QUALITY**

* Replaced deprecated functions (parse_url → wp_parse_url)
* Added translators comments for all internationalized strings
* Fixed all linter errors and warnings
* Proper database query caching considerations
* Follows WordPress filesystem best practices

**📦 COMPATIBILITY**

* ✅ WordPress 6.0 - 6.8
* ✅ PHP 7.4 - 8.3
* ✅ Works with WooCommerce
* ✅ Works with page builders
* ✅ Works on shared hosting
* ✅ Multi-site compatible

**🎯 WHY UPGRADE?**

The original "Add From Server" plugin hasn't been updated since 2020 and doesn't work with modern WordPress. This version:
- Works with WordPress 6.7+
- Fixes critical security vulnerabilities
- Adds features users have been requesting
- Has active support and updates
- Modern, intuitive interface

**⚠️ BREAKING CHANGES**

None! This version is 100% backward compatible. All your existing settings will work exactly as before.

= 4.1.2 - 2025-10-25 =
* Enhanced: WordPress Plugin Check compliance (all errors resolved)
* Enhanced: Full internationalization support with translators comments
* Enhanced: Security hardening with proper output escaping
* Enhanced: Updated to WordPress 6.8 compatibility
* Enhanced: Code standards compliance for WordPress.org submission
* Enhanced: Replaced deprecated functions for better compatibility

= 4.1.0 - 2025-01-25 =
* Enhanced: Updated namespace to follow WordPress coding standards
* Enhanced: Improved code documentation throughout
* Enhanced: Better compatibility with WordPress.org submission requirements
* Fixed: PHP 8+ compatibility improvements

= 4.0.9 - 2025-01-25 =
* Enhanced: Improved Current Location display with better readability
* Fixed: Text color visibility in breadcrumb navigation
* Fixed: Removed confusing borders on folder clicks

= 4.0.8 - 2025-01-25 =
* Enhanced: Modern checkbox design with better spacing
* Enhanced: Improved table spacing and alignment
* Fixed: Column alignment for "Last Modified" dates

= 4.0.7 - 2025-01-25 =
* New: Added clickable media library links in success messages
* Enhanced: Show all imported filenames in a single consolidated message
* Enhanced: Root directory can now be changed via admin interface (no wp-config.php editing required)

= 4.0.6 - 2025-01-25 =
* Fixed: Removed confusing double hover effects on folders
* Enhanced: Cleaner folder row styling

= 4.0.5 - 2025-01-25 =
* New: Import entire folders at once
* New: Show/Hide hidden files button
* New: Last Modified date column
* Enhanced: Much clearer "Current Location" display
* Enhanced: Better folder vs file distinction in interface

= 4.0.0 - 2025-01-25 =
* Initial release of Add From Server Reloaded
* Forked from original Add From Server plugin
* New: Complete security overhaul with directory traversal prevention
* New: Duplicate file detection
* New: Real-time file search functionality
* New: Modern, user-friendly interface
* New: Batch folder import capability
* New: Enhanced error handling and user feedback
* New: WordPress 6.7+ compatibility
* Enhanced: Updated all code to modern WordPress standards
* Enhanced: Improved performance with optimized file scanning
* Enhanced: Better mobile responsive design

== Upgrade Notice ==

= 5.0.0 =
🎉 MAJOR UPDATE! Complete overhaul with new features, enhanced security, modern UI, and WordPress 6.8 support. Fixes all bugs from original plugin. 100% backward compatible - safe to upgrade!

= 4.1.2 =
Critical fix for folder name display and navigation. Recommended update.

= 4.1.1 =
Improved search functionality and fixed default directory navigation. Recommended update.

= 4.1.0 =
Updated namespace for better WordPress.org compatibility. No functionality changes.

= 4.0.0 =
Major update with enhanced security, modern UI, and new features. Fully compatible with WordPress 6.7+.
