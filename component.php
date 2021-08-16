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

// Load Icons
if ($params->get('icons') == 1)
{
	$wa->useStyle('fontawesome');
	$this->getPreloadManager()->preload($wa->getAsset('style', 'fontawesome')->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);
}
elseif ($params->get('icons') == 2)
{
	$wa->registerAndUseStyle('bi-icons', $templatePath . '/css/bootstrap-icons.css');
	$wa->registerAndUseStyle('icons', $templatePath . '/css/icons.css');
	$this->getPreloadManager()->preload($wa->getAsset('style', 'bi-icons')->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);
	$this->getPreloadManager()->preload($wa->getAsset('style', 'icons')->getUri() . '?' . $this->getMediaVersion(), ['as' => 'style']);
}

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

/// Favicons
include 'includes/favicons.php';

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
