<div class="content">
    <section class="content__side">
        <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>
        <a class="button button--transparent content__side-button" href="auth.php">Войти</a>
    </section>
    <main class="content__main">
        <h2 class="content__main-heading">Вход на сайт</h2>
        <form class="form" action="auth.php" method="post" autocomplete="off">

            <div class="form__row">
                <?php $classname = isset($errors['email']) ? "form__input--error" : ""; ?>
                <label class="form__label" for="email">E-mail <sup>*</sup></label>
                <input class="form__input <?=$classname;?>" type="text" name="email" id="email" value="<?=$values['email'] ?? ''; ?>" placeholder="Введите e-mail">
                <?php $emailInput = isset($errors['email']) ? "Введите E-mail" : ""; ?>
                <p class="form__message"><?=$emailInput;?></p>
                <?php $emailError = isset($errors['emailError']) ? "E-mail введён некорректно" : ""; ?>
                <p class="form__message"><?=$emailError;?></p>
                <?php $emailEmpty = (isset($errors['emailEmpty'])) && (!isset($errors['emailError'])) && (!isset($errors['email'])) ? "Такой пользователь не найден" : ""; ?>
                <p class="form__message"><?=$emailEmpty;?></p>
            </div>

            <div class="form__row">
                <?php $classname = isset($errors['email']) ? "form__input--error" : ""; ?>
                <label class="form__label" for="password">Пароль <sup>*</sup></label>
                <input class="form__input <?=$classname;?>" type="password" name="password" id="password" value="<?=$values['password'] ?? ''; ?>" placeholder="Введите пароль">
                <?php $passwordInput = isset($errors['password']) ? "Введитsе пароль" : ""; ?>
                <p class="form__message"><?=$passwordInput;?></p>
                <?php $passwordError = isset($errors['passwordError']) ? "Неверный пароль" : ""; ?>
                <p class="form__message"><?=$passwordError;?></p>
            </div>

            <div class="form__row form__row--controls">
                <input class="button" type="submit" name="" value="Войти">
            </div>

        </form>
    </main>
</div>
