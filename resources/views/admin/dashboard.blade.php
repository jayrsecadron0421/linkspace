<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    @vite('resources/css/admin/dashboard.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    @include('admin.partials.navbar')

    <div class="admin-container">

        <div class="chart-card">
            <h3>Total Users</h3>
            <div class="big-number">{{ $users }}</div>
            <canvas id="usersChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Total Posts</h3>
            <div class="big-number">{{ $posts }}</div>
            <canvas id="postsChart"></canvas>
        </div>

    </div>

    <script>
    const usersCount = {{ $users }};
    const postsCount = {{ $posts }};

    new Chart(document.getElementById('usersChart'), {
        type: 'doughnut',
        data: {
            labels: ['Users'],
            datasets: [{
                data: [usersCount],
                backgroundColor: ['#2f7d4a'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: { display: false }
            }
        }
    });

    new Chart(document.getElementById('usersChart'), {
        type: 'doughnut',
        data: {
            labels: ['Posts'],
            datasets: [{
                data: [usersCount],
                backgroundColor: ['#2f7d4a'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: { display: false }
            }
        }
    });
    </script>

</body>
</html>