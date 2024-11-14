<?php $render('header', ['user' => $user]) ?>

<section class="container main">
    <?php $render('aside', ['user' => $user, 'activeMenu' => 'home']) ?>
    <section class="feed mt-10">
        <div class="row">
            <div class="column pr-5">
                <?php $render('feed_new', ['user' => $user]) ?>

                <?php foreach ($feed['posts'] as $post): ?>
                    <?php $render('feed_item', ['post' => $post, 'user' => $user]) ?>
                <?php endforeach ?>
                <div class="feed-pagination">
                    <?php
                    $render(
                        'feed_pagination',
                        [
                            'pageCount' => $feed['pageCount'],
                            'currentPage' => $currentPage,
                            'dest' => '&'
                        ]
                    )
                    ?>
                </div>
            </div>
            <?php $render('sponsors_area') ?>
        </div>

    </section>
</section>
<?php $render('footer') ?>