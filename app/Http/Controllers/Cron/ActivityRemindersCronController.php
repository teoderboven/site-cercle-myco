<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 * Class ActivityRemindersCronController
 *
 * Controller responsible for handling cron requests related to activity reminders.
 */
class ActivityRemindersCronController extends Controller
{
    /**
     * Handle the request to send pending activity reminders.
     *
     * @param Request $req The incoming HTTP request.
     * @return JsonResponse JSON response indicating the status of the reminder sending process.
     */
    public function sendPendingReminders(Request $req) : JsonResponse
    {
         $exitCode = Artisan::call('reminders:send');

         $output = Artisan::output();

        return response()->json([
            'status' => $exitCode === 0 ? 'success' : 'error',
            'output' => trim($output),
        ]);
    }
}
