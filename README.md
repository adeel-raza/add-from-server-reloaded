# Add From Server Reloaded

![WordPress Plugin Version](https://img.shields.io/badge/version-5.0.0-blue)
![WordPress Compatibility](https://img.shields.io/badge/WordPress-6.0--6.8-brightgreen)
![PHP Compatibility](https://img.shields.io/badge/PHP-7.4--8.3-purple)
![License](https://img.shields.io/badge/license-GPL--3.0-orange)

**Upload files larger than your hosting allows. Import from server to WordPress Media Library. Batch import, migrations, no upload limit. WordPress 6.8+ compatible.**

---

## Fix WordPress Upload Limit Issues - The Easy Way

Tired of seeing *"The uploaded file exceeds the upload_max_filesize directive"* errors? Can't upload large videos because your hosting limits uploads to 64MB? Need to bulk import hundreds of product images but keep timing out?

**Add From Server Reloaded** solves all these problems by letting you import files directly from your server to WordPress Media Library - bypassing upload limits entirely. No PHP configuration needed. No server access required.

---

## Common Upload Limit Problems We Solve

- "File exceeds maximum upload file size" error
- Can't upload 4K/8K videos (too large)
- WordPress upload limit too small for RAW photos
- Bulk product image imports timeout
- Large PDF files rejected
- Site migrations where media won't import
- "post_max_size exceeded" errors
- Slow internet making uploads impossible

---

## How It Works (3 Simple Steps)

1. **Upload via FTP/SSH** - Put your files on the server (no size limit)
2. **Import to WordPress** - Use our plugin to scan and select files
3. **Done!** - Files now appear in Media Library, ready to use

---

## Key Features

- **Browse Server Files** - Navigate your server's file system directly from WordPress
- **Bulk Import** - Import individual files or entire folders at once
- **Duplicate Detection** - Prevents importing the same file multiple times
- **Enhanced Security** - Directory traversal prevention, file type validation, and nonce verification
- **Search Functionality** - Quickly find files with real-time search
- **Modern UI** - Clean, intuitive interface following WordPress design standards
- **Configurable Root Directory** - Easily change the browsing root without editing config files
- **WordPress 6.8+ Compatible** - Fully tested with the latest WordPress version

---

## Security Features

- Real path validation to prevent directory traversal attacks
- WordPress MIME type checking for file uploads
- CSRF protection with nonce verification
- Capability checks ensuring only authorized users can access
- Input sanitization and output escaping throughout
- HTTPS-only cookies
- Dangerous file type blocking (PHP, EXE, SH, BAT)

---

## Perfect For

- **Video Creators** - Import 4K/8K videos without upload limits
- **Photographers** - Import RAW photos (50MB+ files)
- **E-commerce** - Bulk import product catalogs and WooCommerce images
- **Agencies** - Streamline client site migrations
- **Developers** - FTP workflow integration
- **Site Migrations** - Import existing media libraries
- **Content Sites** - Bulk import PDF documents and resources

---

## Why Choose Add From Server Reloaded?

### vs. Editing php.ini:
- No server configuration needed
- Non-technical users can do it
- Won't break other sites on shared hosting
- Works even without server access

### vs. The Original Add From Server:

| Feature | Original Plugin | Add From Server Reloaded |
|---------|----------------|--------------------------|
| **Last Update** | 2020 (abandoned) | **2025 (active)** |
| **WordPress Support** | Up to 5.5 only | **Up to 6.8** |
| **PHP Support** | 5.6 - 7.4 | **7.4 - 8.3** |
| **Security** | ❌ Vulnerable | ✅ **Hardened & Secure** |
| **Duplicate Detection** | ❌ None | ✅ **Smart Detection** |
| **Folder Import** | ❌ Files Only | ✅ **Folders + Subfolders** |
| **Real-Time Search** | ❌ No Search | ✅ **Live Search** |
| **Mobile Responsive** | ❌ Broken | ✅ **Fully Responsive** |
| **Visual Feedback** | ❌ None | ✅ **Progress Indicators** |
| **Translation Ready** | ❌ No | ✅ **POT File Included** |
| **Clean Uninstall** | ❌ Leaves Data | ✅ **Clean Removal** |
| **Root Config** | Config File Only | ✅ **Admin Panel + Config** |
| **Support** | ❌ None | ✅ **Active Support** |

### vs. Upgrading Hosting:
- Save $10-50/month
- Keep your current setup
- No migration headaches

---

## Installation

1. Upload the `add-from-server-reloaded` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to Media > Add From Server Reloaded
4. Browse and import your files!

### Changing the Root Directory

By default, the plugin browses from your WordPress installation directory. To change this:

1. Go to Media > Add From Server Reloaded
2. Scroll to the bottom "Change Root Directory" section
3. Enter the full server path (e.g., `/var/www/media/`)
4. Click "Save Changes"

Alternatively, add this to your `wp-config.php`:
```php
define( 'ADD_FROM_SERVER_RELOADED', '/path/to/your/files/' );
```

---

## Frequently Asked Questions

### How do I bypass WordPress upload limit?

Upload your file via FTP or SSH (which has no size limit), then use this plugin to import it to your WordPress Media Library. This completely bypasses the upload_max_filesize restriction.

### Why does WordPress say my file exceeds the maximum upload size?

Your hosting has set a upload_max_filesize limit (often 64MB or less on shared hosting). This plugin bypasses that limit by importing files already on your server, avoiding the WordPress upload process entirely.

### Can I upload large videos to WordPress with this plugin?

Yes! Upload your video file via FTP to bypass the upload limit, then import it using this plugin. Works perfectly for 4K videos, 8K videos, large PDFs, RAW photos, and any file type WordPress supports.

### Will this work with WooCommerce product images?

Yes! Perfect for bulk importing product images. Upload all your product images via FTP, then batch import them to Media Library. Much faster than uploading one by one.

### Can I import entire folders?

Yes! Simply check the checkbox next to a folder name to import all files within it, including subfolders. Great for bulk imports.

### Will this create duplicate files in my media library?

No. The plugin detects duplicates and prevents re-importing files that already exist in your Media Library.

---

## What's New in Version 5.0.0

### Major Update - October 25, 2025

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

[View Full Changelog](CHANGELOG.md)

---

## Screenshots

1. **Main Plugin Interface** - Browse files and folders with modern UI, checkboxes for selection, and search functionality
2. **File Search in Action** - Real-time search filtering with instant results
3. **Folder Import** - Select entire folders to import all files at once, including subfolders
4. **Import Success Message** - Consolidated results showing all imported files with clickable Media Library links
5. **Root Directory Configuration** - Admin panel for easy root directory changes without editing config files
6. **Mobile Responsive View** - Clean interface that works perfectly on tablets and phones

---

## Compatibility

- WordPress 6.0 - 6.8
- PHP 7.4 - 8.3
- Works with WooCommerce
- Works with page builders
- Works on shared hosting
- Multi-site compatible

---

## Contributing

This is an open-source project. Contributions are welcome!

---

## License

This plugin is licensed under the GPL-3.0+ License. See [LICENSE](LICENSE) file for details.

---

## Credits

- **Original Plugin:** [Add From Server](https://wordpress.org/plugins/add-from-server/) by Dion Hulse (70,000+ active installs)
- **Forked & Enhanced:** [eLearning evolve](https://elearningevolve.com/)
- **Contributors:** Very Good Plugins team

---

## Support

- **Documentation:** See plugin settings page in WordPress admin
- **Bug Reports:** [WordPress.org Support Forum](https://wordpress.org/support/plugin/add-from-server-reloaded/)
- **Feature Requests:** [WordPress.org Support Forum](https://wordpress.org/support/plugin/add-from-server-reloaded/)

---

## Like This Plugin?

If this plugin has saved you time or solved your upload limit problems, please consider:
- [Rating it 5 stars](https://wordpress.org/support/plugin/add-from-server-reloaded/reviews/) on WordPress.org
- Sharing it with others who might need it
- Leaving feedback to help us improve

---

**Made by [eLearning evolve](https://elearningevolve.com/)**

*Bypass WordPress upload limits the easy way!*
