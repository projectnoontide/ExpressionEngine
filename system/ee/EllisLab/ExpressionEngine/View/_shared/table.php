<style type="text/css">
/* Hack for capybara-webkit, leave in place for now */
a.sort,
a.icon--sync {
	display: inline-block;
	min-width: 1px;
}
</style>

<?php
use EllisLab\ExpressionEngine\Library\CP\Table;

if ($grid_input): ?>
	<?php include(SYSPATH.'ee/EllisLab/ExpressionEngine/View/_shared/grid.php'); ?>
<?php else: ?>

<div class="app-listing-scroll">
<?php if (empty($columns) && empty($data)): ?>
	<table cellspacing="0" class="empty no-results">
		<tr>
			<td>
				<?=lang($no_results['text'])?>
				<?php if ( ! empty($no_results['action_text'])): ?>
					<a <?=$no_results['external'] ? 'rel="external"' : '' ?> href="<?=$no_results['action_link']?>"><?=lang($no_results['action_text'])?></a>>
				<?php endif ?>
			</td>
		</tr>
	</table>
<?php else: ?>
	<table class="app-listing<?=$class ? ' '.$class: ''?>" <?php foreach ($table_attrs as $key => $value):?> <?=$key?>='<?=$value?>'<?php endforeach; ?>>
		<thead>
			<tr class="app-listing__row app-listing__row--head">
				<?php
				// Don't do reordering logic if the table is empty
				$reorder = $reorder && ! empty($data);
				$colspan = ($reorder_header || $reorder) ? count($columns) + 1 : count($columns);

				foreach ($columns as $settings):
					$attrs = (isset($settings['attrs'])) ? $settings['attrs'] : array();
					$label = $settings['label']; ?>
					<?php if ($settings['type'] == Table::COL_CHECKBOX): ?>
						<th class="app-listing__header text--center">
							<?php if ( ! empty($data) OR $checkbox_header): // Hide checkbox if no data ?>
								<?php if (isset($settings['content'])): ?>
									<?=$settings['content']?>
								<?php else: ?>
									<input class="input--no-mrg" type="checkbox" title="select all">
								<?php endif ?>
							<?php endif ?>
						</th>
					<?php else: ?>
						<?php
						$header_class = 'app-listing__header';
						if ($sortable && $settings['sort'] && $sort_col == $label)
						{
							$header_class .= ' column-sort---active';
						}
						if (isset($settings['class']))
						{
							$header_class .= ' '.$settings['class'];
						}
						?>
						<th<?php if ( ! empty($header_class)): ?> class="<?=trim($header_class)?>"<?php endif ?><?php foreach ($attrs as $key => $value):?> <?=$key?>="<?=$value?>"<?php endforeach; ?>>
							<?php if (isset($settings['required']) && $settings['required']): ?><span class="required"><?php endif; ?>
							<?php if (isset($settings['required']) && $settings['required']): ?></span><?php endif; ?>
							<?php if (isset($settings['desc']) && ! empty($settings['desc'])): ?>
								<span class="grid-instruct"><?=lang($settings['desc'])?></span>
							<?php endif ?>
							<?php if ($sortable && $settings['sort'] && $base_url != NULL): ?>
								<?php
								$url = clone $base_url;
								$arrow_dir = ($sort_col == $label) ? $sort_dir : 'desc';
								$link_dir = ($arrow_dir == 'asc') ? 'desc' : 'asc';
								$url->setQueryStringVariable($sort_col_qs_var, $label);
								$url->setQueryStringVariable($sort_dir_qs_var, $link_dir);
								?>
								<a href="<?=$url?>" class="column-sort column-sort--<?=$arrow_dir?>">
									<?=($lang_cols) ? lang($label) : $label ?>
								</a>
							<?php else: ?>
								<?=($lang_cols) ? lang($label) : $label ?>
							<?php endif ?>
						</th>
					<?php endif ?>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<?php
			// Output this if Grid input so we can dynamically show it via JS
			if (empty($data)): ?>
				<tr class="no-results<?php if ( ! empty($action_buttons) || ! empty($action_content)): ?> last<?php endif?>">
					<td class="solo" colspan="<?=$colspan?>">
						<?=lang($no_results['text'])?>
						<?php if ( ! empty($no_results['action_text'])): ?>
							<a rel="add_row" <?=$no_results['external'] ? 'rel="external"' : '' ?> href="<?=$no_results['action_link']?>"><?=lang($no_results['action_text'])?></a>
						<?php endif ?>
					</td>
				</tr>
			<?php endif ?>
			<?php $i = 1;
			foreach ($data as $heading => $rows): ?>
				<?php if ( ! $subheadings)
				{
					$rows = array($rows);
				}
				if ($subheadings && ! empty($heading)): ?>
					<tr class="sub-heading"><td colspan="<?=$colspan?>"><?=lang($heading)?></td></tr>
				<?php endif ?>
				<?php
				foreach ($rows as $row):
					if (isset($row['attrs']['class']))
					{
						$row['attrs']['class'] .= ' app-listing__row';
					}
					else
					{
						$row['attrs']['class'] = 'app-listing__row';
					}

					// The last row preceding an action row should have a class of 'last'
					if (( ! empty($action_buttons) || ! empty($action_content)) && $i == min($total_rows, $limit))
					{
						if (isset($row['attrs']['class']))
						{
							$row['attrs']['class'] .= ' last';
						}
						else
						{
							$row['attrs']['class'] = ' last';
						}
					}
					$i++;
					?>
					<tr<?php foreach ($row['attrs'] as $key => $value):?> <?=$key?>="<?=$value?>"<?php endforeach; ?>>
						<?php foreach ($row['columns'] as $column): ?>
							<?php if ($column['type'] == Table::COL_ID): ?>
								<td class="app-listing__cell app-listing__cell--small text--right">
									<span class="text--fade"><?=$column['content']?></span>
								</td>
							<?php elseif ($column['encode'] == TRUE && $column['type'] != Table::COL_STATUS): ?>
								<?php if (isset($column['href'])): ?>
									<td class="app-listing__cell"><a href="<?=$column['href']?>"><?=htmlentities($column['content'], ENT_QUOTES, 'UTF-8')?></a></td>
								<?php else: ?>
									<td class="app-listing__cell"><?=htmlentities($column['content'], ENT_QUOTES, 'UTF-8')?></td>
								<?php endif; ?>
							<?php elseif ($column['type'] == Table::COL_TOOLBAR): ?>
								<td class="app-listing__cell">
									<div class="toolbar-wrap">
										<?=ee()->load->view('_shared/toolbar', $column, TRUE)?>
									</div>
								</td>
							<?php elseif ($column['type'] == Table::COL_CHECKBOX): ?>
								<td class="app-listing__cell app-listing__cell--input text--center">
									<input
										class="input--no-mrg"
										name="<?=form_prep($column['name'])?>"
										value="<?=form_prep($column['value'])?>"
										<?php if (isset($column['data'])):?>
											<?php foreach ($column['data'] as $key => $value): ?>
												data-<?=$key?>="<?=form_prep($value)?>"
											<?php endforeach; ?>
										<?php endif; ?>
										<?php if (isset($column['disabled']) && $column['disabled'] !== FALSE):?>
											disabled="disabled"
										<?php endif; ?>
										type="checkbox"
									>
								</td>
							<?php elseif ($column['type'] == Table::COL_STATUS): ?>
								<?php
									$class = isset($column['class']) ? $column['class'] : $column['content'];
									$style = 'style="';

									// override for open/closed
									if (isset($column['status']) && in_array($column['status'], array('open', 'closed')))
									{
										$class = $column['status'];
									}
									else
									{
										if (isset($column['background-color']) && $column['background-color'])
										{
											$style .= 'background-color: #'.$column['background-color'].';';
											$style .= 'border-color: #'.$column['background-color'].';';
										}

										if (isset($column['color']) && $column['color'])
										{
											$style .= 'color: #'.$column['color'].';';
										}
									}

									$style .= '"';
								?>
								<td class="app-listing__cell"><span class="status-tag st-<?=strtolower($class)?>" <?=$style?>><?=$column['content']?></span></td>
							<?php elseif (isset($column['html'])): ?>
								<td class="app-listing__cell" <?php if (isset($column['attrs'])): foreach ($column['attrs'] as $key => $value):?> <?=$key?>="<?=$value?>"<?php endforeach; endif; ?>>
									<?=$column['html']?>
									<?php if (isset($column['error']) && ! empty($column['error'])): ?>
										<em class="ee-form-error-message"><?=$column['error']?></em>
									<?php endif ?>
								</td>
							<?php else: ?>
								<td class="app-listing__cell"><?=$column['content']?></td>
							<?php endif ?>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			<?php endforeach ?>
			<?php if ( ! empty($action_buttons) || ! empty($action_content)): ?>
				<tr class="tbl-action">
					<td colspan="<?=$colspan?>" class="solo">
						<?php foreach ($action_buttons as $button): ?>
							<a class="<?=$button['class']?>" href="<?=$button['url']?>"><?=$button['text']?></a></td>
						<?php endforeach; ?>
						<?=$action_content?>
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
<?php endif ?>

</div>

<?php endif ?>
