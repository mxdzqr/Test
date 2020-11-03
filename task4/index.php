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

    public static function getList()
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM task4';
        $result= $db->prepare($sql);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addItem($title, $description, $text)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO task4 (title, description, text) VALUES (:title, :description, :text)';

        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkTable($table)
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT 1 FROM $table");

        if($result){
            return 1;
        } else {
            return 0;
        }

        return $result;
    }

    public static function addTable($table)
    {
        $db = Db::getConnection();
        $sql = "CREATE TABLE `test` . $table (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL , 
        `description` VARCHAR(255) NOT NULL , 
        `text` VARCHAR(255) NOT NULL ,
         PRIMARY KEY (`id`)
         ) ENGINE = InnoDB";

        $result = $db->prepare($sql);

        return $result->execute();
    }
}
if($_POST['check']){

    if(Db::checkTable('task4')){
        Db::addItem($_POST['title'], $_POST['description'], $_POST['text']);
    } else {
        Db::addTable('taskTest');
    }
}
?>
<form method="post">
    <span>Добавление элемента в бд</span>
    <input type="text" name="title" placeholder="Пример: test" required>
    <input type="text" name="description" placeholder="Пример: 25" required>
    <input type="text" name="text" placeholder="Пример: пам-парам" required>
    <input type="submit" name="submit">
    <input type="hidden" name="check" value="check">
</form>