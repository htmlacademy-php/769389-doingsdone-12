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

                <a class="button button--transparent button--plus content__side-button"
                   href="project.php" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?= ($show_complete_tasks) ? 'checked':'';?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <?php foreach ($task_arr as $item):
                        if (!$show_complete_tasks && $item['status']) {
                        continue;
                    }?>
                    <tr class="tasks__item task <?= ($item['status']) ? 'task--completed':'';?>
                                                <?= ((task_important($item['deadline'])) && !$item['status']) ? 'task--important':'';?>">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?= ($item['status']) ? 'checked':'';?>>
                                <span class="checkbox__text"><?=htmlspecialchars($item['title']);?></span>
                            </label>
                        </td>
                        <td class="task__file">
                            <?php if ($item['link']): ?>
                                <a class="download-link" href="<?='/uploads/'.$item['link']; ?>"><?=$item['link']; ?></a>
                            <?php endif; ?>
                        </td>
                        <td class="task__date"><?=$item['deadline'];?></td>

                    </tr>
                    <?php endforeach; ?>
                </table>
            </main>
