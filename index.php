<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();
$document = $app->getDocument();

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Template path
$templatePath = 'templates/' . $this->template;

// Load burgerMenu
$hasBurger = '';

if ($this->params->get('burgerMenu') == 1)
{
	$wa->registerAndUseScript('burger', $templatePath . '/js/burger-menu.js');
	$hasBurger .= 'with-burger';
}

// Load FontAwesome
if ($this->params->get('fontawesome') == 1)
{
	$wa->useStyle('fontawesome');
	//$this->getPreloadManager()->prefetch($wa->getAsset('style', 'fontawesome')->getUri(), ['as' => 'style']);
}

// Use a font scheme if set in the template style options
$paramsFontScheme = $this->params->get('useFontScheme', false);

if ($paramsFontScheme)
{
	// Prefetch the stylesheet for the font scheme, actually we need to prefetch the font(s)
	$assetFontScheme  = 'fontscheme.' . $paramsFontScheme;
	$wa->registerAndUseStyle($assetFontScheme, $templatePath . '/css/global/' . $paramsFontScheme . '.css');
	$this->getPreloadManager()->prefetch($wa->getAsset('style', $assetFontScheme)->getUri(), ['as' => 'style']);
}

// Enable assets
$wa->usePreset('template.nature')
	->useStyle('template.user')
	->useScript('template.user');

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . Uri::root() . htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '">';
}
elseif ($this->params->get('siteTitle'))
{
	$logo = '<span title="' . $sitename . '">' . htmlspecialchars($this->params->get('siteTitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<img src="' . $templatePath . '/images/nature-logo.png" class="logo" alt="' . $sitename . '">';
}

$hasClass = '';

if ($this->countModules('sidebar-left', true))
{
	$hasClass .= 'with-sidebar-left';
}

if ($this->countModules('sidebar-right', true))
{
	$hasClass .= 'with-sidebar-right';
}

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

$stickyHeader = $this->params->get('stickyHeader') ? 'position-sticky sticky-top' : '';

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<?php include "includes/style.php";?>
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ' ' . $pageclass;
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
	<?php if ($this->countModules('top-header', true)) : ?>
		<div class="container-top-header">
			<div class="wrapper">
				<jdoc:include type="modules" name="top-header" style="none" />
			</div>
		</div>
	<?php endif; ?>
	<header class="header <?php echo $stickyHeader; ?>">
		<a href="#main" class="skip-link">Skip to main content</a>
		<div class="wrapper">
			<div class="navbar-brand">
				<a class="brand-logo" href="<?php echo $this->baseurl; ?>/">
					<?php echo $logo; ?>
				</a>
				<?php if ($this->params->get('siteDescription')) : ?>
					<div class="site-description"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></div>
				<?php endif; ?>
			</div>
			<?php if ($this->countModules('menu', true)) : ?>
				<nav class="navbar-top <?php echo $hasBurger; ?>" aria-label="Top Navigation" id="menu">
					<jdoc:include type="modules" name="menu" style="none" />
				</nav>
			<?php endif; ?>

			<?php if (($this->countModules('menu', true)) || ($this->countModules('search', true))) : ?>
				<div class="container-buttons">
					<?php if (($this->countModules('menu', true)) && ($this->params->get('burgerMenu') == 1) ): ?>
					<span hidden id="menu-label">Main menu</span>
					<button class="menu-toggle" id="menu-toggle" aria-labelledby="menu-label" aria-expanded="false">Menu</button>
					<?php endif; ?>
					<?php if ($this->countModules('search', true)) : ?>
					<button class="search-icon" id="search-icon" aria-label="Search"></button>
					<div class="container-search">
						<jdoc:include type="modules" name="search" style="none" />
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</header>

	<?php if ($this->countModules('banner', true)) : ?>
		<div class="container-banner">
			<jdoc:include type="modules" name="banner" style="none" />
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('top-a', true)) : ?>
	<div class="container-top-a">
		<div class="grid <?php echo $this->params->get('topa') ? 'wrapper' : 'full-width'; ?> columns-<?php echo $this->params->get('topacols'); ?>">
			<jdoc:include type="modules" name="top-a" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('top-b', true)) : ?>
	<div class="container-top-b">
		<div class="grid <?php echo $this->params->get('topb') ? 'wrapper' : 'full-width'; ?> columns-<?php echo $this->params->get('topbcols'); ?>">
			<jdoc:include type="modules" name="top-b" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<main id="main" tabindex="-1">
		<div class="wrapper">
			<jdoc:include type="modules" name="breadcrumbs" style="none" />
			<?php if ($this->countModules('main-top', true)) : ?>
				<jdoc:include type="modules" name="main-top" style="none" />
			<?php endif; ?>
			<jdoc:include type="message" />
			<div class="main-content  <?php echo $hasClass; ?>">
					<?php if (($this->params->get('sidebar') == 0) && ($this->countModules('sidebar-left', true))) : ?>
						<div class="container-sidebar sidebar--left">
							<jdoc:include type="modules" name="sidebar-left" style="html5" />
						</div>
					<?php endif; ?>

					<jdoc:include type="component" />

					<?php if (($this->params->get('sidebar') == 1) && ($this->countModules('sidebar-right', true))) : ?>
						<div class="container-sidebar sidebar--right">
							<jdoc:include type="modules" name="sidebar-right" style="html5" />
						</div>
					<?php endif; ?>
			</div>
			<?php if ($this->countModules('main-bottom', true)) : ?>
				<jdoc:include type="modules" name="main-bottom" style="none" />
			<?php endif; ?>
		</div>
	</main>

	<?php if ($this->countModules('bottom-a', true)) : ?>
	<div class="container-bottom-a">
		<div class="grid <?php echo $this->params->get('bottoma') ? 'wrapper' : 'full-width'; ?> columns-<?php echo $this->params->get('bottomacols'); ?>">
			<jdoc:include type="modules" name="bottom-a" style="html5" />
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('bottom-b', true)) : ?>
	<div class="container-bottom-b">
		<div class="grid <?php echo $this->params->get('bottomb') ? 'wrapper' : 'full-width'; ?> columns-<?php echo $this->params->get('bottombcols'); ?>">
			<jdoc:include type="modules" name="bottom-b" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->countModules('footer', true)) : ?>
	<footer class="container-footer">
		<div class="wrapper">
			<jdoc:include type="modules" name="footer" style="none" />
		</div>
	</footer>
	<?php endif; ?>

	<?php if ($this->params->get('backTop') == 1) : ?>
		<div class="back-to-top-wrapper">
			<a href="#top" id="back-top" class="back-to-top-link" aria-label="<?php echo Text::_('TPL_NATURE_BACKTOTOP'); ?>">
				<span class="arrow-up" aria-hidden="true">&#9650;</span>
			</a>
		</div>
	<?php endif; ?>

	<jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
