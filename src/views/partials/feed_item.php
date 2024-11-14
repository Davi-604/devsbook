<div class="box feed-item" data-id="<?= $post->getId() ?>">
    <div class="box-body">
        <div class="feed-item-head row mt-20 m-width-20">
            <div class="feed-item-head-photo">
                <a
                    href="<?= $base ?>/<?= ($post->getMine() ? 'profile' : 'profile/' . $post->getUserPost()->getId()) ?>">
                    <img src="<?= $base ?>/media/avatars/<?= $post->getUserPost()->getAvatar() ?>" />
                </a>
            </div>
            <div class="feed-item-head-info">
                <a href="<?= $base ?>/<?= ($post->getMine() ? 'profile' : 'profile/' . $post->getUserPost()->getId()) ?>">
                    <span class="fidi-name">
                        <?= $post->getUserPost()->getName() ?>
                    </span>
                </a>
                <span class="fidi-action">
                    <?php
                    switch ($post->getType()) {
                        case 'text':
                            echo 'Fez um post';
                            break;
                        case 'photo':
                            echo 'Postou uma foto';
                            break;
                    }
                    ?>
                </span>
                <br />
                <span class="fidi-date"><?= date('d/m/Y', strtotime($post->getCreatedAt())) ?></span>
            </div>
            <?php if ($post->getMine()) : ?>
                <div class="feed-item-head-btn">
                    <img src="<?= $base ?>/assets/images/more.png" />
                    <a class="feed-item-more-window" href="<?= $base ?>/post/<?= $post->getId() ?>/delete">
                        Excluir Post
                    </a>
                </div>
            <?php endif ?>
        </div>
        <div class="feed-item-body mt-10 m-width-20">
            <?php if ($post->getType() == 'text') : ?>
                <?= nl2br($post->getBody()) ?>
            <?php endif ?>
            <?php if ($post->getType() == 'photo') : ?>
                <img src="<?= $base ?>/media/uploads/<?= nl2br($post->getBody()) ?>" />
            <?php endif ?>
        </div>
        <div class="feed-item-buttons row mt-20 m-width-20">
            <div class="like-btn <?= ($post->getLiked() ? 'on' : '') ?>">
                <?= $post->getLikesCount() ?>
            </div>
            <div class="msg-btn"><?= $post->getCommentsCount() ?></div>
        </div>
        <div class="feed-item-comments">

            <div class="feed-item-comments">
                <div class="feed-item-comments-area">

                    <?php foreach ($post->getComments() as $key => $comment): ?>
                        <div class="fic-item row m-height-10 m-width-20">
                            <div class="fic-item-photo">
                                <a href="
                            <?= $base ?>/<?= ($post->getMine() ? 'profile' : 'profile/' . $post->getCommentUsers()[$key]->getId()) ?>">
                                    <img
                                        src="<?= $base ?>/media/avatars/<?= $post->getCommentUsers()[$key]->getAvatar() ?>" />
                                </a>
                            </div>
                            <div class="fic-item-info">
                                <a href="">
                                    <?= $post->getCommentUsers()[$key]->getName() ?>
                                </a>
                                <?= $comment->getBody() ?>
                            </div></br>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="fic-answer row m-height-10 m-width-20">
                <div class="fic-item-photo">
                    <a href="<?= $base ?>/profile"><img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" /></a>
                </div>
                <input type="text" class="fic-item-field" placeholder="Escreva um comentário" />
            </div>

        </div>
    </div>
</div>