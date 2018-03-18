<?php namespace Bantenprov\PerijinanSatuPintu\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The PerijinanSatuPintuModel class.
 *
 * @package Bantenprov\PerijinanSatuPintu
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class PerijinanSatuPintuModel extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'perijinan-satu-pintu';

    /**
    * The attributes that are mass assignable.
    *
    * @var mixed
    */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
