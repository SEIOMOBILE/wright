<?php
// Wright v.3 Override: Joomla 2.5.17
/**
 * @package		Joomla.Site
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$class = ' class="first"';
if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) :
?>
<ul>
<?php foreach($this->children[$this->category->id] as $id => $child) : ?>
	<?php
	if($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) :
	if(!isset($this->children[$this->category->id][$id + 1]))
	{
		$class = ' class="last"';
	}
	?>
	<li<?php echo $class; ?>>
		<?php $class = ''; ?>
			<h3>  <?php // Wright v.3: Added h3 ?>
				<span class="item-title"><a href="<?php echo JRoute::_(WeblinksHelperRoute::getCategoryRoute($child->id));?>">
					<i class="icon-folder-open"></i>  <?php // Wright v.3: Added icon ?>
					<?php echo $this->escape($child->title); ?></a>
				</span>
			</h3>  <?php // Wright v.3: Added h3 ?>

			<?php if ($this->params->get('show_subcat_desc') == 1) :?>
			<?php if ($child->description) : ?>
				<div class="category-desc">
					<?php echo JHtml::_('content.prepare', $child->description, '', 'com_weblinks.category'); ?>
				</div>
			<?php endif; ?>
            <?php endif; ?>

            <?php if ($this->params->get('show_cat_num_links') == 1) :?>
			<dl class="weblink-count"><dt>
				<span class="label label-info"><?php echo JText::_('COM_WEBLINKS_NUM') . ' ' . $child->numitems ?></span>  <?php // Wright v.3: Changed links # format ?>
				<?php /*  Wright v.3: Commented out classic links # format
				<?php echo JText::_('COM_WEBLINKS_NUM'); ?></dt>
				<dd><?php echo $child->numitems; ?></dd>
				*/ ?>
			</dl>
		<?php endif; ?>

			<?php if(count($child->getChildren()) > 0 ) :
				$this->children[$child->id] = $child->getChildren();
				$this->category = $child;
				$this->maxLevel--;
				echo $this->loadTemplate('children');
				$this->category = $child->getParent();
				$this->maxLevel++;
			endif; ?>
		</li>
	<?php endif; ?>
	<?php endforeach; ?>
	</ul>
<?php endif;
