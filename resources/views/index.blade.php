<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>時間割アプリ</title>
        <meta name="description" content="時間割を作成するアプリです">
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" cotent="width=device-width, initial-scale=1.0">
    </head>
    <body class="antialiased">
        <header>
            <nav>
                <a href="{{ route('index') }}">時間割作成アプリ</a>
            </nav>
            <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>            
            </header>
        <main>
            <article>
                <h1>鹿児島大学法文学部・法経社会学科のための時間割</h1>
                <button >
                    <a href="{{ route('classdata.read') }}">時間割を作る</a>
                </button>
               
            </article>
        </main>
        <footer>&copy;Shoma Tone. All right reserved.</footer>
    </body>
</html>