<?php $render('header', ['user' => $user]) ?>

<section class="container main">
    <?php $render('aside', ['user' => $user, 'activeMenu' => 'profile']) ?>
    <section class="feed">
        <?php $render('profile_header', ['user' => $user, 'loggedUserId' => $loggedUser->getId(), 'isFollowing' => $isFollowing]) ?>
        <div class="row">

            <div class="column side pr-5">

                <div class="box">
                    <div class="box-body">

                        <div class="user-info-mini">
                            <img src="<?= $base ?>/assets/images/calendar.png" />
                            <?= date('d/m/Y', strtotime($user->getBirthdate())) ?> - <?= $age ?> anos.
                        </div>

                        <div class="user-info-mini">
                            <img src="<?= $base ?>/assets/images/pin.png" />
                            <?= (!empty($user->getCity()) ? $user->getCity() : '- -') ?>
                        </div>
                        <div class="user-info-mini">
                            <img src="<?= $base ?>/assets/images/work.png" />
                            <?= (!empty($user->getWork()) ? $user->getWork() : '- -') ?>
                        </div>

                    </div>
                </div>

                <div class="box">
                    <div class="box-header m-10">
                        <div class="box-header-text">
                            Seguindo
                            <span>(<?= count($user->getFollowing()) ?>)</span>
                        </div>
                        <div class="box-header-buttons">
                            <a
                                href="<?= $base ?>/<?= ($user->getId() != $loggedUser->getId() ? 'profile/' . $user->getId() . '/friends' : 'friends') ?>">
                                ver todos
                            </a>
                        </div>
                    </div>
                    <div class="box-body friend-list">
                        <?php foreach ($user->getFollowing() as $count => $followingUser) : ?>
                            <?php if ($count < 10) : ?>
                                <div class="friend-icon">
                                    <a href="<?= $base ?>/profile/<?= $followingUser->getId() ?>">
                                        <div class="friend-icon-avatar">
                                            <img src="<?= $base ?>/media/avatars/<?= $followingUser->getAvatar() ?>" />
                                        </div>
                                        <div class="friend-icon-name">
                                            <?= $followingUser->getName() ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>

            </div>
            <div class="column pl-5">

                <div class="box">
                    <div class="box-header m-10">
                        <div class="box-header-text">
                            Fotos
                            <span>(<?= count($user->getPhotos()) ?>)</span>
                        </div>
                        <div class="box-header-buttons">
                            <a
                                href="<?= $base ?>/<?= ($user->getId() != $loggedUser->getId() ? 'profile/' . $user->getId() . '/photos' : 'photos') ?>">
                                ver todas
                            </a>
                        </div>
                    </div>
                    <div class="box-body row m-20">
                        <?php for ($count = 0; $count < 4; $count++) : ?>
                            <?php if (isset($user->getPhotos()[$count])) : ?>
                                <div class="user-photo-item">
                                    <a href="#modal-2" rel="modal:open">
                                        <img src="<?= $base ?>/media/uploads/<?= $user->getPhotos()[$count]->getBody() ?>" />
                                    </a>
                                    <div id="modal-2" style="display:none">
                                        <img src="<?= $base ?>/media/uploads/<?= $user->getPhotos()[$count]->getBody() ?>" />
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php endfor ?>
                    </div>
                </div>

                <div class="column pl-5">
                    <?php if ($user->getId() === $loggedUser->getId()) : ?>
                        <?php $render('feed_new', ['user' => $user]) ?>
                    <?php endif ?>

                    <?php foreach ($feed['posts'] as $post) : ?>
                        <?php $render('feed_item', ['post' => $post, 'user' => $loggedUser]) ?>
                    <?php endforeach ?>
                    <?php
                    $render(
                        'feed_pagination',
                        [
                            'pageCount' => $feed['pageCount'],
                            'currentPage' => $currentPage,
                            'dest' => 'profile?'
                        ]
                    )
                    ?>
                </div>
            </div>
        </div>
    </section>
</section>
<?php $render('footer') ?>