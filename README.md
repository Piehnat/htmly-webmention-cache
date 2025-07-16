# HTMLy Webmention Cache

This simple PHP script fetches Webmentions from webmention.io, caches them locally, and displays them on your HTMLy blog.

## Features

- Fetches latest Webmentions for your domain via webmention.io API  
- Caches responses locally for improved performance and reduced API calls  
- Easy integration with your HTMLy theme  
- Minimal dependencies, pure PHP  

## Installation

1. Clone or download this repository into your HTMLy blog directory or theme folder.  
2. Make sure the `cache/` folder exists and is writable by your web server.  
3. Edit `webmention-cache.php` and set your domain in the `$domain` variable.  
4. Include the `webmention-cache.php` in your theme layout where you want the Webmentions to appear:

   ```php
   <?php include __DIR__ . '/webmention-cache.php'; ?>
   ```

5. Add the Webmention link tag to your HTML `<head>` (e.g. in `layout.html.php`):

   ```html
   <link rel="webmention" href="https://webmention.io/yourdomain.com/webmention" />
   ```

## Usage

Just visit your blog — Webmentions will be fetched and displayed automatically.

## License

MIT License — feel free to use and modify.

---

*Created by piehnat*
