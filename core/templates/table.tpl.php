<table <?php print html_attr($data['attr'] ?? []) ?>>
	<tr>
        <?php foreach ($data['headings'] as $heading): ?>
			<th><?php print $heading ?></th>
        <?php endforeach; ?>
	</tr>
    <?php foreach ($data['rows'] ?? [] as $row): ?>
		<tr>
            <?php foreach ($row as $col): ?>
                <?php if (is_array($col)) : ?>
					<td colspan="2">
                    <?php foreach ($col as $col_element) : ?>
						<?php print $col_element ?>
                    <?php endforeach; ?>
					</td>
                <?php else : ?>
					<td><?php print $col ?></td>
                <?php endif; ?>
            <?php endforeach; ?>
		</tr>
    <?php endforeach; ?>
</table>