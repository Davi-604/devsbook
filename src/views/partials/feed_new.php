<div class="box feed-new">
    <div class="box-body">
        <div class="feed-new-editor m-10 row">
            <div class="feed-new-avatar">
                <a href="<?= $base ?>/profile">
                    <img src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" />
                </a>
            </div>
            <div class="feed-new-input-placeholder">O que você está pensando, <?= $user->getName() ?>?</div>
            <div class="feed-new-input" contenteditable="true"></div>
            <div class="feed-new-photo">
                <img src="<?= $base ?>/assets/images/photo.png" />
                <input type="file" name="photo" class="feed-new-file" accept="image/png, image/jpg, image/jpeg" />
            </div>
            <div class="feed-new-send">
                <img src="<?= $base ?>/assets/images/send.png" />
            </div>

            <form class="feed-new-form" method="post" action="<?= $base ?>/post">
                <input type='hidden' name="body" />
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    let feedInput = document.querySelector('.feed-new-input');
    let feedSubmit = document.querySelector('.feed-new-send');
    let feedForm = document.querySelector('.feed-new-form');
    let feedPhoto = document.querySelector('.feed-new-photo');
    let feedFile = document.querySelector('.feed-new-file');

    feedPhoto.addEventListener('click', () => {
        feedFile.click();
    })
    feedFile.addEventListener('change', async () => {
        let photo = feedFile.files[0];

        let formData = new FormData();
        formData.append('photo', photo);

        let req = await fetch(`${BASE}/ajax/upload`, {
            method: 'post',
            body: formData,
        })
        let json = await req.json();

        if (json.error.trim() != '') {
            alert(json.error);
        } else {
            window.location.reload();
        }
    })


    feedSubmit.addEventListener('click', (obj) => {
        let postValue = feedInput.innerHTML

        if (postValue.trim() != '') {
            feedForm.querySelector('input[name=body]').value = postValue;
            feedForm.submit();
        }
    })
</script>