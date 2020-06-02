<div class="content">
    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
            <?php foreach ($project_arr as $value): ?>
                <ul class="main-navigation__list">
                    <li class="main-navigation__list-item">
                        <a class="main-navigation__list-item-link
                            <?= (intval($_GET['id']) == $value['id']) ? 'main-navigation__list-item--active':'';?>" href="index.php?id=<?=$value['id']; ?>">
                            <?=htmlspecialchars($value['title']);?>
                        </a>
                        <span class="main-navigation__list-item-count"><?=calc($task_array, $value);?></span>
                    </li>
                </ul>
            <?php endforeach; ?>
        </nav>

        <a class="button button--transparent button--plus content__side-button" href="form-project.html">Добавить проект</a>
    </section>

    <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="add.php" method="post" autocomplete="off" enctype="multipart/form-data">

            <div class="form__row">
                <?php $classname = isset($errors['title']) ? "form__input--error" : ""; ?>
                    <label class="form__label" for="name">Название <sup>*</sup></label>
                    <input class="form__input <?=$classname;?>" type="text" name="title" id="name" value="<?=getPostVal('title'); ?>" placeholder="Введите название">
                    <span class="error_text"><?=$errors['title'] ?? ""; ?></span>
            </div>

            <div class="form__row">
                <label class="form__label" for="project">Проект <sup>*</sup></label>
                    <select class="form__input form__input--select" name="project_id" id="project">
                    <?php foreach ($project_arr as $value): ?>
                        <option value="<?=$value['id']; ?>"
                            <?php if ($value['id'] === getPostVal('project')):?> selected <?php endif; ?>>
                            <?=htmlspecialchars($value['title']);?>
                        </option>
                    <?php endforeach;?>
                    </select>
            </div>

            <div class="form__row">
                <?php $classname = isset($errors['deadline']) ? "form__input--error" : ""; ?>
                <label class="form__label" for="date">Дата выполнения</label>
                <input class="form__input form__input--date <?=$classname;?>" type="text" name="deadline" id="date" value="<?=getPostVal('deadline'); ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
                <span class="error_text"><?=$errors['deadline'] ?? ""; ?></span>
            </div>

            <div class="form__row">
                <label class="form__label" for="file">Файл</label>
                <div class="form__input-file">
                    <input class="visually-hidden" type="file" name="link" id="file" value="<?=getPostVal('link'); ?>">
                        <label class="button button--transparent" for="file">
                            <span>Выберите файл</span>
                        </label>
                </div>
            </div>

            <div class="form__row form__row--controls">
                <input class="button" type="submit" name="task-btn" value="Добавить">
            </div>
        </form>
    </main>
</div>


