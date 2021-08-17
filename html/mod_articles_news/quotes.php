<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('quotes', 'quotes.css');

if (!$list)
{
	return;
}

?>
<div id="quotes">
	<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
	<?php $item = $list[$i]; ?>
	<div class="quote-box">
		<div class="quote-content">
			<div class="quote-icon">
				<svg width="70px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 91.2 62.6" style="enable-background:new 0 0 91.2 62.6;" xml:space="preserve">
					<g id="quotes" transform="translate(0 -80.25)">
						<path id="quote" class="st0" d="M20,103c11,0,19.9,8.9,19.9,19.9S31,142.9,20,142.9S0.1,134,0.1,123c0,0,0,0,0,0L0,120.1   c0-22,17.8-39.9,39.9-39.9l0,0v11.4c-7.6,0-14.8,3-20.1,8.3c-1,1-2,2.1-2.8,3.3C17.9,103.1,19,103,20,103z M71.3,103   c11,0,19.9,8.9,19.9,19.9s-8.9,19.9-19.9,19.9S51.3,134,51.3,123l-0.1-2.8c0-22,17.8-39.9,39.9-39.9v11.4c-7.6,0-14.8,3-20.1,8.3   c-1,1-2,2.1-2.8,3.3C69.2,103.1,70.2,103,71.3,103z"/>
					</g>
				</svg>
			</div>
			<?php echo $item->introtext; ?>
			<p class="quote-title"><?php echo $item->title; ?></p>
		</div>
	</div>
	<?php endfor; ?>
</div>

