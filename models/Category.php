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
}