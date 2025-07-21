<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barangay;
use App\Models\HouseholdRequest;

class HouseholdRequestController extends Controller
{
    public function show()
    {
        $barangays = Barangay::orderBy('name')->get();
        return view('guest.household-request', compact('barangays'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'household_name' => 'required|string|max:255',
            'household_head' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'barangay_id' => 'required|exists:barangays,id',
            'address_description' => 'required|string|max:1000',
            'terms' => 'required|accepted',
            'privacy' => 'required|accepted',
        ], [
            'household_name.required' => 'Household name is required.',
            'household_head.required' => 'Household head name is required.',
            'contact_number.required' => 'Contact number is required.',
            'email.email' => 'Please enter a valid email address.',
            'barangay_id.required' => 'Please select your barangay.',
            'barangay_id.exists' => 'Please select a valid barangay.',
            'address_description.required' => 'Address description is required.',
            'terms.required' => 'You must agree to the terms and conditions.',
            'terms.accepted' => 'You must agree to the terms and conditions.',
            'privacy.required' => 'You must consent to data processing.',
            'privacy.accepted' => 'You must consent to data processing.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $householdRequest = HouseholdRequest::create([
                'household_name' => $request->household_name,
                'household_head' => $request->household_head,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'barangay_id' => $request->barangay_id,
                'address_description' => $request->address_description,
                'request_status' => 'pending',
            ]);

            return back()->with('success', 'Your household request has been submitted successfully! Barangay officials will review your request and contact you once your account is created.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while submitting your request. Please try again.'])->withInput();
        }
    }
} 