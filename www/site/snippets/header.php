<!DOCTYPE html>
<html lang="<?php echo $kirby->language() ?? 'fr' ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="cleartype" content="on">

    <script>document.getElementsByTagName('html')[0].className = 'js'</script>

    <title><?= r($page !== $site->homePage(), $page->title()->html() . ' | ') . $site->title()->html() ?></title>

    <?php snippet("header-metas") ?>

    <link rel="alternate" type="application/rss+xml" title="<?= t('feed') ?>" href="<?= site()->url() ?>/feed"/>
    <?php echo liveCSS('assets/builds/bundle.css') ?>

</head>
<?php 
  if($page->depth() < 2 ){
      $rootParent = $page->slug();
  } else{
      $rootParent = $page->parents()->last()->slug();
  } ?>
<body
    class="section-<?= $rootParent ?>"
    data-login="<?php e($kirby->user(),'true', 'false') ?>"
    data-template="<?php echo $page->template() ?>"
    data-intended-template="<?php echo $page->intendedTemplate() ?>">


    <div id="wrap" class="wrap">

      <header class="header cf" role="banner" id="header">
          <h1 id="logo">
            <a href="<?php echo $site->url() ?>"><span>Maison</span> des éditions</a>
          </h1>
          
          <?php snippet('header-nav') ?>
      </header>  
