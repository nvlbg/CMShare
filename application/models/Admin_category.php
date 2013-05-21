<?php
class Admin_category extends Model
{
	
	public function categoryExists($category)
	{
		$this->db->query('SET names utf8');
		
		$category = trim($category);
		
		$stmt = $this->db->prepare('SELECT 1 FROM categories WHERE category_name = ?');
		$stmt->bind_param('s', $category);
		$stmt->execute();
		
		$stmt->store_result();
		
		return $stmt->num_rows == 1;
		
	}
	
	public function addCategory($category)
	{
		$this->db->query('SET names utf8');
		
		$category = trim($category);
		
		$stmt = $this->db->prepare('INSERT INTO categories (category_name) VALUES (?)');
		$stmt->bind_param('s', $category);
		$stmt->execute();
	}
	
}