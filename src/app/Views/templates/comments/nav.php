<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(1);
?>
<nav aria-label="Пагинация">
	<ul class="pagination">
		<?php if ($pager->hasPrevious()) : ?>
            <li class="page-item" value="1"><button class="page-link" aria-label="Первая">1</button></li>
            <li class="page-item"><a class="page-link">...</a></li>
		<?php endif ?>

		<?php foreach ($pager->links() as $link) : ?>
			<li class="page-item <?= $link['active'] ? 'active' : '' ?>" value="<?=$link['title']?>">
				<button class="page-link">
					<?= $link['title'] ?>
				</button>
			</li>
		<?php endforeach ?>

		<?php if ($pager->hasNext()) : ?>
            <li class="page-item"><a class="page-link">...</a></li>
            <li class="page-item" value="<?=$pager->getPageCount()?>">
                <button class="page-link"  aria-label="Последняя">
                <?= $pager->getPageCount() ?></button>
            </li>
		<?php endif ?>
	</ul>
</nav>
