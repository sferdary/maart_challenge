<?php
require_once(CREDENTIALS);

class DB extends Credentials
{
    //DATABASE CONTROLL
    private static function connect()
    {
        try {
            $dsn = "mysql:host=" . Credentials::$DBhost . "; dbname=" . Credentials::$database . "; charset=" . Credentials::$DBcharset . ";";
            $connection = new PDO($dsn, Credentials::$DBusername, Credentials::$DBpassword, null);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function select($data, $params = array())
    {
        if (explode(' ', $data)[0] == 'SELECT') {
            try {
                $query = self::connect()->prepare($data);
                $query->execute($params) or die('Error executing.');
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public static function insert($data, $params = array())
    {
        if (explode(' ', $data)[0] == 'INSERT') {
            try {
                $query = self::connect()->prepare($data);
                $result = $query->execute($params) or die('Error executing.');
                return $result;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public static function update($data, $params = array())
    {
        if (explode(' ', $data)[0] == 'UPDATE') {
            try {
                $query = self::connect()->prepare($data);
                $result = $query->execute($params) or die('Error executing.');
                return $result;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public static function delete($data, $params = array())
    {
        if (explode(' ', $data)[0] == 'DELETE') {
            try {
                $query = self::connect()->prepare($data);
                $result = $query->execute($params) or die('Error executing.');
                return $result;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
}