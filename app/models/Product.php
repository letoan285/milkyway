<?php 

class Product extends BaseModel {
    public $table = 'products';
    public $columns = ['name', 'description', 'price', 'category_id']; 
}