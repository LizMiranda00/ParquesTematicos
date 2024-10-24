<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir contenido para el parque {{ $user->nombre }}</title>
    <link rel="stylesheet" href="{{ asset('assets/estiloseditarP.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="contenedor">
    <div class="container">
        <h1>Subir contenido para el parque {{ $user->nombre }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Sección para subir imágenes -->
            <div class="form-group">
                <label class="texti" for="images">Subir Imágenes</label> <br>
                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
            </div>

            <!-- Sección para subir videos -->
            <div class="form-group">
                <label class="texti" for="videos">Subir Videos</label> <br>
                <input type="file" class="form-control-file" id="videos" name="videos[]" multiple>
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>

        <h3>Imágenes Existentes</h3>
        @if($user->parqueImages->isEmpty())
            <p>No hay imágenes disponibles.</p>
        @else
            @foreach($user->parqueImages as $image)
                <div class="image-item">
                    <img width="320" height="240" src="{{ asset('storage/' . $image->image_path) }}" alt="Imagen adicional" class="imagen">
                    <form action="{{ route('user.deleteImage', [$user->id, $image->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            @endforeach
        @endif

        <h3>Videos Existentes</h3>
        @if($user->parqueVideos->isEmpty())
            <p>No hay videos disponibles.</p>
        @else
            @foreach($user->parqueVideos as $video)
                <div class="video-item">
                    <video width="320" height="240" controls>
                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                        Tu navegador no soporta la reproducción de video.
                    </video>
                    <form action="{{ route('user.deleteVideo', [$user->id, $video->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
