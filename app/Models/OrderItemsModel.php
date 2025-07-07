<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemsModel extends Model
{
    protected $table            = 'order_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getOrderItemsWithProductDetails($order_id = null)
    {
        // Memulai query builder
        $builder = $this->db->table($this->table);

        // Memilih kolom yang dibutuhkan
        // 'products.name as name' -> mengambil kolom 'name' dari tabel 'products' dan menamainya 'name'
        // 'order_items.price as price' -> mengambil kolom 'price' dari 'order_items' dan menamainya 'price'
        // dan seterusnya...
        $builder->select('products.name as name, order_items.price as price, order_items.quantity as amount, order_items.subtotal as subtotal, order_items.id');

        // Menggabungkan dengan tabel 'products'
        // JOIN dilakukan berdasarkan product_id di 'order_items' dan id di 'products'
        $builder->join('products', 'products.id = order_items.product_id');

        // Jika ada parameter $order_id, filter berdasarkan itu
        if ($order_id !== null) {
            $builder->where('order_items.order_id', $order_id);
        }

        // Menjalankan query dan mendapatkan hasilnya
        $query = $builder->get();

        // Mengembalikan hasil dalam bentuk array
        return $query->getResultArray();
    }
}
