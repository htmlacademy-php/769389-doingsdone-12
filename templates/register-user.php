            <div class="content">
                <section class="content__side">
                    <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>
                    <a class="button button--transparent content__side-button" href="auth.php">Войти</a>
                </section>
                <main class="content__main">
                    <h2 class="content__main-heading">Регистрация аккаунта</h2>
                    <form class="form" action="reg.php" method="post" autocomplete="off">
                        <div class="form__row">
                            <?php $classname = isset($errors['email']) ? 'form__input--error' : ''; ?>
                            <label class="form__label" for="email">E-mail <sup>*</sup></label>
                            <input class="form__input <?=$classname;?>" type="text" name="email" id="email" value="<?=$values['email'] ?? ''; ?>" placeholder="Введите e-mail">
                            <?php $emailInput = isset($errors['email']) ? 'Введите E-mail' : ''; ?>
                            <p class="form__message"><?=$emailInput;?></p>
                            <?php $errorMessage = isset($errors['emailError']) ? 'E-mail введён некорректно' : ''; ?>
                            <p class="form__message"><?=$errorMessage;?></p>
                            <?php $doubleEmail= isset($errors['doubleEmail']) ? 'Пользователь с этим email уже зарегистрирован' : ''; ?>
                            <p class="form__message"><?=$doubleEmail;?></p>
                        </div>

                        <div class="form__row">
                            <?php $classname = isset($errors['password']) ? 'form__input--error' : ''; ?>
                            <label class="form__label" for="password">Пароль <sup>*</sup></label>
                            <input class="form__input <?=$classname;?>" type="password" name="password" id="password" value="<?=$values['password'] ?? ''; ?>" placeholder="Введите пароль">
                            <?php $passwordInput = isset($errors['password']) ? 'Введитsе пароль' : ''; ?>
                            <p class="form__message"><?=$passwordInput;?></p>
                        </div>

                        <div class="form__row">
                            <?php $classname = isset($errors['name']) ? 'form__input--error' : ''; ?>
                            <label class="form__label" for="name">Имя <sup>*</sup></label>
                            <input class="form__input <?=$classname;?>" type="text" name="name" id="name" value="<?=$values['name'] ?? ''; ?>" placeholder="Введите имя">
                            <?php $passwordInput = isset($errors['name']) ? 'Введитsе ваше имя' : ''; ?>
                            <p class="form__message"><?=$passwordInput;?></p>
                        </div>
                        <div class="form__row form__row--controls">
                            <p class="error-message"><?= (!empty($errors)) ? 'Пожалуйста, исправьте ошибки в форме':'';?></p>
                            <input class="button" type="submit" name="" value="Зарегистрироваться">
                        </div>
                    </form>
                </main>
            </div>

