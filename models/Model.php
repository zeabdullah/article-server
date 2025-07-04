<?php
require_once(__DIR__ . '/../connection/connection.php');
require_once(__DIR__ . '/../helpers/helpers.php');

abstract class Model
{
    protected static string $table;
    protected static string $primary_key = "id";

    protected int $id;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? -1;
    }

    public static function find(int $id)
    {
        $db = Database::getInstance();

        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ?",
            static::$table,
            static::$primary_key
        );

        $query = $db->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all()
    {
        $db = Database::getInstance();
        $sql = sprintf("SELECT * FROM %s", static::$table);

        $query = $db->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while ($row = $data->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    public function save(): bool
    {
        if ($this->id === -1) {
            return false;
        }

        $data = $this->toArray();
        unset($data['id']); // to prevent db insertion with ID '-1'

        $this->id = static::insert($data);

        return true;
    }

    public static function create(array $data)
    {
        $data['id'] = static::insert($data);
        return new static($data);
    }

    private static function insert(array $data)
    {
        $db = Database::getInstance();
        [$joinedCols, $placeholders] = getJoinedSqlINSERTStrings($data);

        $sql =
            sprintf(
                "INSERT INTO %s (%s) values (%s)",
                static::$table,
                $joinedCols,
                $placeholders
            );

        $query = $db->prepare($sql);
        $query->execute(array_values($data));

        return $query->insert_id;
    }

    public static function deleteById(string $id)
    {
        $db = Database::getInstance();
        $sql = sprintf(
            "DELETE FROM %s WHERE %s = ?",
            static::$table,
            static::$primary_key
        );
        return $db->prepare($sql)->execute([$id]);
    }

    public function delete()
    {
        if ($this->id === -1) {
            return false;
        }
        return static::deleteById($this->id);
    }

    public static function deleteAll()
    {
        $db = Database::getInstance();
        $sql = sprintf(
            "DELETE FROM %s WHERE 1",
            static::$table,
        );
        return $db->prepare($sql)->execute();
    }


    public function update(array $data)
    {
        $db = Database::getInstance();

        $commaSeparatedSetParams = implode(',', array_fill(0, count($data), '%s=?'));
        $formattedCommaSeparatedSetParams = sprintf(
            $commaSeparatedSetParams,
            ...array_keys($data)
        );

        $sql = sprintf(
            "UPDATE %s
            SET %s
            WHERE %s = ?",
            static::$table,
            $formattedCommaSeparatedSetParams,
            static::$primary_key
        );

        return $db->prepare($sql)->execute([...array_values($data), $this->id]);
    }

    abstract public function toArray();

    //you have to continue with the same mindset
    //Find a solution for sending the $mysqli everytime... 
    //Implement the following: 
    //1- update() -> non-static function 
    //2- create() -> static function
    //3- delete() -> static function 
}



