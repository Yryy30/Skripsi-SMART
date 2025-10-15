<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:callout icon="sparkles" color="purple">
            <flux:callout.heading>Hallo!</flux:callout.heading>

            <flux:callout.text>
                Selamat datang di dashboard aplikasi <strong>Stunting</strong>. 
                Di sini Anda dapat melihat ringkasan data terkait stunting, termasuk jumlah balita, data altarnatif, dan grafik perkembangan stunting.
            </flux:callout.text>
        </flux:callout>

        <div class="grid gap-4 md:grid-cols-4">
            <!-- 1/4 Bagian -->
            <div class="col-span-4 md:col-span-1 h-[250px] relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <canvas id="balitaChart"></canvas>
            </div>

            <!-- 3/4 Bagian -->
            <div class="col-span-4 md:col-span-3 relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <canvas id="resikoChart"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('balitaChart').getContext('2d');
        const balitaChart = new Chart(ctx, {
            type: 'doughnut', // ubah ke 'pie' jika ingin pie chart
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($data),
                    backgroundColor: ['#0e0afc', '#fc035a'],
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Balita (Laki-laki vs Perempuan)'
                    }
                }
            }
        });
    </script>
    <script>
        const riskData = @json($chartData);    
        const labels = riskData.map(item => item.tanggal);
        const dataValues = riskData.map(item => item.jumlah_tinggi);
    
        const data = {
            labels: labels,
            datasets: [{
                label: 'Risiko Stunting Tinggi',
                data: dataValues,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
    
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    title: {
                        display: true,
                        text: 'Tren Risiko Stunting Tinggi'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,       // Naik 1 per grid
                            precision: 0       // Tanpa angka desimal
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Balita'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal Pengukuran'
                        }
                    }
                }
            }
        };
    
        const ctx2 = document.getElementById('resikoChart').getContext('2d');
        new Chart(ctx2, config);
        console.log(riskData);
    </script>
    
</x-layouts.app>
