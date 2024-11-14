<?php $render('header', ['user' => $user]) ?>

<section class="container main">
    <?php $render('aside', ['activeMenu' => 'config']) ?>
    <div class="config-container">
        <h1 class="config-title">Configurações</h1>
        <form method="post" enctype="multipart/form-data">
            <?php if (!empty($flash)) : ?>
                <div class="config-flash">
                    <?= $flash ?>
                </div>
            <?php endif ?>

            <div class="config-input file-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Novo avatar:',
                        'placeholder' => '',
                        'type' => 'file',
                        'name' => 'avatar'
                    ]
                ) ?>
                <img style="border-radius: 50%;" src="<?= $base ?>/media/avatars/<?= $user->getAvatar() ?>" alt="<?= $user->getName() ?>" />
            </div>
            <div class="config-input file-input ">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Nova capa:',
                        'placeholder' => '',
                        'type' => 'file',
                        'name' => 'cover'
                    ]
                ) ?>
                <img style="width: 100px;" src="<?= $base ?>/media/covers/<?= $user->getCover() ?>" alt="<?= $user->getName() ?>" />
            </div>
            <hr />
            <div class="config-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Nome completo:',
                        'placeholder' => 'Digite o seu nome',
                        'type' => 'text',
                        'name' => 'name',
                        'value' => $user->getName()
                    ]
                ) ?>
            </div>
            <div class="config-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Email:',
                        'placeholder' => 'Digite o seu email',
                        'type' => 'email',
                        'name' => 'email',
                        'value' => $user->getEmail()
                    ]
                ) ?>
            </div>
            <div class="config-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Data de nascimento:',
                        'placeholder' => '',
                        'type' => 'date',
                        'name' => 'birthdate',
                        'value' => $user->getBirthdate()
                    ]
                ) ?>
            </div>
            <div class="config-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Cidade:',
                        'placeholder' => 'Digite a cidade em que você mora',
                        'type' => 'text',
                        'name' => 'city',
                        'value' => $user->getCity()
                    ]
                ) ?>
            </div>
            <div class="config-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Trabalho:',
                        'placeholder' => 'Digite onde você trabalha',
                        'type' => 'text',
                        'name' => 'work',
                        'value' => $user->getWork()
                    ]
                ) ?>
            </div>
            <hr />
            <div class="config-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Nova senha:',
                        'placeholder' => 'Digite a sua nova senha',
                        'type' => 'text',
                        'name' => 'password',
                        'value' => ''

                    ]
                ) ?>
            </div>
            <div class="config-input">
                <?php $render(
                    'config_input',
                    [
                        'label' => 'Confirme a sua nova senha:',
                        'placeholder' => 'Digite e confirme a nova senha',
                        'type' => 'text',
                        'name' => 'password_confirm',
                        'value' => ''
                    ]
                ) ?>
            </div>
            <div class="config-input-button">
                <input class="button" type="submit" value="Salvar alterações" />
            </div>
        </form>
    </div>
</section>