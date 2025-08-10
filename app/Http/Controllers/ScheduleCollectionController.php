<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleCollection;
use Illuminate\Support\Facades\Auth;

class ScheduleCollectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $barangayId = $user->barangay_id;

        $collections = ScheduleCollection::woth(['schedule.truck', 'schedule.barangay', 'schedule.wasteType'])
            ->whereHas('schedule', function($query) use ($barangayId){
                $query->where('barangay_id', $barangayId);
            })
            ->orderBy('collection_date', 'asc')
            ->get();
        
        //Render different views depending on the role
        if($user->role === 'barangay_official'){
            return view('barangay.scheduled_collections.index', compact('collections'));
        } elseif($user->role === 'resident'){
            return view('resident.scheduled_collections.index', compact('collections'));
        }


        abort(403, 'Unauthorized action.');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'truck_id' => 'nullable|exists:truck,id',
            'reschedules_date' => 'nullable|date',
            'change_reason' => 'nullable|string|max:255',
            'status' => 'required|in:pending, in_progress,completed,missed',
        ]);

        $scheduleCollection = ScheduleCollection::findOrFail($id);

        //Store previous values for logging if needed
        $originalTruck = $scheduleCollection->truck_id;
        $originalDate = $scheduleCollection->collection_date;

        $scheduleCollection->update([
            'truck_id' => $request->truck_id,
            'rescheduled_date' => $request->reschedules_date,
            'status' => $request->status,
            'change_reason' => $request->change_reason ?? $this->generateChangeReason($originalTruck, $originalDate, $request),
            'changed_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Schedule Updated Successfully');
    }

    /**
     * Generate a default change reason if not provided.
     */

    private function generateChangeReason($originalTruck, $originalDate, $request)
    {
        $reason = [];

        if($originalTruck != $request->truck_id){
            $reason[] = 'Truck changed';
        }
        if($originalDate != $request->rescheduled_date){
            $reason[] = 'Date rescheduled';
        }

        return implode(' & ', $reason) ?: null;
    }
}
