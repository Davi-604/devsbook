<div class="row">
    <div class="box flex-1 border-top-flat">
        <div class="box-body">
            <div class="profile-cover" style="background-image: url('<?= $base ?>/media/covers/<?= $user->getCover() ?>');"></div>
            <div class="profile-info m-20 row">
                <div class="profile-info-avatar">
                    <a href="<?= $base ?>/profile/<?= $user->getId() ?>">
                        <img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" />
                    </a>
                </div>
                <div class="profile-info-name">
                    <a href="<?= $base ?>/profile/<?= $user->getId() ?>">
                        <div class="profile-info-name-text"><?= $user->getName() ?></div>
                    </a>
                    <div class="profile-info-location"><?= (!empty($user->getCity()) ? $user->getCity() : '- -') ?></div>
                </div>
                <div class="profile-info-data row">
                    <?php if ($loggedUserId != $user->getId()) : ?>
                        <div class="profile-info-item m-width-20">
                            <a href="<?= $base ?>/profile/<?= $user->getId() ?>/follow" class="button">
                                <?= ($isFollowing === false) ? 'Seguir' : 'Deixar de seguir' ?>
                            </a>
                        </div>
                    <?php endif ?>
                    <div class="profile-info-item m-width-20">
                        <a
                            href="<?= $base ?>/<?= ($user->getId() != $loggedUserId ? 'profile/' . $user->getId() . '/friends' : 'friends') ?>">
                            <div class="profile-info-item-n"><?= count($user->getFollowers()) ?></div>
                            <div class="profile-info-item-s">Seguidores</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a
                            href="<?= $base ?>/<?= ($user->getId() != $loggedUserId ? 'profile/' . $user->getId() . '/friends' : 'friends') ?>">
                            <div class="profile-info-item-n"><?= count($user->getFollowing()) ?></div>
                            <div class="profile-info-item-s">Seguindo</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a
                            href="<?= $base ?>/<?= ($user->getId() != $loggedUserId ? 'profile/' . $user->getId() . '/photos' : 'photos') ?>">
                            <div class="profile-info-item-n"><?= count($user->getPhotos()) ?></div>
                            <div class="profile-info-item-s">Fotos</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>