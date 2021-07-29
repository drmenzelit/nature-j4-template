<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app 		= Factory::getApplication();
$document 	= $app->getDocument();
$wa  		= $this->getWebAssetManager();
$params 	= $this->params;

// Template path
$templatePath = 'templates/' . $this->template;

$wa->useStyle('fontawesome');

// Use a font scheme if set in the template style options
$paramsFontScheme = $params->get('useFontScheme', false);

if ($paramsFontScheme)
{
	$assetFontScheme  = 'fontscheme.' . $paramsFontScheme;
	$wa->registerAndUseStyle($assetFontScheme, $templatePath . '/css/global/' . $paramsFontScheme . '.css');
	$this->getPreloadManager()->preload($wa->getAsset('style', $assetFontScheme)->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);
}

// Enable assets
$wa->useStyle('template.nature')
	->useScript('template.nature')
	->useStyle('template.user')
	->useScript('template.user');
$this->getPreloadManager()->preload($wa->getAsset('style', 'template.nature')->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);

// Favicons
$this->addHeadLink(HTMLHelper::_('image', 'apple-touch-icon.png', '', [], true, 1), 'apple-touch-icon', 'rel', ['sizes' => '180x180']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon-32x32.png', '', [], true, 1), 'icon', 'rel', ['sizes' => '32x32', 'type' => 'image/png']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon-16x16.png', '', [], true, 1), 'icon', 'rel', ['sizes' => '16x16', 'type' => 'image/png']);
$this->addHeadLink(HTMLHelper::_('image', 'safari-pinned-tab.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#41599a']);
$this->addHeadLink($templatePath . '/images/site.webmanifest', 'manifest', 'rel', []);

$this->setMetaData('msapplication-TileColor', '#41599a');
$this->setMetaData('theme-color', '#ffffff');
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<?php include "includes/style.php";?>
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="<?php echo $this->direction === 'rtl' ? 'rtl' : ''; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
