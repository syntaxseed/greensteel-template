<?php
/**
 * Template header, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** HEADER ********** -->
<div id="dokuwiki__header"><div class="pad group">

    <?php tpl_includeFile('header.html') ?>

    <div class="headings group">
        <ul class="a11y skip">
            <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content']; ?></a></li>
        </ul>

        <h1><?php
            // get logo either out of the template images folder or data/media folder
            $logoSize = array();
            $logo = tpl_getMediaFile(array(':wiki:logo.png', 'images/logo.png'), false, $logoSize);

            // display logo and wiki title in a link to the home page
            tpl_link(
                wl(),
                '<img src="'.$logo.'" '.$logoSize[3].' alt="" /> <span>'.$conf['title'].'</span>',
                'accesskey="h" title="[H]"'
            );
        ?></h1>
        <?php if ($conf['tagline']): ?>
            <p class="claim"><?php echo $conf['tagline']; ?></p>
        <?php endif ?>
    </div>

    <div class="tools group">
        <!-- USER TOOLS -->
        <?php if ($conf['useacl']): ?>
            <div id="dokuwiki__usertools">
                <h3 class="a11y"><?php echo $lang['user_tools']; ?></h3>
                <ul>
                    <?php
                        if ($_SERVER['REMOTE_USER']) {
                            echo '<li class="user">';
                            tpl_userinfo(); /* 'Logged in as ...' */
                            echo '</li>';
                        }
                  
                  		$items = (new \dokuwiki\Menu\UserMenu())->getItems();
                        foreach($items as $item) {
                            echo '<li>'
                                .'<a href="'.$item->getLink().'" title="'.$item->getTitle().'">'
                                .'<span class="icon">'.inlineSVG($item->getSvg()).'</span>'
                                . '<span class="a11y">'.$item->getLabel().'</span>'
                                . '</a></li>';
                        }                  
                        
                    ?>
                </ul>
            </div>
        <?php endif ?>

        <!-- SITE TOOLS -->
        <div id="dokuwiki__sitetools">
            <h3 class="a11y"><?php echo $lang['site_tools']; ?></h3>
            <?php tpl_searchform(); ?>
            <div class="mobileTools">
              
              <?php 
              //tpl_actiondropdown($lang['tools']); 
              echo (new \dokuwiki\Menu\MobileMenu())->getDropdown($lang['tools']);
              ?>
            </div>
            <ul>
                <?php
              		// Show Site Menu
                    $items = (new \dokuwiki\Menu\SiteMenu())->getItems();
                    foreach($items as $item) {
                        echo '<li>'
                            . '<a href="'.$item->getLink().'" title="'.$item->getTitle().'">'
                            . '<span class="icon">'.inlineSVG($item->getSvg()).' '.$item->getLabel().'</span>'
                            . '</a></li>';
                    }
              
                    //tpl_action('recent', 1, 'li');
                    //tpl_action('media', 1, 'li');
                    //tpl_action('index', 1, 'li');
                ?>
            </ul>
        </div>

    </div>

    <!-- BREADCRUMBS -->
    <?php if($conf['breadcrumbs'] || $conf['youarehere']): ?>
        <div class="breadcrumbs">
            <?php if($conf['youarehere']): ?>
                <div class="youarehere"><?php tpl_youarehere() ?></div>
            <?php endif ?>
            <?php if($conf['breadcrumbs']): ?>
                <div class="trace"><?php tpl_breadcrumbs() ?></div>
            <?php endif ?>
        </div>
    <?php endif ?>

    <?php html_msgarea() ?>

    <hr class="a11y" />
</div></div><!-- /header -->
