<?php

defined('_JEXEC') or die;

// Getting params from template
$params = $app->getTemplate(true)->params;

$document->addStyleDeclaration('
:root {
	--headerbg: '.$params->get('headerbg').';
	--headercolor: '.$params->get('headercolor').';
	--bodybg: '.$params->get('bodybg').';
	--bodycolor: '.$params->get('bodycolor').';
	--linkcolor: '.$params->get('linkcolor').';
	--linkcolorh: '.$params->get('linkcolorh').';
	--bannercolor: '.$params->get('bannercolor').';
	--banneroverlay: '.$params->get('banneroverlay').';
	--btnbg: '.$params->get('btnbg').';
	--btnbgh: '.$params->get('btnbgh').';
	--btncolor: '.$params->get('btncolor').';
	--btncolorh: '.$params->get('btncolorh').';
	--footerbg: '.$params->get('footerbg').';
	--footercolor: '.$params->get('footercolor').';
	--wrapperwidth: '.$params->get('wrapperwidth'). 'px'.';
	--bannerheight: '.$params->get('bannerheight'). 'vh'.';
	--bottomabg:  '.$params->get('bottomabg').';
	--bottombbg:  '.$params->get('bottombbg').';
	--topabg:  '.$params->get('topabg').';
	--topbbg:  '.$params->get('topbbg').';
	--h1size: '.$params->get('h1'). 'rem'.';
	--h2size: '.$params->get('h2'). 'rem'.';
	--h3size: '.$params->get('h3'). 'rem'.';
}
');
