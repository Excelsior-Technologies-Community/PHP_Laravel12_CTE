<?php
// app/Http/Controllers/CTEDemoController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Task;
use App\Models\User;

class CTEDemoController extends Controller
{
    /**
     * Demo 1: Hierarchical Task Tree using Recursive CTE
     */
    public function taskHierarchy()
    {
        $hierarchy = DB::select("
            WITH RECURSIVE task_tree AS (
                -- Anchor member: get root tasks (no parent)
                SELECT 
                    id,
                    title,
                    parent_task_id,
                    0 as level,
                    CAST(id AS CHAR(200)) as path,
                    title as path_names
                FROM tasks
                WHERE parent_task_id IS NULL
                
                UNION ALL
                
                -- Recursive member: get child tasks
                SELECT 
                    t.id,
                    t.title,
                    t.parent_task_id,
                    tt.level + 1,
                    CONCAT(tt.path, ',', t.id),
                    CONCAT(tt.path_names, ' > ', t.title)
                FROM tasks t
                INNER JOIN task_tree tt ON t.parent_task_id = tt.id
            )
            SELECT * FROM task_tree
            ORDER BY path
        ");

        return view('cte.hierarchy', compact('hierarchy'));
    }

    /**
     * Demo 2: Task Statistics with CTE
     */
    public function taskStatistics()
    {
        $stats = DB::select("
            WITH task_stats AS (
                SELECT 
                    u.id as user_id,
                    u.name,
                    u.department,
                    COUNT(t.id) as total_tasks,
                    COUNT(CASE WHEN t.status = 'completed' THEN 1 END) as completed_tasks,
                    COUNT(CASE WHEN t.status = 'in_progress' THEN 1 END) as in_progress_tasks,
                    COUNT(CASE WHEN t.status = 'pending' THEN 1 END) as pending_tasks,
                    AVG(t.priority) as avg_priority
                FROM users u
                LEFT JOIN tasks t ON u.id = t.user_id
                GROUP BY u.id, u.name, u.department
            ),
            department_stats AS (
                SELECT 
                    department,
                    COUNT(*) as user_count,
                    SUM(total_tasks) as department_total_tasks,
                    AVG(completed_tasks * 1.0 / NULLIF(total_tasks, 0)) as completion_rate
                FROM task_stats
                GROUP BY department
            )
            SELECT 
                ts.*,
                ds.completion_rate as department_completion_rate,
                ds.department_total_tasks
            FROM task_stats ts
            JOIN department_stats ds ON ts.department = ds.department
            ORDER BY ds.completion_rate DESC, ts.completed_tasks DESC
        ");

        return view('cte.statistics', compact('stats'));
    }

    /**
     * Demo 3: Task Timeline Analysis with CTE
     */
    public function taskTimeline()
    {
        $timeline = DB::select("
            WITH RECURSIVE date_series AS (
                SELECT MIN(DATE(created_at)) as date
                FROM tasks
                
                UNION ALL
                
                SELECT DATE_ADD(date, INTERVAL 1 DAY)
                FROM date_series
                WHERE date < (SELECT MAX(DATE(created_at)) FROM tasks)
            ),
            daily_stats AS (
                SELECT 
                    DATE(created_at) as task_date,
                    COUNT(*) as tasks_created,
                    COUNT(CASE WHEN status = 'completed' THEN 1 END) as tasks_completed
                FROM tasks
                GROUP BY DATE(created_at)
            ),
            running_totals AS (
                SELECT 
                    ds.date,
                    COALESCE(ds2.tasks_created, 0) as tasks_created,
                    COALESCE(ds2.tasks_completed, 0) as tasks_completed,
                    SUM(COALESCE(ds2.tasks_created, 0)) OVER (ORDER BY ds.date) as cumulative_created,
                    SUM(COALESCE(ds2.tasks_completed, 0)) OVER (ORDER BY ds.date) as cumulative_completed
                FROM date_series ds
                LEFT JOIN daily_stats ds2 ON ds.date = ds2.task_date
            )
            SELECT * FROM running_totals
            ORDER BY date
        ");

        return view('cte.timeline', compact('timeline'));
    }

    /**
     * Demo 4: User Performance Ranking with CTE
     */
    public function userRanking()
    {
        $ranking = DB::select("
            WITH user_scores AS (
                SELECT 
                    u.id,
                    u.name,
                    u.department,
                    u.experience_years,
                    COUNT(t.id) as task_count,
                    AVG(CASE 
                        WHEN t.status = 'completed' AND t.due_date >= t.updated_at THEN 10
                        WHEN t.status = 'completed' AND t.due_date < t.updated_at THEN 5
                        WHEN t.status = 'in_progress' THEN 3
                        ELSE 1
                    END) as performance_score,
                    SUM(CASE 
                        WHEN t.status = 'completed' THEN 1
                        ELSE 0
                    END) as completed_count
                FROM users u
                LEFT JOIN tasks t ON u.id = t.user_id
                GROUP BY u.id, u.name, u.department, u.experience_years
            ),
            department_averages AS (
                SELECT 
                    department,
                    AVG(performance_score) as avg_dept_score,
                    AVG(completed_count) as avg_dept_completed
                FROM user_scores
                GROUP BY department
            )
            SELECT 
                us.*,
                da.avg_dept_score,
                da.avg_dept_completed,
                RANK() OVER (ORDER BY us.performance_score DESC) as overall_rank,
                RANK() OVER (PARTITION BY us.department ORDER BY us.performance_score DESC) as dept_rank
            FROM user_scores us
            JOIN department_averages da ON us.department = da.department
            ORDER BY us.department, dept_rank
        ");

        return view('cte.ranking', compact('ranking'));
    }

    /**
     * Demo 5: Complex Task Analysis with Multiple CTEs
     */
    public function complexAnalysis()
    {
        $analysis = DB::select("
            WITH 
            -- CTE 1: Task completion times
            task_completion AS (
                SELECT 
                    t.id,
                    t.user_id,
                    t.parent_task_id,
                    t.status,
                    t.priority,
                    TIMESTAMPDIFF(HOUR, t.created_at, t.updated_at) as completion_hours,
                    CASE 
                        WHEN t.parent_task_id IS NOT NULL THEN 'Subtask'
                        ELSE 'Main Task'
                    END as task_type
                FROM tasks t
                WHERE t.status = 'completed'
            ),
            
            -- CTE 2: User efficiency metrics
            user_efficiency AS (
                SELECT 
                    tc.user_id,
                    u.name,
                    u.department,
                    COUNT(*) as completed_tasks,
                    AVG(tc.completion_hours) as avg_completion_hours,
                    AVG(CASE WHEN tc.task_type = 'Subtask' THEN tc.completion_hours END) as avg_subtask_hours,
                    AVG(CASE WHEN tc.task_type = 'Main Task' THEN tc.completion_hours END) as avg_maintask_hours
                FROM task_completion tc
                JOIN users u ON tc.user_id = u.id
                GROUP BY tc.user_id, u.name, u.department
            ),
            
            -- CTE 3: Department benchmarks
            department_benchmarks AS (
                SELECT 
                    department,
                    AVG(avg_completion_hours) as dept_avg_hours,
                    AVG(completed_tasks) as dept_avg_tasks,
                    STDDEV(avg_completion_hours) as hours_stddev
                FROM user_efficiency
                GROUP BY department
            )
            
            -- Final query combining all CTEs
            SELECT 
                ue.*,
                db.dept_avg_hours,
                db.hours_stddev,
                CASE 
                    WHEN ue.avg_completion_hours < db.dept_avg_hours - db.hours_stddev THEN 'Above Average'
                    WHEN ue.avg_completion_hours BETWEEN db.dept_avg_hours - db.hours_stddev AND db.dept_avg_hours + db.hours_stddev THEN 'Average'
                    ELSE 'Below Average'
                END as performance_category,
                ROUND((ue.avg_completion_hours / NULLIF(db.dept_avg_hours, 0)) * 100, 2) as efficiency_ratio
            FROM user_efficiency ue
            JOIN department_benchmarks db ON ue.department = db.department
            ORDER BY ue.avg_completion_hours
        ");

        return view('cte.analysis', compact('analysis'));
    }
}