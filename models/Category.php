<?php
require_once('Model.php');

class Category extends Model
{
    protected static string $table = 'categories';

    protected int $id;
    private string $name;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function toArray()
    {
        return [$this->id, $this->name];
    }
}