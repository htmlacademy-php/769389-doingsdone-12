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
        <a class="button button--transparent button--plus content__side-button" href="project.php">Добавить проект</a>
    </section>

    <main class="content__main">
        <h2 class="content__main-heading">Добавление проекта</h2>

        <form class="form"  action="project.php" method="post" autocomplete="off">
            <div class="form__row">
                <label class="form__label" for="project_name">Название <sup>*</sup></label>
                <input class="form__input" type="text" name="name" id="project_name" value="" placeholder="Введите название проекта">
                    <?php $projectInput = isset($errors['name']) ? 'Введите название проекта' : ''; ?>
                    <p class="form__message"><?=$projectInput;?></p>
                    <?php $doubleProject = (!isset($errors['name'])) && (isset($errors['doubleProject'])) ? 'Такой проект уже есть' : ''; ?>
                    <p class="form__message"><?=$doubleProject;?></p>
            </div>

            <div class="form__row form__row--controls">
                <input class="button" type="submit" name="" value="Добавить">
            </div>
        </form>
    </main>
</div>
