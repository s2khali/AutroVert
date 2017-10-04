<?php
class DB
{
    public static $host = "localhost";
    public static $dbname = "autrovert";
    public static $user = 'root';
    public static $password = '';

    public static function connect()
    {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";charset=utf8", self::$user, self::$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array())
    {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);

        if(explode(' ', $query)[0] == 'SELECT') {
            $data = $stmt->fetchAll();
            return $data;
        }
    }
}
?>