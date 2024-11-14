<?php $render('header', ['user' => $user]) ?>

<section class="container main">
    <?php $render('aside', ['user' => $user, 'activeMenu' => 'home']) ?>
    <section class="feed mt-10">
        <div class="row">
            <div class="column pr-5">
                <div class="search-value">
                    <strong>
                        Você pesquisou por: <?= $searchValue ?>
                    </strong>
                </div>
                <hr />
                <div class="search-section">
                    <div>
                        Usuários:
                    </div>
                    <?php if (count($userResults) <= 0) : ?>
                        <p>
                            Não encontramos nenhum usuário...
                        </p>
                    <?php endif ?>
                    <div class="search-friend-icon">
                        <?php foreach ($userResults as $userRes): ?>
                            <div class="friend-icon">
                                <a href="<?= $base ?>/profile/<?= $userRes->getId() ?>">
                                    <div class="friend-icon-avatar">
                                        <img src="<?= $base ?>/media/avatars/<?= $userRes->getAvatar() ?>" />
                                    </div>
                                    <div class="friend-icon-name">
                                        <?= $userRes->getName() ?>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <hr />
                <div class="search-section">
                    Postagens:
                    <?php if (count($postResults) <= 0) : ?>
                        <p>
                            Não encontramos nenhuma postagem...
                        </p>
                    <?php endif ?>
                    <?php foreach ($postResults as $postRes) : ?>
                        <div>
                            <?= $render('feed_item', ['post' => $postRes, 'user' => $user]) ?>
                        </div>
                    <?php endforeach ?>

                </div>
                <?php $render(
                    'feed_pagination',
                    [
                        'pageCount' => $pageCount,
                        'currentPage' => $currentPage,
                        'dest' => "search?s=$searchValue&"
                    ]
                )
                ?>

            </div>
            <?php $render('sponsors_area') ?>
        </div>

    </section>
</section>
<?php $render('footer') ?>