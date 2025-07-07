<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'stock',
        'price',
        'images',
        'category_id',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProductWithCategories()
    {
        // Gunakan Query Builder untuk membuat query JOIN
        return $this->db->table('products')
            ->select('products.*, categories.category_type as category_name') // Pilih semua kolom dari products dan kolom category_name dari categories
            ->join('categories', 'categories.id = products.category_id') // Kondisi JOIN
            ->get()
            ->getResultArray(); // Ambil hasilnya sebagai array
    }
}
