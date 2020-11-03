<style>
    table.minimalistBlack {
        border: 1px solid #000000;
        text-align: center;
        border-collapse: collapse;
    }
    table.minimalistBlack td, table.minimalistBlack th {
        border: 1px solid #000000;
        padding: 5px 4px;
    }
    table.minimalistBlack tbody td {
        font-size: 13px;
    }
    table.minimalistBlack thead {
        background: #DDDDDD;
        border-bottom: 1px solid #000000;
    }
    table.minimalistBlack thead th {
        color: #000000;
        text-align: center;
    }
</style>

<!-- Вывод доступных таблиц из БД -->
<!-- Для теста ввести (host, user, password, dbname) -->
<form class="database" method="post">
    <h4>Введите данные для подключения к БД</h4>
    <input type="text" name="host" placeholder="Пример: 127.0.0.1" required>
    <input type="text" name="login" placeholder="Пример: root" required>
    <input type="text" name="password" placeholder="Пример: root" required>
    <input type="text" name="dbname" placeholder="Пример: test_db" required>
    <input type="submit" name="submit">
    <input type="hidden" name="tableList" value="tableList">
</form>
<? if(isset($_POST['tableList']) && $_POST['tableList'] != '' && $_POST['tableList'] == 'tableList'):
    $db = mysqli_connect($_POST['host'], $_POST['login'], $_POST['password'], $_POST['dbname']);
    $tableListSQL = "SHOW TABLES FROM ". $_POST['dbname'];
    $tableResult = mysqli_query($db, $tableListSQL) or dir('Ошибка: ' . mysqli_error($db));
    $tableList = mysqli_fetch_all($tableResult); ?>
    <table class="minimalistBlack">
        <thead>
        <tr>
            <th>Таблицы в БД</th>
        </tr>
        </thead>
        <tbody>
        <? foreach($tableList as $arItems): ?>
            <tr><td><?= $arItems[0] ?></td></tr>
        <? endforeach;?>
        </tbody>
        </tr>
    </table>
<?  endif; ?>

<!-- Доп.задание -->
<!-- Для теста ввести (host, user, password, dbname, nameTable) -->
<form class="database" method="post">
    <h4>Введите данные для подключения к БД и вывода элементов из конкретной таблицы</h4>
    <input type="text" name="host" placeholder="Пример: 127.0.0.1" required>
    <input type="text" name="login" placeholder="Пример: root" required>
    <input type="text" name="password" placeholder="Пример: root" required>
    <input type="text" name="dbname" placeholder="Пример: test_db" required>
    <input type="text" name="table" placeholder="Пример: item" required>
    <input type="submit" name="submit">
    <input type="hidden" name="tableItem" value="tableItem">
</form>

<? if(isset($_POST['tableItem']) && $_POST['tableItem'] != '' && $_POST['tableItem'] == 'tableItem'):
    $db = mysqli_connect($_POST['host'], $_POST['login'], $_POST['password'], $_POST['dbname']);
    $tableItemSQL = "SELECT * FROM ". $_POST['table'];
    $tableItemResult = mysqli_query($db, $tableItemSQL) or dir('Ошибка: ' . mysqli_error($db));
    $tableItemList = mysqli_fetch_all($tableItemResult); ?>
    <table class="minimalistBlack">
        <thead>
        <tr>
            <th>Элементы из таблицы <?= $_POST['table'] ?></th>
        </tr>
        </thead>
        <tbody>
        <? foreach($tableItemList as $arItems): ?>
            <tr>
                <td><?= $arItems[1] ?></td>
            </tr>
        <? endforeach;?>
        </tbody>
        </tr>
    </table>
<?  endif; ?>
