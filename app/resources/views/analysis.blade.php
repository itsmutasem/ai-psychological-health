<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grayscale palette · Health dashboard</title>
    <!-- Tailwind + Alpine (same as base) -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* NEW color palette from image:
           700 → #4D4D4D
           800 → #333333
           900 → #1A1A1A
           950 → #121212
        */
        body {
            background-color: #000000;  /* 950 */
            background-image:
                radial-gradient(at 29% 12%, #1A1A1A 0%, transparent 60%),    /* 900 */
                radial-gradient(at 58% 18%, #020202 0%, transparent 50%),    /* 800 */
                radial-gradient(at 31% 39%, #000000 0%, transparent 40%),    /* 700 */
                radial-gradient(at 66% 98%, #1A1A1A 0%, transparent 30%);
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* cards now use the gray shades – background 900 with subtle 700 border */
        .metric-card {
            background: #1A1A1A;           /* 900 – base card */
            border: 1px solid #000000;      /* 700 border */
            transition: transform 0.2s ease, border-color 0.2s, background 0.2s;
        }
        .metric-card:hover {
            border-color: #CCCCCC;           /* light gray for highlight */
            background: #242424;              /* slight lift */
            transform: translateY(-2px);
        }

        /* the two big numbers in image are clean and bold – keep same */
        .budget-figure {
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        /* category label exactly as png: subtle uppercase – updated to light gray */
        .category-label {
            color: #B0B0B0;                   /* soft gray for readability */
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* small gray note – use #4D4D4D for subtle */
        .footnote-amount {
            color: #A0A0A0;                   /* lighter than 700 but readable */
            font-size: 0.95rem;
            font-weight: 500;
        }

        [x-cloak] { display: none !important; }

        /* custom progress bar background – using 800 (333333) for track */
        .progress-bg {
            background-color: #333333;        /* 800 */
        }

        /* keep red / yellow badges but background adapts to dark */
        .badge-high {
            background-color: rgba(180, 60, 60, 0.2);  /* dark red tone */
            color: #ff8a8a;
        }
        .badge-moderate {
            background-color: rgba(180, 150, 40, 0.2); /* dark gold */
            color: #f7d44a;
        }
    </style>
</head>
<body class="min-h-screen text-white flex items-center justify-center p-4">

<div class="w-full max-w-5xl" x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)">

    <!-- main container -->
    <div x-cloak
         x-show="show"
         x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="space-y-8"
    >

        <!-- TOP TITLE: keep psychological analysis but adapt gradient to grayscale -->
        <div class="pb-2 flex justify-between items-end">
            <h1 class="text-4xl md:text-5xl font-light tracking-tight">Psychological<br><span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-300 to-gray-400">Health Analysis</span></h1>
        </div>

        <!-- HEALTH METRICS SECTION – same layout, colors replaced with grays -->
        <div class="mt-10 pt-4 border-t border-[#4D4D4D]">   <!-- border 700 -->
            <h2 class="text-2xl font-semibold mb-5 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-gray-400"></span> Health Metrics
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Health Index -->
                <div class="metric-card p-5 rounded-xl">
                    <h3 class="font-semibold mb-2 text-gray-300">Health Index</h3>
                    <p class="text-4xl font-bold text-white">74<span class="text-lg text-gray-400 font-light">/100</span></p>
                </div>

                <!-- Depression Risk (HIGH) – using custom badge class -->
                <div class="metric-card p-5 rounded-xl">
                    <h3 class="font-semibold mb-2 flex justify-between items-center">
                        <span class="text-gray-200">Depression Risk</span>
                        <span class="text-sm font-medium px-2 py-0.5 rounded badge-high">HIGH</span>
                    </h3>
                    <div class="w-full progress-bg rounded-full h-4 mb-2 overflow-hidden">
                        <div class="h-4 rounded-full bg-red-500 transition-all" style="width: 82%"></div>
                    </div>
                    <p class="text-lg font-bold">82<span class="text-sm text-gray-400">/100</span></p>
                </div>

                <!-- Anxiety Risk (HIGH) -->
                <div class="metric-card p-5 rounded-xl">
                    <h3 class="font-semibold mb-2 flex justify-between items-center">
                        <span class="text-gray-200">Anxiety Risk</span>
                        <span class="text-sm font-medium px-2 py-0.5 rounded badge-high">HIGH</span>
                    </h3>
                    <div class="w-full progress-bg rounded-full h-4 mb-2 overflow-hidden">
                        <div class="h-4 rounded-full bg-red-500 transition-all" style="width: 79%"></div>
                    </div>
                    <p class="text-lg font-bold">79<span class="text-sm text-gray-400">/100</span></p>
                </div>

                <!-- Stress Level (MODERATE) -->
                <div class="metric-card p-5 rounded-xl">
                    <h3 class="font-semibold mb-2 flex justify-between items-center">
                        <span class="text-gray-200">Stress Level</span>
                        <span class="text-sm font-medium px-2 py-0.5 rounded badge-moderate">MODERATE</span>
                    </h3>
                    <div class="w-full progress-bg rounded-full h-4 mb-2 overflow-hidden">
                        <div class="h-4 rounded-full bg-yellow-500 transition-all" style="width: 63%"></div>
                    </div>
                    <p class="text-lg font-bold">63<span class="text-sm text-gray-400">/100</span></p>
                </div>

                <!-- Social Isolation (HIGH) -->
                <div class="metric-card p-5 rounded-xl">
                    <h3 class="font-semibold mb-2 flex justify-between items-center">
                        <span class="text-gray-200">Social Isolation</span>
                        <span class="text-sm font-medium px-2 py-0.5 rounded badge-high">HIGH</span>
                    </h3>
                    <div class="w-full progress-bg rounded-full h-4 mb-2 overflow-hidden">
                        <div class="h-4 rounded-full bg-red-500 transition-all" style="width: 71%"></div>
                    </div>
                    <p class="text-lg font-bold">71<span class="text-sm text-gray-400">/100</span></p>
                </div>

                <!-- Self-Esteem Issues (MODERATE) -->
                <div class="metric-card p-5 rounded-xl">
                    <h3 class="font-semibold mb-2 flex justify-between items-center">
                        <span class="text-gray-200">Self-Esteem Issues</span>
                        <span class="text-sm font-medium px-2 py-0.5 rounded badge-moderate">MODERATE</span>
                    </h3>
                    <div class="w-full progress-bg rounded-full h-4 mb-2 overflow-hidden">
                        <div class="h-4 rounded-full bg-yellow-500 transition-all" style="width: 54%"></div>
                    </div>
                    <p class="text-lg font-bold">54<span class="text-sm text-gray-400">/100</span></p>
                </div>

                <!-- Emotional Instability (MODERATE) -->
                <div class="metric-card p-5 rounded-xl">
                    <h3 class="font-semibold mb-2 flex justify-between items-center">
                        <span class="text-gray-200">Emotional Instability</span>
                        <span class="text-sm font-medium px-2 py-0.5 rounded badge-moderate">MODERATE</span>
                    </h3>
                    <div class="w-full progress-bg rounded-full h-4 mb-2 overflow-hidden">
                        <div class="h-4 rounded-full bg-yellow-500 transition-all" style="width: 48%"></div>
                    </div>
                    <p class="text-lg font-bold">48<span class="text-sm text-gray-400">/100</span></p>
                </div>

                <!-- (optional) eighth card removed to keep exact count, but we can add a subtle placeholder? no, keep exactly 7 as original -->
            </div>
        </div>

        <!-- subtle footer line – uses 700 border and 800 text -->
        <div class="flex justify-end mt-6 text-sm border-t border-[#4D4D4D] pt-3 text-[#B0B0B0]">
        </div>

    </div> <!-- end x-show -->
</div> <!-- container -->
</body>
</html>
