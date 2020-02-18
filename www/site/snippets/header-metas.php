<meta name="description" content="<? e($page->ogdescription()->isNotEmpty(), $page->ogdescription()->text(), $site->description()->text())  ?>">
    <meta name="keywords" content="<?= $site->keywords()->text() ?>">

    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $kirby->urls()->assets() ?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $kirby->urls()->assets() ?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= $kirby->urls()->assets() ?>/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= $kirby->urls()->assets() ?>/favicons/safari-pinned-tab.svg" color="#333333">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-config" content="<?= $kirby->urls()->assets() ?>/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:url" content="<?= $page->url() ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= r($page !== $site->homePage(), $page->title() . ' – ') . $site->title() ?>">
    <meta property="og:description" content="<? e($page->ogdescription()->isNotEmpty(), $page->ogdescription()->text(), $site->description()->text())  ?>">
    <meta property="og:site_name" content="<?= $site->title() ?>">
    <meta property="og:locale" content="<?= $kirby->language() ?>">
    <?php if ($page->ogimage()->isNotEmpty()) {
            $cover = $page->ogimage()->first()->toFile();
        } elseif ($page->cover()->isNotEmpty()) {
            $cover = $page->cover()->toFile();
        } else {
            $cover = page('home')->images()->filterBy('template', 'logo')->first();
        }
        $og_cover = $cover->thumb(['width' => 1200, 'height' => 630, 'crop' => true]);
    ?>

    <meta property="og:image" content="<?= $og_cover->url() ?>">
    <meta property="og:image:width" content="<?= $og_cover->width() ?>">
    <meta property="og:image:height" content="<?= $og_cover->height() ?>">


