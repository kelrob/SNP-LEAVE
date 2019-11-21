<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Sentinel;
use App\Models\Users\UserModel;

class LineManagerController extends Controller
{
    public function lineManager() {

        $user = Sentinel::getUser();

        $collection = DB::table('leave_request')
            ->join('line_manager', 'leave_request.user_id', '=', 'line_manager.user_id')
            ->select("leave_request.id", "leave_request.user_id", "leave_request.status","leave_request.days_count",
                "leave_request.start_date",  "leave_request.end_date", "leave_request.created_at")
            ->where('line_manager.l_manager_id', '=', 2)
            ->where('leave_request.status', '=', 0)->get();

        $pendingRequests = array();
        foreach ($collection as $item) {
            $pendingRequests[] = $item;
        }

        //$userInfo = UserModel::find($pendingRequests[0]->user_id);
        //$userInfo->name;


        $data = [
            'name' => $user->name,
        ];

        /*$data2 = [
            'employee_name' => $userInfo->name,
            'start_date' => $pendingRequests[0]->start_date,
            'end_date' => $pendingRequests[0]->end_date,
            'day_count' => $pendingRequests[0]->days_count,
        ];*/
        
        return view('dashboard.line_manager', compact('data', 'pendingRequests'));
    }
}
