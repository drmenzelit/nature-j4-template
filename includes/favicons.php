<?php

defined('_JEXEC') or die;
use Joomla\CMS\HTML\HTMLHelper;

$path = '';

if ($params->get('favicons') == 0)
{
	$path = $templatePath . '/';
}

// Favicons
$this->addHeadLink($path . 'images/favicons/apple-touch-icon.png', 'apple-touch-icon', 'rel', ['sizes' => '180x180']);
$this->addHeadLink($path . 'images/favicons/favicon-32x32.png', 'icon', 'rel', ['sizes' => '32x32', 'type' => 'image/png']);
$this->addHeadLink($path . 'images/favicons/favicon-16x16.png', 'icon', 'rel', ['sizes' => '16x16', 'type' => 'image/png']);
$this->addHeadLink($path . 'images/favicons/safari-pinned-tab.svg', 'mask-icon', 'rel', ['color' => '#41599a']);
$this->addHeadLink($path . 'images/favicons/site.webmanifest', 'manifest', 'rel', []);
$this->addHeadLink($path . 'images/favicons/favicon.ico', 'shortcut icon', 'rel', []);
$this->setMetaData('msapplication-config', $path . 'images/favicons/browserconfig.xml');
$this->setMetaData('theme-color', '#ffffff');
