<?php

defined('_JEXEC') or die;

$wa->addInlineStyle('
:root {
	--bannercolor: ' . $params->get('bannercolor') . ';
	--bannerheight: ' . $params->get('bannerheight') . 'vh;
	--banneroverlay: ' . $params->get('banneroverlay') . ';
	--bodybg: ' . $params->get('bodybg') . ';
	--bodycolor: ' . $params->get('bodycolor') . ';
	--bodysize: ' . $params->get('bodysize') . 'rem;
	--bottomabg:  ' . $params->get('bottomabg') . ';
	--bottombbg:  ' . $params->get('bottombbg') . ';
	--btnbg: ' . $params->get('btnbg') . ';
	--btnbgh: ' . $params->get('btnbgh') . ';
	--btncolor: ' . $params->get('btncolor') . ';
	--btncolorh: ' . $params->get('btncolorh') . ';
	--footerbg: ' . $params->get('footerbg') . ';
	--footercolor: ' . $params->get('footercolor') . ';
	--h1size: ' . $params->get('h1') . 'rem;
	--h2size: ' . $params->get('h2') . 'rem;
	--h3size: ' . $params->get('h3') . 'rem;
	--headerbg: ' . $params->get('headerbg') . ';
	--headercolor: ' . $params->get('headercolor') . ';
	--linkcolor: ' . $params->get('linkcolor') . ';
	--linkcolorh: ' . $params->get('linkcolorh') . ';
	--topabg:  ' . $params->get('topabg') . ';
	--topbbg:  ' . $params->get('topbbg') . ';
	--wrapperwidth: ' . $params->get('wrapperwidth') . 'px;
}'
);
