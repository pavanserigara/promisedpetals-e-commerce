<?php
class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCategories()
    {
        return $this->db->toObjects($this->db->findAll('categories'));
    }

    public function getCategoryById($id)
    {
        $category = $this->db->findOne('categories', ['id' => $id]);
        return $category ? (object) $category : false;
    }

    public function addCategory($data)
    {
        return $this->db->insert('categories', $data);
    }

    public function updateCategory($data)
    {
        return $this->db->update('categories', $data['id'], $data);
    }

    public function deleteCategory($id)
    {
        return $this->db->delete('categories', $id);
    }
}
