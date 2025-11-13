<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Work;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $User = Auth::user();
        if ($User->hasRole('admin')) {
            $works = Work::all();
        } elseif ($User->hasRole('carrier')) {
            $works = Work::where('carrier', $User->id)->get();
        } else {
            return redirect()->route('dashboard');
        }
        
        return view('works.index', compact('works'));
    }

    /**
     * Show the form for deleting an old resource.
     */
    public function delete(Work $work)
    {
        $User = Auth::user();
        if ($User->hasRole('admin')) {
            $isDeleted = $work->delete();
            return redirect()->route('works');
        } 
        return redirect()->route('dashboard');
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $User = Auth::user();
        if ($User->hasRole('admin')) {
            $carriers = User::where('role', 'carrier')->get();
            return view('works.create', compact('carriers'));            
        } 
        return redirect()->route('dashboard');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $User = Auth::user();
        if ($User->hasRole('admin')) {
        
            $validatedData = $request->validate([
                'start_place'     => 'required|string',
                'end_place'       => 'required|string',
                'recipient_name'  => 'required|string|max:250',
                'recipient_phone' => 'required|string|max:20',
                'carrier'         => 'required|integer',
            ]);
            $status = [];
            if ($validatedData['carrier'] > 0) {
                $status = [
                    'carrier' => $validatedData['carrier'],
                    'status'  => 1,
                ];
            }
            $work = Work::create([
                'start_place'     => $validatedData['start_place'],
                'end_place'       => $validatedData['end_place'],
                'recipient_name'  => $validatedData['recipient_name'],
                'recipient_phone' => $validatedData['recipient_phone'], 
                'created_at'      => now(),
                'updated_at'      => now(),                 
            ] + $status);
            return redirect()->route('works');
            

        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        $User = Auth::user();
        if ($User->hasRole('admin') && isset($work)) {
            $carriers = User::where('role', 'carrier')->get();
            $statuses = Status::all();
            return view('works.edit', compact('work', 'carriers', 'statuses'));            
        } elseif ($User->hasRole('carrier') && isset($work)) {
            return redirect()->route('works.editcarrier', $work);
        }
        return redirect()->route('dashboard');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editcarrier(Work $work)
    {
        $User = Auth::user();
        if ($User->hasRole('carrier') && isset($work)) {
            $statuses = Status::all();
            return view('works.editcarrier', compact('work', 'statuses'));            
        } elseif ($User->hasRole('admin') && isset($work)) {
            return redirect()->route('works.edit', $work);
        }
        return redirect()->route('dashboard');
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $User = Auth::user();
        if ($User->hasRole('admin')) {
            $work = Work::find((int) $request->input('id'));
            $validatedData = $request->validate([
                'start_place'     => 'required|string',
                'end_place'       => 'required|string',
                'recipient_name'  => 'required|string|max:250',
                'recipient_phone' => 'required|string|max:20',
                'carrier'         => 'required|integer',
                'status'          => 'required|integer',
            ]);
            $status = [
                'carrier' => intval($validatedData['carrier']),
                'status'  => intval($validatedData['status']),
            ];
            if (intval($validatedData['carrier']) == 0 || intval($validatedData['status']) == 0) {
                $status = [
                    'carrier' => NULL,
                    'status'  => NULL,
                ];
            }
            $wasUpdated = 
            $work->update([
                'start_place'     => $validatedData['start_place'],
                'end_place'       => $validatedData['end_place'],
                'recipient_name'  => $validatedData['recipient_name'],
                'recipient_phone' => $validatedData['recipient_phone'], 
                'updated_at'      => now(),      
                'created_at'      => $work->created_at,           
            ] + $status);
            return redirect()->route('works');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatecarrier(Request $request)
    {
        $User = Auth::user();
        if ($User->hasRole('carrier')) { 
            $work = Work::find((int) $request->input('id'));
            $validatedData = $request->validate([
                'status'          => 'required|integer',
            ]);
            $wasUpdated = 
            $work->update([
                'status' => $validatedData['status'], 
                'updated_at'      => now(),      
            ]);
            return redirect()->route('works');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        //
    }
}
