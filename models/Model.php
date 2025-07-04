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
        global $mysqli;
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ?",
            static::$table,
            static::$primary_key
        );

        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all()
    {
        global $mysqli;
        $sql = sprintf("SELECT * FROM %s", static::$table);

        $query = $mysqli->prepare($sql);
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
        global $mysqli;

        [$joinedCols, $placeholders] = getJoinedSqlStrings($data);
        $sql =
            sprintf(
                "INSERT INTO %s (%s) values (%s)",
                static::$table,
                $joinedCols,
                $placeholders
            );

        $query = $mysqli->prepare($sql);
        $query->execute(array_values($data));

        return $query->insert_id;
    }

    abstract public function toArray();

    //you have to continue with the same mindset
    //Find a solution for sending the $mysqli everytime... 
    //Implement the following: 
    //1- update() -> non-static function 
    //2- create() -> static function
    //3- delete() -> static function 
}



