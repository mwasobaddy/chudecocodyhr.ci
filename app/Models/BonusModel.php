<?php

namespace App\Models;

use CodeIgniter\Model;

class BonusModel extends Model
{
    protected $table = 'bonuses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'evaluation_id', 'bonus_amount', 'created_at'];
}