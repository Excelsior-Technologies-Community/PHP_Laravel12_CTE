# PHP_Laravel12_CTE
Complete step-by-step implementation of advanced SQL CTE queries inside a Laravel application.

This project demonstrates:

* Recursive CTEs
* Multiple layered CTEs
* Window functions with CTE
* Date series generation
* Aggregations with CTE
* Complex analytical queries
* Task management system example

---

## Step 1: Create a New Laravel Project

```bash
composer create-project laravel/laravel laravel-cte-demo
cd laravel-cte-demo
```

---

## Step 2: Configure Database

Update `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_cte_demo
DB_USERNAME=root
DB_PASSWORD=
```

Create database:

```sql
CREATE DATABASE laravel_cte_demo;
```

---

## Step 3: Create Migrations

### Add Fields to Users Table

```bash
php artisan make:migration add_fields_to_users_table
```

Adds:

* department (string, nullable)
* experience_years (integer, default 0)

---

### Create Tasks Table

```bash
php artisan make:migration create_tasks_table
```

Includes:

* Self-referencing parent_task_id (hierarchical tasks)
* Foreign key to users
* Status enum (pending, in_progress, completed)
* Priority
* Due date

---

### Create Task Logs Table

```bash
php artisan make:migration create_task_logs_table
```

Includes:

* Foreign key to tasks
* Action
* Details

---

Run migrations:

```bash
php artisan migrate
```

---

## Step 4: Create Models

Models created:

* User (updated)
* Task
* TaskLog

Relationships implemented:

* User → hasMany Tasks
* Task → belongsTo User
* Task → belongsTo Parent Task (self relationship)
* Task → hasMany Children
* Task → hasMany Logs

---

## Step 5: Factories and Seeders

Factories created for:

* User
* Task
* TaskLog

Seeder generates:

* 10 users
* 20 main tasks
* 30 subtasks
* 3 logs per task

Run:

```bash
php artisan migrate:fresh --seed
```

---

## Step 6: CTE Controller

```bash
php artisan make:controller CTEDemoController
```

Implemented CTE examples:

### 1. Recursive Hierarchy

Builds task tree using WITH RECURSIVE.

### 2. Task Statistics

User-level and department-level aggregations.

### 3. Task Timeline

Generates date series and cumulative metrics.

### 4. User Ranking

Uses RANK() window function with CTE.

### 5. Complex Analysis

Multiple CTEs layered together for performance benchmarking.

---

## Step 7: Routes

```php
Route::prefix('cte-demo')->group(function () {
    Route::get('/hierarchy', [CTEDemoController::class, 'taskHierarchy'])->name('cte.hierarchy');
    Route::get('/statistics', [CTEDemoController::class, 'taskStatistics'])->name('cte.statistics');
    Route::get('/timeline', [CTEDemoController::class, 'taskTimeline'])->name('cte.timeline');
    Route::get('/ranking', [CTEDemoController::class, 'userRanking'])->name('cte.ranking');
    Route::get('/analysis', [CTEDemoController::class, 'complexAnalysis'])->name('cte.analysis');
});
```

---

## Step 8: Views

TailwindCSS-based UI.

Pages created:

* Task Hierarchy
* Statistics Dashboard
* Timeline Analysis
* User Ranking
* Complex Performance Analysis

Each page renders results from raw SQL CTE queries.

---

## Step 9: Run Application

```bash
php artisan serve
```
<img width="1785" height="967" alt="image" src="https://github.com/user-attachments/assets/b527317c-0278-49de-90c7-9d69c801d2a7" />
<img width="1783" height="975" alt="image" src="https://github.com/user-attachments/assets/d15e171e-1a34-42c4-a09b-cada3bc9ef38" />
<img width="1712" height="467" alt="image" src="https://github.com/user-attachments/assets/daa3856f-a008-4470-87b2-a8b02cf460cb" />
<img width="1715" height="965" alt="image" src="https://github.com/user-attachments/assets/4a05e95b-6356-4765-8693-9e3c0d3ea319" />
<img width="1713" height="962" alt="image" src="https://github.com/user-attachments/assets/c0fd042e-34e7-47de-90be-a810a71063de" />

Visit:

* /cte-demo/hierarchy
* /cte-demo/statistics
* /cte-demo/timeline
* /cte-demo/ranking
* /cte-demo/analysis

---

## Key CTE Concepts Demonstrated

### Recursive CTE

Used for hierarchical task trees.

### Multiple CTE Layers

Breaking complex logic into readable blocks.

### Window Functions

RANK() OVER(), cumulative SUM() OVER().

### Date Series Generation

Creating continuous date ranges.

### Analytical Queries

Performance metrics and benchmarking.

---

## Why This Project Is Important

* Demonstrates advanced SQL inside Laravel
* Shows how to use raw DB::select safely
* Ideal for reporting dashboards
* Useful for analytics-heavy applications
* Real-world task management example

---

## Conclusion

This project demonstrates practical, production-level usage of Common Table Expressions (CTEs) in Laravel.

It showcases how complex SQL problems can be broken into manageable, readable query blocks using modern SQL features.

Perfect for:

* Senior Laravel interviews
* Backend architecture demonstrations
* Reporting dashboards
* Data-heavy applications

