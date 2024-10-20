<?php

namespace App\Http\Controllers;

use App\Models\ApplicationForm;
use App\Models\Client;
use App\Models\Notification;
use App\Models\Requirement;
use App\Models\User;
use App\Notifications\NewNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index() {
        $notification = Notification::with('applicationForm')->where('client_id', auth()->user()->client_id)
        ->orderBy('id', 'desc')
        ->get();

        return Inertia::render('Client/Notification', [
            'notification' => $notification
        ]);
    }

    public function getRecord(Notification $notification) {
        $form = $notification->applicationForm;
        $type = $form->type;
        $clientId = $form->client_id;
        $record = Requirement::getRequirementsWithApplicationForm($form->id, $clientId, 5, $type);
        $notification->is_viewed = true;
        $notification->save();

        $client = Client::find($clientId);
        $age = $this->calculateAge($client['birthday']);
        $client['age'] = $age;
 
        return Inertia::render('Client/ApplicationFormView', [
            'form' => $form,
            'record' => $record,
            'client' => $client,
            'typeProp' => $type,
            'params' => $form->only(['id', 'type', 'clientId'])
        ]);
    }

    /**
     * Calculate age based on birtdate
     * 
     * @param string|null $date. Date of Birth
     * @return int|null
     */
    private function calculateAge(?string $date): ?int
    {
        if (is_null($date)) {
            return null;
        }
    
        $birthdate = Carbon::parse($date);
        $today = Carbon::now();
        $age = $today->diffInYears($birthdate);

        return $age;
    }

    public function getNotificationCount()
    {
        $count = Notification::where('is_viewed', false)
            ->where('client_id', auth()->user()->client_id)
            ->count();

        return $count;
    }
}
