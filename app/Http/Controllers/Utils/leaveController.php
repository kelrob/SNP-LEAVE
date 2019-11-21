<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

use Validator;
use Sentinel;
use App\Models\LeaveRequest\LeaveRequestModel;
use App\Models\Users\UserModel;
use App\Models\Holidays\PublicHolidays;
class LeaveController extends Controller
{
    public function processLeave(Request $request) {

        $leaveRequest = new LeaveRequestModel();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $carbonStartDate = Carbon::parse($startDate);
        $carbonEndDate = Carbon::parse($endDate);

        # Error Messages from the form
        $errorMsgs = [
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required'
        ];

        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required'
        ], $errorMsgs);

        if ($validator->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Please review fields',
                'errors' => $validator->errors()->all()
            );

            return response()->json($returnData, 500);
        }
        # End Error Messages from the form


        # Start Processing Leave
        $leaveDaysCount = $carbonStartDate->diffInDays($carbonEndDate);
        if ($leaveDaysCount > 20 ) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Leave days can not be more than 20'
            );
            return response()->json($returnData, 500);
        }

        if ($startDate > $endDate) {
            $returnData = array(
                'status' => 'error',
                'message' => 'You can not go back to a date latter than today'
            );
            return response()->json($returnData, 500);
        }

        # Check no of days left before processing leave
        $userInfo = Sentinel::getUser();
        $userDaysLeft = $userInfo->days_left;

        if ($userDaysLeft >= $leaveDaysCount) {
            $leaveRequest->user_id = $userInfo->id;
            $leaveRequest->start_date = $startDate;
            $leaveRequest->end_date = $endDate;
            $leaveRequest->days_count = $leaveDaysCount;

            $leaveRequest->save();

            return redirect(url('/employee?success'));
        }
        return true;
    }

    public function acceptLeave(Request $request) {

        $id = $request->input('id');
        $user_id = $request->input('user_id');
        $days_count = $request->input('days_count');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $userModel = UserModel::find($user_id);
        $leaveModel = LeaveRequestModel::find($id);

        $userLeaveDays = $userModel->days_left;

        if ($userLeaveDays >= $days_count) {
            $startDate = Carbon::parse($startDate);
            $expireDate = Carbon::parse($startDate)->addDays($days_count);

            for ($i = 1; $i <= $days_count; $i++) {

                $newDate = $startDate->addDays(1);
                $publicHolidays = PublicHolidays::all();
                foreach ($publicHolidays as $publicHoliday) {

                    $holidays = $publicHoliday->dates;

                    if (
                        ($newDate->format('M_d') == $holidays) ||
                        ($newDate->format('D') == 'Sat') ||
                        ($newDate->format('') == 'Sun')
                    ) {
                        $days_count = $days_count - 1;
                    }

                }
                // $newDate->format('M_d') . ' ' . $i .'<br />';
            }

            $userModel->days_left = $userModel->days_left - $days_count;
            $leaveModel->status = 1;
            $leaveModel->save();
            $userModel->save();

            return redirect(url('line-manager'));
        }
    }

    public function declineLeave($id) {
        $leaveModel = LeaveRequestModel::find($id);
        $leaveModel->status = 2;
        $leaveModel->save();

        return redirect(url('line-manager'));
    }
}
