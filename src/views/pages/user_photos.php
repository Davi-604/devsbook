<?php $render('header', ['user' => $user]) ?>

<section class="container main">
    <?php $render('aside', ['user' => $user, 'activeMenu' => 'photos']) ?>
    <section class="feed">
        <?php $render('profile_header', ['user' => $user, 'loggedUserId' => $loggedUserId,  'isFollowing' => $isFollowing]) ?>
        <div class="row">

            <div class="column">

                <div class="box">
                    <div class="box-body">
                        <div class="full-user-photos">
                            <?php if (count($user->getPhotos()) === 0) : ?>
                                <div style="grid-column: 1 / -1; padding: 15px;">
                                    <div>
                                        O usuário
                                        <strong><?= $user->getName() ?></strong>
                                        não publicou nenhuma foto até o momento...
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php foreach ($user->getPhotos() as $photo) : ?>
                                <div class="user-photo-item">
                                    <a href="#modal-<?= $photo->getId() ?>" rel="modal:open">
                                        <img src="<?= $base ?>/media/uploads/<?= $photo->getBody() ?>" />
                                    </a>
                                    <div id="modal-1<?= $photo->getId() ?>" style="display:none">
                                        <img src="<?= $base ?>/media/uploads/<?= $photo->getBody() ?>" />
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <form method="post" class="user-new-photo-form" action="<?= $base ?>/photos" enctype="multipart/form-data">
                    <label>
                        <h2>Publique uma nova foto:</h2>
                        <input type="file" name="photo" />
                    </label>
                    <div class="config-input-button">
                        <input class="button" type="submit" value="Enviar" />
                    </div>
                    <?php if (!empty($flash)) : ?>
                        <div class="config-flash">
                            <?= $flash ?>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </section>
    <?php $render('footer') ?>