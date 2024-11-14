<div class="feed-pagination">
    <?php for ($count = 0; $count < $pageCount; $count++) : ?>

        <a
            href="<?= $base ?>/<?= $dest ?>page=<?= $count ?>"
            class="<?= ($count === $currentPage) ? 'active' : '' ?>">
            <?= $count + 1 ?>
        </a>
    <?php endfor ?>
</div>