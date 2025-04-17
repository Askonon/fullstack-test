<?php
/**
 * @var Pager $pager
 */
?>
<?php if(empty($ajax)):?>
<div id="comments-list" class="container p-3 bg-primary-subtle border border-primary-subtle rounded-3">
<?php endif?>
    <div class="row">
        <div class="sort">
            <button id="idSort" class="buttom-sort <?php if ($sort['orderBy'] === 'id') echo 'active'?>">
                <div>Id</div>
                <?php if ($sort['orderBy'] === 'id'):?>
                    <i class="bi bi-caret-<?= $sort['direction'] === 'asc' ? 'up' : 'down'?>"></i>
                <?php endif?>
            </button>
            <button id="dateSort" class="buttom-sort <?php if ($sort['orderBy'] === 'date') echo 'active'?>">
                <div>Дата добавления</div>
                <?php if ($sort['orderBy'] === 'date'):?>
                    <i class="bi bi-caret-<?= $sort['direction'] === 'asc' ? 'up' : 'down'?>"></i>
                <?php endif?>
            </button>
        </div>
        <div class="comments">
            <?php foreach($comments as $comment):?>
                <div class="comment" id="<?=$comment['id']?>">
                    <div id='name<?=$comment['id']?>'><?=$comment['name']?></div>
                    <div id='text<?=$comment['id']?>'><?=$comment['text']?></div>
                    <div id='date<?=$comment['id']?>'><?=$comment['date']?></div>
                    <button type="button" id="<?=$comment['id']?>" class="btn btn-update"><i class="bi bi-pencil"></i></button>
                    <button type="button" id="<?=$comment['id']?>" class="btn btn-close" aria-label="Закрыть"></button>
                </div>
            <?php endforeach?>
        </div>
    </div>
    <?= $pager->links('default', 'custom_nav') ?>
<?php if(isset($ajax)) exit();?>
</div>
<script>
    let orderBy = "<?=$sort['orderBy']?>";
    let direction = "<?=$sort['direction']?>";
</script>