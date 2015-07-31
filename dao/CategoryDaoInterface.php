<?php

interface CategoryDaoInterface
{
	public function create(CategoryBO $categoryBO);
	public function getAll();
	public function getById(CategoryBO $categoryBO);
	public function update(CategoryBO $categoryBO);
	public function delete(array $ids);
	
}