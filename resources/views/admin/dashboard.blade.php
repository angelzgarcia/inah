

<x-admin-main title="Dashboard | INAH">

    <h1 class="text-center text-3xl pb-3 tracking-widest font-bold h1u shadow">
        <x-strong>DASHBOARD</x-strong>
    </h1>

    <section class="dashboard-container">

        <div>
            <canvas id="line"></canvas>
        </div>

        <div>
            <canvas id="polarArea"></canvas>
        </div>

        <div>
            <canvas id="doughnut"></canvas>
        </div>

        <div>
            <canvas id="barChart"></canvas>
        </div>

    </section>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const barChart = document.getElementById('barChart');
            const doughnut = document.getElementById('doughnut');
            const line = document.getElementById('line');
            const polarArea = document.getElementById('polarArea');

            new Chart(barChart, {
                type: 'bar',
                data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });

            new Chart(doughnut, {
                type: 'line',
                data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });

            new Chart(line, {
                type: 'doughnut',
                data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });

            new Chart(polarArea, {
                type: 'polarArea',
                data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });

        </script>
    @endpush

</x-admin-main>
