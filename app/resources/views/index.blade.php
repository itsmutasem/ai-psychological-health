<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body {
            background-color: #000000;
            background-image: radial-gradient(at 29% 12%, #000000 0%, transparent 60%), radial-gradient(at 58% 18%, #000924 0%, transparent 50%), radial-gradient(at 31% 39%, #0d357d 0%, transparent 40%), radial-gradient(at 66% 98%, #2b315e 0%, transparent 30%);
        }
    </style>
</head>
<body class="min-h-screen">
{{-- The container --}}
<div class="relative z-10 text-center flex items-center justify-center min-h-screen">
    {{--    Alpine JS --}}
    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">

        <div x-cloak
             x-show="show"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="text-6xl ">
                <h1 class="text-white">Psychological Health</h1>
            </div>
        </div>

        <div x-cloak
             x-show="show"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100">

            <form
                method="POST"
                action="/analyze"
                x-data="{ username: '' }"
                @submit="if(username.trim() === '') $event.preventDefault()"
                class="relative w-96 mx-auto mt-8"
            >
                @csrf
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-white/60 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 mr-1"
                         fill="currentColor"
                         viewBox="0 0 24 24">
                        <path d="M22.46 6c-.77.35-1.5.58-2.25.69a3.92 3.92 0 0 0 1.7-2.16 7.72 7.72 0 0 1-2.48.95A3.88 3.88 0 0 0 12 8.09c0 .3.03.6.1.88A11 11 0 0 1 3.15 4.6a3.9 3.9 0 0 0 1.2 5.2 3.7 3.7 0 0 1-1.76-.5v.05c0 1.9 1.34 3.5 3.12 3.85-.33.09-.68.14-1.03.14-.25 0-.5-.02-.73-.07a3.9 3.9 0 0 0 3.63 2.7A7.78 7.78 0 0 1 2 18.58a11 11 0 0 0 6 1.76c7.2 0 11.15-6 11.15-11.2v-.5A7.9 7.9 0 0 0 22.46 6z"/>
                    </svg>
                    <span>@</span>
                </div>
                <input
                    type="text"
                    name="username"
                    x-model="username"
                    @input="username = username.replace('@','')"
                    @keydown.enter.prevent="$el.form.requestSubmit()"
                    placeholder="username"
                    class="bg-white/10 pl-14 pr-12 py-2 rounded-full w-full text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/20"
                >
                <button
                    type="submit"
                    :disabled="username.trim() === ''"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 transition"
                    :class="username.trim() === ''
                ? 'text-white/30 cursor-not-allowed'
                : 'text-white hover:scale-110'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7M16 12H3"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
