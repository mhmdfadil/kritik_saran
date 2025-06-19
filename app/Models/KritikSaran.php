<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'tb_layanan';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'judul',
        'deskripsi',
        'tgl_layanan',
        'status',
        'tanggapan',
        'tgl_selesai'
    ];
 /**
     * Get the user that owns the layanan.
     */
    public function _user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
