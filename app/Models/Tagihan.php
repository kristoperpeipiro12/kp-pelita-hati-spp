<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $table = 'tagihan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'kelas';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kelas',
        'tagihan_aktif',
        'tagihan_perbulan',
        'total_tagihan',
    ];

    /**
     * Calculate and update the total_tagihan attribute.
     *
     * @return void
     */
    public function updateTotalTagihan()
    {
        $this->total_tagihan = $this->tagihan_perbulan * 12;
        $this->save();
    }


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($tagihan) {
            $tagihan->total_tagihan = $tagihan->tagihan_perbulan * 12;
        });
    }
}
