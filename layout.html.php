<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<!DOCTYPE html>
<html lang="<?php echo blog_language(); ?>">
<head>
    <?php echo head_contents(); ?>
    <link rel="webmention" href="https://webmention.io/yourdomain.com/webmention" />
    <!-- Deine Styles etc. -->
</head>
<body>
    <!-- Hier dein normaler Content -->
    <?php echo content(); ?>

    <!-- Webmention Cache einbinden -->
    <?php include __DIR__ . '/webmention-cache.php'; ?>
</body>
</html>

