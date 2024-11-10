<?php

namespace App\Models;

use CodeIgniter\Model;

class BonusConfigurationModel extends Model
{
    protected $table = 'bonus_configurations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bonus_percentage', 'evaluation_period', 'evaluation_score_threshold', 'created_at'];
}