<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Linkspace</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite('resources/css/admin/dashboard.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="admin-body">

    @include('admin.partials.navbar')

    <main class="dashboard-wrapper">
        <header class="dashboard-header">
            <div>
                <h1>Dashboard Overview</h1>
                <p>Welcome back, Admin. Here's what's happening today.</p>
            </div>
            <button class="primary-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Generate Report
            </button>
        </header>

        <div class="admin-container">
            <div class="chart-card">
                <div class="card-info">
                    <h3>Total Users</h3>
                    <div class="big-number">{{ number_format($users) }}</div>
                    <span class="trend up">↑ 12% from last month</span>
                </div>
                <div class="chart-container">
                    <canvas id="usersChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="card-info">
                    <h3>Total Posts</h3>
                    <div class="big-number">{{ number_format($posts) }}</div>
                    <span class="trend up">↑ 5% from last month</span>
                </div>
                <div class="chart-container">
                    <canvas id="postsChart"></canvas> </div>
            </div>
        </div>
    </main>

    <script>
    // Configuration for a modern, thin doughnut chart
    const chartOptions = {
        cutout: '82%',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: { enabled: true }
        }
    };

    new Chart(document.getElementById('usersChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active Users', 'Target'],
            datasets: [{
                data: [{{ $users }}, 100], // Example target
                backgroundColor: ['#2f7d4a', '#e6ece9'],
                borderWidth: 0,
                borderRadius: 10
            }]
        },
        options: chartOptions
    });

    new Chart(document.getElementById('postsChart'), {
        type: 'doughnut',
        data: {
            labels: ['Total Posts', 'Goal'],
            datasets: [{
                data: [{{ $posts }}, 500],
                backgroundColor: ['#1b5e20', '#e6ece9'],
                borderWidth: 0,
                borderRadius: 10
            }]
        },
        options: chartOptions
    });
    </script>
</body>
</html>