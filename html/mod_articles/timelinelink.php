<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles
 *
 * @copyright   (C) 2024 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('timeline', 'timeline.css');

if (!$list)
{
    return;
}

?>
<div id="timeline">
    <?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
    <?php $item = $list[$i]; ?>
    <div class="timeline-item">
        <div class="timeline-icon">
        </div>
        <div class="timeline-content">
            <h2>
                <a href="<?php echo $item->link; ?>">
                    <?php echo $item->title; ?>
                </a>
            </h2>

            <?php if (in_array($params->get('img_intro_full'), ['intro', 'full']) && !empty($item->imageSrc)) : ?>
                <?php echo LayoutHelper::render('joomla.content.' . $params->get('img_intro_full') . '_image', $item); ?>
            <?php endif; ?>

            <?php echo $item->introtext; ?>
        </div>
    </div>
    <?php endfor; ?>
</div>

