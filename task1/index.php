<?
class Db
{
    static function getConnection()
    {
        $paramsPath = 'db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        $db->exec("set names utf8");

        return $db;
    }
}

class Table
{
    public static function getList($tableName)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM ' . $tableName;
        $result= $db->prepare($sql);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

$arResult = Table::getList('item');
echo "<pre>";
print_r($arResult);
echo "</pre>";
?>
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
<table class="minimalistBlack">
    <thead>
    <tr>
        <th>Элементы из таблицы</th>
    </tr>
    </thead>
    <tbody>
    <? foreach($arResult as $arItems): ?>
        <tr><td><?= $arItems['name'] ?></td></tr>
    <? endforeach;?>
    </tbody>
    </tr>
</table>