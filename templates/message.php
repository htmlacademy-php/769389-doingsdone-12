<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<h1>Задачи на сегодня</h1>

<p>Уважаемый(ая), <?=$user_name;?></p>
<p>У вас запланирована(ы) задача(и): </p>
<ul>
    <?php foreach ($todayListUser as $value) : ?>
        <li><?=$value['title']; ?> на <?=$value['deadline']; ?></li>
    <?php endforeach; ?>

</ul>

</body>
</html>
