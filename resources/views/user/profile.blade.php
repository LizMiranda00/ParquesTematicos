<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil de Parque</title>

    <link rel="stylesheet" href="{{ asset('assets/estilosparques.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS para mapas -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
</head>

<body class="content">
    <header>
        <div class="iconos-superior">
            <a href="{{ route('welcome') }}"><img src="{{ asset('imagenes/logotipo.png') }}" alt="Logo" class="logo"></a>

            <a href="{{ $user->location_url }}" target="_blank" class="icon-ubicacion">
                <img src="{{ asset('imagenes/ubicacion.png') }}" alt="Ubicación" />
                <span>Ubicación</span>
            </a>
            <a href="#" class="icon-text" data-bs-toggle="modal" data-bs-target="#entryModal">
                <img src="{{ asset('imagenes/billete-de-banco.png') }}" alt="Entradas" />
                <span>Entradas</span>
            </a>
            <a href="#" class="icon-text" data-bs-toggle="modal" data-bs-target="#transModal">
                <img src="{{ asset('imagenes/taxi.png') }}" alt="Transporte" />
                <span>Transporte</span>
            </a>
            <a href="#" class="icon-text" data-bs-toggle="modal" data-bs-target="#hospModal">
                <img src="{{ asset('imagenes/alojamiento.png') }}" alt="Hospedaje" />
                <span>Hospedaje</span>
            </a>
        </div>
    </header>

    <div class="profile-content">
        <h1 class="welcome">Bienvenido a {{ $user->name }}</h1>
        <a href="{{ route('user.edit', $user->id) }}" class="editarPerfil">Editar Perfil</a>
<form action="{{ route('ratings.store', $user->id) }}" method="POST">
    @csrf
    <button type="submit" class="editarPerfil">Enviar calificación</button>
        <div class="rating">
        <input type="radio" name="rating" value="5" id="5" required><label for="5">★</label>
        <input type="radio" name="rating" value="4" id="4"><label for="4">★</label>
        <input type="radio" name="rating" value="3" id="3"><label for="3">★</label>
        <input type="radio" name="rating" value="2" id="2"><label for="2">★</label>
        <input type="radio" name="rating" value="1" id="1"><label for="1">★</label>
    </div>
    
</form>
        <h3>Imágenes</h3>
        @foreach($user->parqueImages as $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Imagen adicional" class="imagen">
        @endforeach

        <h3>Videos</h3>
        @foreach($user->parqueVideos as $video)
            <video width="320" height="240" controls>
                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                Tu navegador no soporta la reproducción de video.
            </video>
        @endforeach
    </div>



 
    <!-- Modal entradas -->
    <div class="modal fade" id="entryModal" tabindex="-1" aria-labelledby="entryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entryModalLabel">Costo de Entradas y Horarios de Atención</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Costo de entradas:</strong> {{ $user->entry_cost }}</p>
                    <p><strong>Horarios de atención:</strong> {{ $user->opening_hours }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="editarPerfil" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal transporte -->
    <div class="modal fade" id="transModal" tabindex="-1" aria-labelledby="transModallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transModallLabel">Líneas de Transporte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>COCHABAMBA:</strong> {{ $user->transport_cbba }}</p>
                    <p><strong>VILLA TUNARI:</strong> {{ $user->transport_vt }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="editarPerfil" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal hospedaje -->
    <div class="modal fade" id="hospModal" tabindex="-1" aria-labelledby="hospModallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hospModallLabel">Hospedajes cercanos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ $user->lodgings }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="editarPerfil" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (necesario para los modales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Leaflet JS para mapas -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
</html>
