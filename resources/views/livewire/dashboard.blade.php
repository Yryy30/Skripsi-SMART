<div>
    <div class="grid gap-4 md:grid-cols-4">
            <!-- Pie Chart - Jenis Kelamin -->
            <div class="col-span-4 md:col-span-1 h-[250px] relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @if($hasGenderData)
                    <div id="genderChart" wire:ignore></div>
                @else
                    <x-empty-state icon="users" message="Belum ada data balita" />
                @endif
            </div>

            <!-- Line Chart - Stunting -->
            <div class="col-span-4 md:col-span-3 relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @if($hasStuntingData)
                    <div id="stuntingChart" wire:ignore></div>
                @else
                    <x-empty-state icon="chart-line" message="Belum ada data pengukuran" />
                @endif
            </div>
        </div>

    @script
    <script>
        let genderChart = null;
        let stuntingChart = null;

        function isDarkMode() {
            return document.documentElement.classList.contains('dark') || 
                   document.body.classList.contains('dark') ||
                   (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
        }

        function getChartTheme() {
            const dark = isDarkMode();
            return {
                mode: dark ? 'dark' : 'light',
                palette: dark ? 'palette4' : 'palette1',
                monochrome: {
                    enabled: false
                }
            };
        }

        function getCommonOptions() {
            const dark = isDarkMode();
            return {
                chart: {
                    background: 'transparent',
                    foreColor: dark ? '#d1d5db' : '#374151',
                    fontFamily: 'Inter, sans-serif'
                },
                tooltip: {
                    theme: dark ? 'dark' : 'light'
                },
                legend: {
                    labels: {
                        colors: dark ? '#d1d5db' : '#374151'
                    }
                },
                grid: {
                    borderColor: dark ? '#374151' : '#e5e7eb'
                }
            };
        }

        function initCharts() {
            // Destroy existing charts
            if (genderChart) genderChart.destroy();
            if (stuntingChart) stuntingChart.destroy();

            const commonOptions = getCommonOptions();
            const theme = getChartTheme();

            const genderEl   = document.querySelector("#genderChart");
            const stuntingEl = document.querySelector("#stuntingChart");

            // Pie Chart - Jenis Kelamin
            const genderOptions = {
                series: @json($genderData),
                chart: {
                    type: 'pie',
                    height: 250,
                    toolbar: {
                        show: true
                    },
                    ...commonOptions.chart
                },
                labels: @json($genderLabels),
                colors: ['#3b82f6', '#ec4899'],
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '14px',
                    ...commonOptions.legend
                },
                theme: theme,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                dataLabels: {
                    enabled: true,
                    formatter: function (val, opts) {
                        return opts.w.config.series[opts.seriesIndex]
                    },
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold',
                        colors: ['#fff']
                    }
                },
                tooltip: {
                    ...commonOptions.tooltip,
                    y: {
                        formatter: function(value) {
                            return value + " balita"
                        }
                    }
                }
            };

            if (genderEl) {
                genderChart = new ApexCharts(genderEl, genderOptions);
                genderChart.render();
            }

            // Line Chart - Resiko Stunting Tinggi
            const maxValue = Math.max(...@json($stuntingData));
            const stuntingOptions = {
                series: [{
                    name: 'Resiko Tinggi',
                    data: @json($stuntingData)
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    },
                    ...commonOptions.chart
                },
                theme: theme,
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#f59e0b'],
                markers: {
                    size: 5,
                    colors: ['#f59e0b'],
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                xaxis: {
                    categories: @json($stuntingLabels),
                    labels: {
                        rotate: -45,
                        rotateAlways: true,
                        style: {
                            fontSize: '12px',
                            colors: isDarkMode() ? '#d1d5db' : '#374151'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Balita',
                        style: {
                            fontSize: '14px',
                            color: isDarkMode() ? '#d1d5db' : '#374151'
                        }
                    },
                    min: 0,
                    max: maxValue,
                    tickAmount: maxValue,
                    forceNiceScale: true,
                    labels: {
                        formatter: val => val.toFixed(0)
                    }
                },
                grid: commonOptions.grid,
                tooltip: {
                    ...commonOptions.tooltip,
                    y: {
                        formatter: function(value) {
                            return value + " balita beresiko tinggi"
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                }
            };

            if (stuntingEl) {
                stuntingChart = new ApexCharts(stuntingEl, stuntingOptions);
                stuntingChart.render();
            }
        }

        // Initialize charts on component load
        initCharts();

        // Re-initialize charts when Livewire updates
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (component.name === 'dashboard') {
                initCharts();
            }
        });

        // Listen for dark mode changes
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    initCharts();
                }
            });
        });

        observer.observe(document.documentElement, {
            attributes: true
        });

        // Also listen to body class changes (some frameworks use body)
        observer.observe(document.body, {
            attributes: true
        });

        // Listen to system dark mode preference changes
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                initCharts();
            });
        }
    </script>
    @endscript
</div>
