<?php $render('header', ['user' => $user]) ?>

<section class="container main">
    <?php $render('aside', ['user' => $user, 'activeMenu' => 'friends']) ?>
    <section class="feed">
        <?php $render('profile_header', ['user' => $user, 'loggedUserId' => $loggedUserId,  'isFollowing' => $isFollowing]) ?>
        <div class="row">
            <div class="column">
                <div class="box">
                    <div class="box-body">

                        <div class="tabs">
                            <div class="tab-item" data-for="followers">
                                Seguidores
                            </div>
                            <div class="tab-item active" data-for="following">
                                Seguindo
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-body" data-item="followers">
                                <div class="full-friend-list">
                                    <?php foreach ($user->getFollowers() as $follower) : ?>
                                        <div class="friend-icon">
                                            <a href="<?= $base ?>/profile/<?= $follower->getId() ?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= $base ?>/media/avatars/<?= $follower->getAvatar() ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                    <?= $follower->getName() ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach ?>
                                    <?php if (count($user->getFollowers()) === 0) : ?>
                                        <div style="width: 500px; padding: 15px;">
                                            <?php if ($user->getId() != $loggedUserId) : ?>
                                                O usuário
                                                <strong><?= $user->getName() ?></strong>
                                                não tem nenhum seguidor até o momento...
                                            <?php else : ?>
                                                Você não tem nenhum seguidor até o momento...
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="tab-body" data-item="following">
                                <div class="full-friend-list">
                                    <?php foreach ($user->getFollowing() as $following) : ?>
                                        <div class="friend-icon">
                                            <a href="<?= $base ?>/profile/<?= $following->getId() ?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= $base ?>/media/avatars/<?= $following->getAvatar() ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                    <?= $following->getName() ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach ?>
                                    <?php if (count($user->getFollowing()) === 0) : ?>
                                        <div style="width: 500px; padding: 15px;">
                                            <?php if ($user->getId() != $loggedUserId) : ?>
                                                O usuário
                                                <strong><?= $user->getName() ?></strong>
                                                não segue ninguém até o momento...
                                            <?php else : ?>
                                                Você não segue ninguém até o momento...
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $render('footer') ?>