# Add From Server Reloaded - Bypass WordPress Upload Limit Plugin

[![WordPress Plugin Version](https://img.shields.io/badge/version-5.2.0-blue)](https://wordpress.org/plugins/add-from-server-reloaded/)
[![WordPress Compatibility](https://img.shields.io/badge/WordPress-6.0--6.8-brightgreen)](https://wordpress.org/)
[![PHP Compatibility](https://img.shields.io/badge/PHP-7.4--8.3-purple)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-GPL--3.0-orange)](LICENSE)
[![WordPress.org](https://img.shields.io/badge/WordPress.org-100%2B%20installs-success)](https://wordpress.org/plugins/add-from-server-reloaded/)
[![Downloads](https://img.shields.io/badge/downloads-WordPress.org-blue)](https://wordpress.org/plugins/add-from-server-reloaded/)

### WordPress.org Plugin Metadata
| Field | Value |
|-------|-------|
| **Requires at least** | 6.0 |
| **Tested up to** | 6.9.1 |
| **Stable tag** | 5.2.0 |
| **Requires PHP** | 7.4 |
| **Contributors** | dd32, elearningevolve, adeelraza |
| **Donate link** | [Support via Stripe](https://link.elearningevolve.com/self-pay) |

#### Upgrade Notice
- **5.2.0** – Imports now use default WordPress year/month folders. Original file dates preserved. Existing URLs unchanged.

---

> **The Ultimate Solution for WordPress Upload Limit Problems** - Import files of any size directly from your server to WordPress Media Library. No PHP configuration needed. No server access required. Works on shared hosting.

Tired of seeing *"The uploaded file exceeds the upload_max_filesize directive"* errors? Can't upload large videos because your hosting limits uploads to 64MB? Need to bulk import hundreds of product images but keep timing out?

**Add From Server Reloaded** solves all these problems by letting you import files directly from your server to WordPress Media Library - bypassing upload limits entirely. No PHP configuration needed. No server access required.

---

## 🚀 Quick Start

**Download:** [WordPress.org Plugin Directory](https://wordpress.org/plugins/add-from-server-reloaded/) | [GitHub Releases](https://github.com/adeel-raza/add-from-server-reloaded/releases)

**Install:** Upload via WordPress admin or install directly from WordPress.org

**Use:** Upload files via FTP/SSH → Import via plugin → Done!

-<h2 align="center">💝 Support This Project</h2><p align="center"><strong>If you find this project helpful, please consider supporting it:</strong></p><p align="center"><a href="https://link.elearningevolve.com/self-pay" target="_blank">[![Support via Stripe](https://img.shields.io/badge/Support%20via%20Stripe-635BFF?style=for-the-badge&logo=stripe&logoColor=white)](https://link.elearningevolve.com/self-pay)</p><p align="center"><a href="https://link.elearningevolve.com/self-pay" target="_blank"><strong>👉 Click here to support via Stripe 👈</strong></a></p>-

---

## Table of Contents

- [Problem This Solves](#the-problem-wordpress-upload-limits)
- [How It Works](#how-it-works-3-simple-steps)
- [Key Features](#key-features)
- [Use Cases](#perfect-for)
- [Installation](#installation)
- [FAQ](#frequently-asked-questions)
- [Comparison](#why-choose-add-from-server-reloaded)
- [Changelog](#whats-new)

---

## The Problem: WordPress Upload Limits

### Error Messages You're Seeing:

```
"The uploaded file exceeds the upload_max_filesize directive in php.ini"
"Maximum upload file size: 64MB"
"File exceeds the maximum upload size for this site"
"post_max_size exceeded"
"The uploaded file exceeds the MAX_FILE_SIZE directive"
"413 Request Entity Too Large"
Upload timeouts and browser crashes
```

### Why This Happens:

- **Shared hosting limits** - Most hosts restrict uploads to 64MB or less
- **PHP configuration** - `upload_max_filesize` and `post_max_size` restrictions
- **WordPress limits** - Additional size restrictions in WordPress core
- **Browser limitations** - Large file uploads can crash browsers
- **Network timeouts** - Slow connections can't handle large uploads
- **Memory limits** - PHP memory exhaustion during uploads

### What You Can't Upload:

- **4K/8K Videos** - Often 500MB to 5GB+ files
- **RAW Photos** - Professional RAW files (50MB-100MB+ each)
- **Large PDFs** - Technical documents, catalogs (100MB+)
- **Bulk Product Images** - Hundreds of WooCommerce images
- **Audio Files** - High-quality music files, podcasts
- **Site Migrations** - Full media libraries with thousands of files

---

## The Solution: Add From Server Reloaded

**Import files directly from your server to WordPress Media Library - completely bypassing all upload limits.**

### How It Works (3 Simple Steps)

1. **Upload via FTP/SSH** → Put files on your server (no size limit!)
2. **Open Plugin** → Navigate to Media > Add From Server Reloaded
3. **Import** → Select files/folders and import to Media Library

**That's it!** Files appear in your WordPress Media Library, ready to use.

---

## Key Features

### File Import & Management
- **One-Click Folder Import** - Import entire folders including subfolders
- **Smart Duplicate Detection** - Prevents importing the same file twice
- **Real-Time File Search** - Instantly find files with live search
- **Batch Import** - Import hundreds of files at once
- **Progress Indicators** - Visual feedback for large imports
- **Import Summary** - See all imported files with clickable links

### User Interface
- **Modern Design** - Clean, intuitive WordPress admin interface
- **Mobile Responsive** - Works perfectly on phones and tablets
- **Folder Navigation** - Easy browsing with breadcrumbs
- **Keyboard Shortcuts** - Ctrl+A to select all, ESC to clear search
- **File Count Display** - See how many files are selected
- **Configurable Root Directory** - Change browsing location from admin panel

### Security & Performance
- **Directory Traversal Protection** - Prevents unauthorized file access
- **Dangerous File Blocking** - Blocks PHP, EXE, and unsafe file types
- **CSRF Protection** - All forms protected with nonce verification
- **Input Sanitization** - All user inputs properly sanitized
- **Output Escaping** - All dynamic outputs properly escaped
- **Optimized Performance** - Fast file scanning and memory-efficient

### Compatibility
- **WordPress 6.0 - 6.8** - Fully tested with latest WordPress
- **PHP 7.4 - 8.3** - Works with all modern PHP versions
- **WooCommerce Compatible** - Perfect for e-commerce stores
- **Page Builder Compatible** - Works with Elementor, Gutenberg, etc.
- **Shared Hosting** - No server configuration needed
- **Multi-Site Compatible** - Works on WordPress networks

---

## Perfect For

### Video Creators & YouTubers
- Upload 4K/8K videos without limits
- Import large video files for embedding
- No more "file too large" errors

### Photographers
- Import RAW photos (50MB+ files)
- Bulk import photo galleries
- Professional image workflows

### E-commerce Store Owners
- Bulk import WooCommerce product images
- Import product catalogs
- Handle large product media libraries

### Web Developers & Agencies
- Site migrations with large media libraries
- Client site setups
- FTP workflow integration

### Content Creators
- Import large PDF documents
- Bulk import media resources
- Handle large content libraries

### Anyone with Upload Problems
- Shared hosting users
- Users without server access
- Non-technical users

---

## Installation

### Method 1: WordPress Admin (Recommended)

1. Go to **Plugins → Add New** in WordPress admin
2. Search for **"Add From Server Reloaded"**
3. Click **Install Now**
4. Click **Activate**

### Method 2: Manual Installation

1. Download the plugin ZIP file
2. Go to **Plugins → Add New → Upload Plugin**
3. Choose the ZIP file and click **Install Now**
4. Click **Activate**

### Method 3: FTP Installation

1. Download and extract the plugin
2. Upload the `add-from-server-reloaded` folder to `/wp-content/plugins/`
3. Activate via **Plugins** menu in WordPress

### First Use

1. Navigate to **Media → Add From Server Reloaded**
2. Browse your server files
3. Select files or folders to import
4. Click **Import Selected Files**

---

## Frequently Asked Questions

### How do I bypass WordPress upload limit?

**Answer:** Upload your file via FTP or SSH (which has no size limit), then use this plugin to import it to your WordPress Media Library. This completely bypasses the `upload_max_filesize` restriction.

### Why does WordPress say my file exceeds the maximum upload size?

**Answer:** Your hosting provider has set a `upload_max_filesize` limit (often 64MB or less on shared hosting). This plugin bypasses that limit by importing files already on your server, avoiding the WordPress upload process entirely.

### Can I upload large videos to WordPress with this plugin?

**Answer:** Yes! Upload your video file via FTP to bypass the upload limit, then import it using this plugin. Works perfectly for 4K videos, 8K videos, large PDFs, RAW photos, and any file type WordPress supports.

### Will this work with WooCommerce product images?

**Answer:** Yes! Perfect for bulk importing product images. Upload all your product images via FTP, then batch import them to Media Library. Much faster than uploading one by one.

### Can I import entire folders?

**Answer:** Yes! Simply check the checkbox next to a folder name to import all files within it, including subfolders. Great for bulk imports.

### Will this create duplicate files in my media library?

**Answer:** No. The plugin has smart duplicate detection and prevents re-importing files that already exist in your Media Library.

### Does this require server access or PHP knowledge?

**Answer:** No! You only need FTP/SSH access to upload files (which most hosting provides). No PHP configuration, no server access, no technical knowledge required.

### Is it safe for shared hosting?

**Answer:** Absolutely! No server configuration changes required. Works perfectly on shared hosting without affecting other sites.

### Can I change the directory the plugin browses?

**Answer:** Yes! You can change the root directory from the plugin settings page in WordPress admin, or add a constant to `wp-config.php`.

### What file types can I import?

**Answer:** Any file type that WordPress supports in the Media Library - images, videos, PDFs, audio files, documents, etc. The plugin blocks dangerous file types (PHP, EXE, etc.) for security.

### Does this work with WordPress multisite?

**Answer:** Yes! The plugin is fully compatible with WordPress multisite installations.

---

## Why Choose Add From Server Reloaded?

### vs. Editing php.ini

| Feature | Editing php.ini | Add From Server Reloaded |
|---------|----------------|--------------------------|
| **Technical Knowledge** | Requires PHP knowledge | No technical knowledge needed |
| **Server Access** | Requires root/server access | Works with FTP only |
| **Shared Hosting** | May not be allowed | Works on all hosting |
| **Risk** | Can break other sites | Safe, isolated solution |
| **Reversibility** | Hard to undo | Easy to disable |

### vs. The Original "Add From Server" Plugin

| Feature | Original Plugin | Add From Server Reloaded |
|---------|----------------|--------------------------|
| **Last Update** | 2020 (abandoned) | **2025 (active)** |
| **WordPress Support** | Up to 5.5 only | **Up to 6.8** |
| **PHP Support** | 5.6 - 7.4 | **7.4 - 8.3** |
| **Security** | Vulnerable | **Hardened & Secure** |
| **Duplicate Detection** | None | **Smart Detection** |
| **Folder Import** | Files Only | **Folders + Subfolders** |
| **Real-Time Search** | No Search | **Live Search** |
| **Mobile Responsive** | Broken | **Fully Responsive** |
| **Visual Feedback** | None | **Progress Indicators** |
| **Support** | None | **Active Support** |

### vs. Upgrading Hosting

- **Save Money** - No need to upgrade to expensive hosting ($10-50/month savings)
- **Keep Current Setup** - Works with your existing hosting
- **No Migration** - No need to move your site
- **Focused Solution** - Solves upload limits specifically

---

## Changelog

### 5.2.0 - February 27, 2026

* **Changed:** Imports now use default WordPress year/month folder structure (e.g., `uploads/2026/02/`)
* **Fixed:** Original file date preserved – images keep their year/month structure based on file modification date
* **Fixed:** No unnecessary or empty upload folders created
* **Fixed:** WordPress Media Library shows correct path; existing URLs remain unchanged
* **Added:** `afsrreloaded_upload_subdir` filter – use empty string for year/month (default), or custom path

### 5.1.0

* Fixed: Invalid date folders are no longer created, and empty upload folders are prevented.

* Updated: All imported files and folders are now placed in a separate folder named after the plugin.

* Added: After importing, a message will display for files skipped due to security restrictions. The following file types are blocked: PHP, PHTML, PHPS, PHT, PHAR, EXE, SH, BAT, CMD.

* Updated: Improved result messages for clarity, differentiating between folder and individual file imports.

### 5.0.0 - October 25, 2025

**Complete plugin overhaul with modern features, enhanced security, and beautiful UI!**

#### NEW FEATURES
- One-Click Folder Import
- Smart Duplicate Detection
- Real-Time File Search
- Configurable Root Directory (admin panel)
- Show/Hide Hidden Files toggle
- Last Modified column
- Batch Import Progress feedback
- Keyboard Shortcuts (Ctrl+A, ESC)
- Import Summary with clickable links

#### SECURITY IMPROVEMENTS
- Directory Traversal Protection
- Dangerous File Blocking
- Enhanced CSRF Protection
- Real Path Validation
- Secure Cookies (HTTPS-only)
- Input Sanitization (all inputs)
- Output Escaping (43 instances)

#### UI OVERHAUL
- Modern Design
- Mobile Responsive
- Improved Folder Navigation
- Better Visual Hierarchy
- Readable Breadcrumbs
- Import Buttons (top & bottom)
- File Count Display
- Success Message Links

#### FIXES FROM ORIGINAL PLUGIN
- Fixed: PHP 8.0+ compatibility (original only supported PHP 7.4)
- Fixed: WordPress 6.7+ compatibility (original broken in WP 6.0+)
- Fixed: Directory traversal security vulnerability (critical)
- Fixed: Duplicate file imports (original had no detection)
- Fixed: Memory exhaustion on large imports
- Fixed: No visual feedback during batch operations
- Fixed: Deprecated WordPress functions causing errors
- Fixed: Non-responsive interface on mobile devices

---

## Screenshots

1. **Main Plugin Interface** - Browse files and folders with modern UI, checkboxes for selection, and search functionality
2. **File Search in Action** - Real-time search filtering with instant results
3. **Folder Import** - Select entire folders to import all files at once, including subfolders
4. **Import Success Message** - Consolidated results showing all imported files with clickable Media Library links
5. **Root Directory Configuration** - Admin panel for easy root directory changes without editing config files
6. **Mobile Responsive View** - Clean interface that works perfectly on tablets and phones

---

## Technical Details

### Requirements
- **WordPress:** 6.0 or higher
- **PHP:** 7.4 or higher (tested up to PHP 8.3)
- **Server:** Any hosting with FTP/SSH access

### File Structure
```
add-from-server-reloaded/
├── add-from-server-reloaded.php  # Main plugin file
├── class.add-from-server.php     # Core functionality
├── add-from-server.css           # Styles
├── add-from-server.js            # JavaScript
├── compat.php                    # PHP compatibility
├── languages/                    # Translation files
└── readme.txt                    # WordPress.org readme
```

### Security Features
- Directory traversal protection
- File type validation
- CSRF protection (nonce verification)
- Input sanitization
- Output escaping
- Capability checks
- Real path validation

---

## Contributing

Contributions are welcome! This is an open-source project.

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

---

## License

This plugin is licensed under the **GPL-3.0+ License**.

See the [LICENSE](LICENSE) file for details.

---

## Credits

- **Original Plugin:** [Add From Server](https://wordpress.org/plugins/add-from-server/) by Dion Hulse (70,000+ active installs)
- **Forked & Enhanced:** [eLearning evolve](https://elearningevolve.com/)
- **Contributors:** Adeel, eLearning evolve team

---

## Support

- **WordPress.org Support:** [Plugin Support Forum](https://wordpress.org/support/plugin/add-from-server-reloaded/)
- **Bug Reports:** [GitHub Issues](https://github.com/adeel-raza/add-from-server-reloaded/issues)
- **Documentation:** See plugin settings page in WordPress admin

---

## Like This Plugin?

If this plugin has saved you time or solved your upload limit problems:

- [Rate it 5 stars](https://wordpress.org/support/plugin/add-from-server-reloaded/reviews/) on WordPress.org
- Share it with others who might need it
- Leave feedback to help us improve
- [Support the project](https://link.elearningevolve.com/self-pay)

---

## Links

- [WordPress.org Plugin Page](https://wordpress.org/plugins/add-from-server-reloaded/)
- [Download from WordPress.org](https://wordpress.org/plugins/add-from-server-reloaded/)
- [GitHub Repository](https://github.com/adeel-raza/add-from-server-reloaded)
- [Changelog](CHANGELOG.md)
- [License](LICENSE)

---

**Made by [eLearning evolve](https://elearningevolve.com/)**

*Bypass WordPress upload limits the easy way!*

---

## SEO Keywords & Search Terms

This plugin helps with:
- wordpress upload limit
- wordpress file size limit
- wordpress maximum upload size
- wordpress upload large files
- wordpress bypass upload limit
- wordpress upload_max_filesize
- wordpress large file upload
- wordpress import files from server
- wordpress bulk import images
- wordpress ftp import media
- wordpress upload timeout
- wordpress post_max_size exceeded
- wordpress shared hosting upload limit
- wordpress woocommerce bulk images
- wordpress media library import
- wordpress upload limit exceeded
- wordpress file exceeds maximum upload size
- wordpress increase upload limit
- wordpress upload limit 64mb
- wordpress upload limit 128mb
- wordpress upload limit shared hosting
- wordpress upload large video
- wordpress upload raw photos
- wordpress import media library
- wordpress server file import

## SEO-Optimized: Find This Plugin When You Search For...

### Common Search Queries This Plugin Solves:

- **"wordpress upload limit exceeded"** - Bypass upload_max_filesize errors
- **"wordpress file size limit"** - Import files larger than hosting allows
- **"wordpress maximum upload size"** - No more 64MB or 128MB restrictions
- **"wordpress upload large files"** - Upload 4K videos, RAW photos, large PDFs
- **"wordpress bypass upload limit"** - Import from server, skip upload process
- **"wordpress upload_max_filesize"** - Works without editing php.ini
- **"wordpress large file upload"** - Handle files of any size
- **"wordpress import files from server"** - Direct server-to-media-library import
- **"wordpress bulk import images"** - Import hundreds of product images
- **"wordpress ftp import media"** - Use FTP to upload, plugin to import
- **"wordpress upload timeout"** - No timeouts, files already on server
- **"wordpress post_max_size exceeded"** - Bypass all PHP upload limits
- **"wordpress shared hosting upload limit"** - Works on all hosting types
- **"wordpress woocommerce bulk images"** - Perfect for e-commerce stores
- **"wordpress media library import"** - Import existing files to media library
