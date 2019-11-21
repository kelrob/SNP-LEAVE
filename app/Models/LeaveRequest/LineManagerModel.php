<?php

namespace App\Models\LeaveRequest;

use Illuminate\Database\Eloquent\Model;

class LineManagerModel extends Model
{
    protected $table = 'line_manager';
    protected $primaryKey = 'id';

    public function LeaveRequest() {
        return $this->belongsTo('App\Models\LeaveRequest\LineManagerModel');
    }
}
