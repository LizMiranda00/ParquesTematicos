<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Parques Tematicos</title>
        <link rel="stylesheet" href="{{ asset ('assets/estiloshome.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="d-flex justify-content-between align-items-center p-3">
            <img src="{{ asset('imagenes/logotipo.png') }}" alt="Logo" class="logo">
             @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                       <button type="submit" class="custom-btn">Cerrar sesion</button>
                                     </form>
                                    @else
                                    <a href="{{ route('login') }}" class="custom-btn">Iniciar sesion</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="custom-btn">Registrarse</a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
        </header>
        <main class="cont">
            <section>
                <img src="{{ asset('imagenes/villatunari.jpg') }}" alt="arco" class="arco">
            </section>
            <section class="bienvenida">
                <p>¡Bienvenidos a Parques Temáticos! <br>
                Aquí encontrarás las guías más completas y todos los consejos para aprovechar al máximo tu visita a Villa Tunari. <br>
                Contamos con una amplia variedad de parques temáticos, tales como Avatar, Dino Kong Park, Yura Ventura, La Jungla y muchos más. <br> 
                ¡Descubre la diversión en cada rincón y vive una experiencia inolvidable!</p>
            </section>
    <section>
    <a href="{{ route('recommended.parks') }}" class="custom-btn">Parques Recomendados</a>
    </section>
            
            <!-- Nueva sección para mostrar usuarios -->
    <section class="users">
    @foreach($users as $user)
        <div class="user">
            <a href="{{ route('user.show', ['id' => $user->id]) }}">
                <h3>{{ $user->name }}</h3>
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}">
            </a>
        </div>
    @endforeach
    </section>
        </main>
    </body>
</html>
