<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    /**
     * Task list
     *
     * Features:
     * - Search
     * - Filters
     * - Sorting
     * - Pagination
     */
    public function index(Request $request)
    {
        $query = Task::with([
            'user',
            'parent',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Priority Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('priority')) {

            $query->where(
                'priority',
                $request->priority
            );
        }

        /*
        |--------------------------------------------------------------------------
        | User Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('user_id')) {

            $query->where(
                'user_id',
                $request->user_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Due Date From
        |--------------------------------------------------------------------------
        */

        if ($request->filled('due_from')) {

            $query->whereDate(
                'due_date',
                '>=',
                $request->due_from
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Due Date To
        |--------------------------------------------------------------------------
        */

        if ($request->filled('due_to')) {

            $query->whereDate(
                'due_date',
                '<=',
                $request->due_to
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        $allowedSorts = [
            'id',
            'title',
            'status',
            'priority',
            'due_date',
            'created_at',
        ];

        $sortBy = $request->get('sort_by', 'id');

        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }

        $sortDirection = $request->get(
            'sort_direction',
            'asc'
        );

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query->orderBy(
            $sortBy,
            $sortDirection
        );

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $perPage = (int) $request->get('per_page', 10);

        if (!in_array($perPage, [5, 10, 15, 25, 50])) {
            $perPage = 10;
        }

        $tasks = $query
            ->paginate($perPage)
            ->withQueryString();

        $users = User::orderBy('name')->get();

        return view(
            'tasks.index',
            compact(
                'tasks',
                'users',
                'sortBy',
                'sortDirection',
                'perPage'
            )
        );
    }

    /**
     * Task details
     */
    public function show(Task $task)
    {
        $task->load([
            'user',
            'parent',
            'children',
            'logs',
        ]);

        return view(
            'tasks.show',
            compact('task')
        );
    }

    /**
     * Delete task
     *
     * Uses SoftDeletes.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'Task moved to trash successfully.'
            );
    }

    /**
     * Trash
     */
    public function trash()
    {
        $tasks = Task::onlyTrashed()
            ->with('user')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view(
            'tasks.trash',
            compact('tasks')
        );
    }

    /**
     * Restore task
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()
            ->findOrFail($id);

        $task->restore();

        return redirect()
            ->route('tasks.trash')
            ->with(
                'success',
                'Task restored successfully.'
            );
    }

    /**
     * Permanently delete task
     */
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Delete task logs first
        |--------------------------------------------------------------------------
        */

        $task->logs()->delete();

        /*
        |--------------------------------------------------------------------------
        | Remove children
        |--------------------------------------------------------------------------
        */

        Task::where(
            'parent_task_id',
            $task->id
        )->update([
            'parent_task_id' => null,
        ]);

        $task->forceDelete();

        return redirect()
            ->route('tasks.trash')
            ->with(
                'success',
                'Task permanently deleted.'
            );
    }

    /**
     * CSV Export
     *
     * Exports the same filtered data shown on task list.
     */
    public function export(Request $request)
    {
        $query = Task::with('user');

        /*
        |--------------------------------------------------------------------------
        | Same Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->filled('priority')) {

            $query->where(
                'priority',
                $request->priority
            );
        }

        if ($request->filled('user_id')) {

            $query->where(
                'user_id',
                $request->user_id
            );
        }

        if ($request->filled('due_from')) {

            $query->whereDate(
                'due_date',
                '>=',
                $request->due_from
            );
        }

        if ($request->filled('due_to')) {

            $query->whereDate(
                'due_date',
                '<=',
                $request->due_to
            );
        }

        $tasks = $query
            ->orderBy('id', 'asc')
            ->get();

        $filename =
            'tasks_' .
            now()->format('Y_m_d_H_i_s') .
            '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' =>
            'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($tasks) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Title',
                'Description',
                'User',
                'Status',
                'Priority',
                'Due Date',
                'Parent Task',
                'Created At',
            ]);

            foreach ($tasks as $task) {

                fputcsv($file, [
                    $task->id,
                    $task->title,
                    $task->description,
                    optional($task->user)->name,
                    $task->status,
                    $task->priority,
                    optional($task->due_date)->format('Y-m-d'),
                    optional($task->parent)->title,
                    optional($task->created_at)->format(
                        'Y-m-d H:i:s'
                    ),
                ]);
            }

            fclose($file);
        };

        return Response::stream(
            $callback,
            200,
            $headers
        );
    }

    /**
     * Analytics dashboard
     */
    public function analytics()
    {
        /*
        |--------------------------------------------------------------------------
        | Main statistics
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::count();

        $completedTasks = Task::where(
            'status',
            'completed'
        )->count();

        $pendingTasks = Task::where(
            'status',
            'pending'
        )->count();

        $inProgressTasks = Task::where(
            'status',
            'in_progress'
        )->count();

        $overdueTasks = Task::where(
            'status',
            '!=',
            'completed'
        )
            ->whereNotNull('due_date')
            ->whereDate(
                'due_date',
                '<',
                now()->toDateString()
            )
            ->count();

        $completionRate = $totalTasks > 0
            ? round(
                ($completedTasks / $totalTasks) * 100,
                2
            )
            : 0;

        /*
        |--------------------------------------------------------------------------
        | User statistics
        |--------------------------------------------------------------------------
        */

        $userStats = DB::table('users')
            ->leftJoin(
                'tasks',
                'users.id',
                '=',
                'tasks.user_id'
            )
            ->select(
                'users.id',
                'users.name',
                'users.department',
                DB::raw('COUNT(tasks.id) as total_tasks'),
                DB::raw(
                    "SUM(
                        CASE
                            WHEN tasks.status = 'completed'
                            THEN 1
                            ELSE 0
                        END
                    ) as completed_tasks"
                ),
                DB::raw(
                    "SUM(
                        CASE
                            WHEN tasks.status = 'pending'
                            THEN 1
                            ELSE 0
                        END
                    ) as pending_tasks"
                ),
                DB::raw(
                    "SUM(
                        CASE
                            WHEN tasks.status = 'in_progress'
                            THEN 1
                            ELSE 0
                        END
                    ) as in_progress_tasks"
                )
            )
            ->groupBy(
                'users.id',
                'users.name',
                'users.department'
            )
            ->orderBy('completed_tasks', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Department statistics
        |--------------------------------------------------------------------------
        */

        $departmentStats = DB::table('users')
            ->leftJoin(
                'tasks',
                'users.id',
                '=',
                'tasks.user_id'
            )
            ->select(
                'users.department',
                DB::raw('COUNT(tasks.id) as total_tasks'),
                DB::raw(
                    "SUM(
                        CASE
                            WHEN tasks.status = 'completed'
                            THEN 1
                            ELSE 0
                        END
                    ) as completed_tasks"
                ),
                DB::raw(
                    "SUM(
                        CASE
                            WHEN tasks.status = 'pending'
                            THEN 1
                            ELSE 0
                        END
                    ) as pending_tasks"
                )
            )
            ->whereNotNull('users.department')
            ->groupBy('users.department')
            ->orderBy('completed_tasks', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Priority statistics
        |--------------------------------------------------------------------------
        */

        $priorityStats = Task::select(
            'priority',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('priority')
            ->orderBy('priority')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent tasks
        |--------------------------------------------------------------------------
        */

        $recentTasks = Task::with('user')
            ->oldest()
            ->limit(5)
            ->get();

        return view(
            'tasks.analytics',
            compact(
                'totalTasks',
                'completedTasks',
                'pendingTasks',
                'inProgressTasks',
                'overdueTasks',
                'completionRate',
                'userStats',
                'departmentStats',
                'priorityStats',
                'recentTasks'
            )
        );
    }
}
