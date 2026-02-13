=== Add From Server Reloaded ===
Contributors: dd32, elearningevolve, adeelraza_786@hotmail.com
Donate link: https://link.elearningevolve.com/self-pay
Tags: upload-limit, large-files, ftp, import, fileupload
Requires at least: 6.0
Tested up to: 6.9.1
Requires PHP: 7.4
Stable tag: 5.1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Bypass WordPress upload limits and import large files or folders directly from anywhere on your server into the WordPress Media Library.

== Description ==

**Add From Server Reloaded – The Ultimate WordPress Upload Limit Plugin**

Tired of running into WordPress upload limits? Struggling to upload large videos, RAW photos, PDFs, or bulk product images? Add From Server Reloaded is the easy solution to bypass WordPress upload restrictions, import files directly from your server, and manage your Media Library efficiently.

With Add From Server Reloaded, you can upload files of any size without changing PHP configuration or server settings. Works seamlessly on shared hosting, multi-site installations, WooCommerce stores, and WordPress 6.7+.

== How It Works (3 Easy Steps) ==

1. Upload files via FTP/SSH to your server (no size limit)  
2. Use Add From Server Reloaded to scan and select files  
3. Import directly to WordPress Media Library – done!  

== Features & Benefits ==

**Enhanced File Import & Management**

* One-Click Folder Import – Import entire folders, including subfolders, in one go  
* Smart Duplicate Detection – Prevents importing the same file multiple times  
* Real-Time File Search – Quickly find any file in your server with live search  
* Configurable Root Directory – Change the browsing root directly from plugin settings  
* Show/Hide Hidden Files – Toggle visibility for non-importable files  
* Last Modified Column – Quickly see when files were last updated  
* Batch Import Progress – Visual progress feedback for large file batches  
* Keyboard Shortcuts – Ctrl+A to select all, ESC to clear search  
* Import Summary – Consolidated message showing all imported files with clickable Media Library links  

**User Interface Improvements**

* Improved folder navigation with clear checkboxes  
* Better visual hierarchy – folders distinguished from files  
* Clickable breadcrumbs – easily track current folder location  
* Import buttons at top & bottom for easier access  
* File count display – see how many files/folders are selected  
* Success message links – view imported files directly in Media Library  

**Security & Performance**

* Directory Traversal Protection – prevent access outside allowed folders  
* Dangerous File Blocking – blocks PHP, EXE, and other unsafe file types  
* Enhanced CSRF Protection – all forms nonce verified  
* Real Path Validation – prevents path manipulation attacks  
* Input Sanitization & Output Escaping – all dynamic outputs sanitized  
* Optimized file scanning – faster loading and memory-efficient  
* Batch operation progress updates – track large imports easily  

**Compatibility**

* WordPress 6.0 – 6.8  
* PHP 7.4 – 8.3  
* WooCommerce compatible  
* Page builder compatible  
* Multi-site compatible  
* Works on shared hosting  

**Credits**

This plugin is a fork of the original "Add From Server" plugin by Dion Hulse (70,000+ active installs), with significant enhancements for security, performance, and usability. Modernized for WordPress 6.7+ and includes features users have been requesting for years.

== Why Choose Add From Server Reloaded Over Other Methods ==

**Key Benefits Over Original Add From Server Plugin**

* One-click folder import, smart duplicate detection, real-time search, root directory configuration  
* Security improvements – directory traversal protection, dangerous file blocking, CSRF verification, input/output sanitization  
* User interface overhaul – better folder navigation, breadcrumbs, import summary  
* Fixed original plugin issues – PHP 8+, WordPress 6.7+, memory exhaustion, duplicate imports  
* Performance improvements – optimized scanning, smart memory management, batch progress feedback  
* Technical improvements – WordPress 6.8 compatible, PHP 7.4–8.3, full coding standards compliance  
* Code quality improvements – replaced deprecated functions, Docblocks, translation ready  

**Benefits Compared to Editing php.ini**

* No server configuration or PHP knowledge needed  
* Non-technical users can import files easily  
* Safe for shared hosting environments  
* Works without root server access  

== Common Upload Limit Problems Solved ==

* "The uploaded file exceeds the upload_max_filesize directive in php.ini"  
* "Maximum upload file size: 64MB" or other limits  
* Large 4K/8K videos  
* RAW photo files (50MB+)  
* Bulk product image imports  
* PDF documents or other large resources  
* Timeouts during uploads on slow internet connections  
* Memory exhaustion during uploads  
* Browser crashes with large media  

== Perfect For ==

* Video creators – import large videos without limits  
* Photographers – handle RAW images easily  
* E-commerce – bulk import product images and catalogs  
* Agencies & developers – streamline client migrations and FTP workflows  
* Site migrations – import full media libraries efficiently  
* Content sites – bulk import PDFs, audio, and other media  

== Installation ==

1. Upload the add-from-server-reloaded folder to /wp-content/plugins/  
2. Activate via 'Plugins' menu in WordPress  
3. Login to WP Admin -> Click Side Menu -> Add From Server Reloaded  
4. Browse and import your files  

== Frequently Asked Questions ==

= How do I bypass WordPress upload limit? =  
Upload files via FTP/SSH (no size limit), then import using this plugin.  

= Can I upload large videos or RAW photos? =  
Yes. Works with 4K/8K videos, large PDFs, RAW images, and any WordPress-supported file type.  

= Can I bulk import product images for WooCommerce? =  
Yes. Upload all images via FTP, then batch import to Media Library.  

= Does this require server access? =  
You need FTP/SSH for uploading files, but no root access or php.ini edits are required.  

= Is it safe for shared hosting? =  
Absolutely. No server configuration changes required.  

== Screenshots ==

1. Browse server files with modern interface  
2. Real-time search filter in action  
3. Folder import – select all files including subfolders  
4. Import success message – consolidated results with Media Library links  

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
* WordPress Plugin Check compliance, internationalization support, output escaping  

= 4.1.0 - 2025-01-25 =  
* Namespace updated for WordPress standards, PHP 8+ compatibility  

= 4.0.0 - 2025-01-25 =  
* Initial release of Add From Server Reloaded  
* Security overhaul, duplicate detection, real-time search, modern UI  
* Batch folder import, enhanced error handling, WordPress 6.7+ compatible  

== Upgrade Notice ==

* 5.0.0 – Major update: new UI, modern features, security, WordPress 6.8 compatible. 100% backward compatible.  
* 4.1.2 – Critical fix for folder name display & navigation.  
* 4.1.0 – Namespace update for WordPress.org compliance.
