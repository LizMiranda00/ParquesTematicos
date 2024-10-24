<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parques Recomendados</title>
    <link rel="stylesheet" href="{{ asset('assets/estiloshome.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="d-flex justify-content-between align-items-center p-3">
        <a href="{{ route('welcome') }}"><img src="{{ asset('imagenes/logotipo.png') }}" alt="Logo" class="logo"></a>
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="custom-btn">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="custom-btn">Iniciar sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="custom-btn">Registrarse</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <main class="imagen-fondo">
        <section class="recommended-parks"> <br>
            <div class="table-container">
                <div class="table-responsive scrollable-table">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Parque temático</th>
                                <th>Calificación promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users->isNotEmpty())
                                @foreach($users as $user)
                                    <tr>
                                        <td><a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a></td>
                                        <td>
                                            @if($user->ratings_avg_rating !== null)
                                                {{ number_format($user->ratings_avg_rating, 1) }}
                                            @else
                                                Sin calificación
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No hay parques recomendados disponibles.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </main>
</body>
</html>
