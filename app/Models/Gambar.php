<?php

namespace App\Models;

use CodeIgniter\Model;

class Gambar extends Model
    {
    protected $primaryKey = 'id_gambar';
    protected $allowedFields = ['id_gambar','id_sumber','nama_sumber','gambar','random_code'];
    protected $table = 'tb_gambar';
	protected $DBGroup              = 'default';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	 public function banner()
    {
        return $this->belongsTo(Banners::class, 'random_code', 'random_code');
    }
}