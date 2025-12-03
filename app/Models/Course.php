<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Course merepresentasikan tabel 'courses' di database.
 * Di sinilah Anda mendefinisikan hubungan (relationships) dan properti mass assignment.
 */
class Course extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model. Default-nya adalah 'courses'.
     *
     * @var string
     */
    // protected $table = 'courses'; 

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Sesuaikan dengan kolom-kolom yang ada di tabel 'courses' Anda.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'teacher_id', // Misalnya, siapa guru yang mengajar kursus ini
        'status',     // Misalnya, 'active' atau 'draft'
        'credits',    // Jumlah SKS atau poin
    ];

    /**
     * Mendefinisikan relasi: Satu kursus diajar oleh satu guru (User).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        // Asumsi kolom foreign key adalah 'teacher_id' dan merujuk ke model User
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Mendefinisikan relasi: Banyak siswa (User) dapat mengambil kursus ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        // Asumsi menggunakan tabel pivot 'course_user'
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }
}