<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(): View
    {
        $userId = auth()->user()->id;
        $filterValue = request('filter', 5);
        $tasks = Task::where('user_id', $userId);
        if ($filterValue == 1) {
            $tasks->whereDate('date', Carbon::today());
        } elseif ($filterValue == 2) {
            $tasks->whereBetween('date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        } elseif ($filterValue == 3) {
            $tasks->whereMonth('date', Carbon::now()->month);
        } elseif ($filterValue == 4) {
            $tasks->whereYear('date', Carbon::now()->year);
        }

        $tasks = $tasks->get();

        return view('tasks.index', compact('tasks'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Task::create($validatedData);
        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json(['status' => 'success', 'message' => 'Task fetch successfully', 'data' => $task]);
        } catch (\Throwable $exception) {
            Log::debug($exception->getMessage());
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
//        dd($task);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
//            'time' => 'required|date_format:H:i',
            'time' => ['required', 'date_format:H:i:s'],
            'description' => 'nullable|string',
        ]);

        $task->update($validatedData);
        return redirect()->back()->with('success', 'Task updated successfully!')->with('reload', true);

//        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(['status' => 'success', 'message' => 'Task deleted successfully']);
    }

}
