<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php foreach ($valueCurrency as $currency => $value) :?>

    <?php if ($currency == 'USD') : ?>

        <?php if ($value[1] > $value[0]): ?>
           <?php echo "Обменный курс USD по ЦБ РФ на сегодня: $value[1]" ." &and;"."<br>"; ?>

        <?php elseif ($value[1] < $value[0]): ?>
           <?php echo "Обменный курс USD по ЦБ РФ на сегодня: $value[1]" ." &or;"."<br>"; ?>

        <?php else: ?>
           <?php echo "Курс не изменился по сравнению с прошлым днём"."<br>"?>
           <?php echo "Обменный курс USD по ЦБ РФ на сегодня: $value[1]"."<br>"; ?>

        <?php endif; ?>
    <?php elseif ($currency == 'EU') : ?>

        <?php if ($value[1] > $value[0]): ?>
            <?php echo "Обменный курс EU по ЦБ РФ на сегодня: $value[1]" ." &and;"."<br>"; ?>

        <?php elseif ($value[1] < $value[0]): ?>
            <?php echo "Обменный курс EU по ЦБ РФ на сегодня: $value[1]" ." &or;"."<br>"; ?>

        <?php else: ?>
            <?php echo "Курс не изменился по сравнению с прошлым днём"."<br>"?>
            <?php echo "Обменный курс EU по ЦБ РФ на сегодня: $value[1]"."<br>"; ?>

        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
</body>
</html>


