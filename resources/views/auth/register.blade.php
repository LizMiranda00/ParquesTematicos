<!doctype html>
<html lang="en">
    <head>
        <title>REGISTRO</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

      
        <link rel="stylesheet" href="{{ asset ('assets/estilosRegister.css')}}">
    </head>

    <body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="mb-5">CREAR CUENTA</h4>
                </div>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="form-label" for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar nombre de usuario" required/>
                    </div>

                    <div>
                        <label class="form-label" for="email">Correo</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ingresar correo" required/>
                    </div>
<div>
    <label class="form-label" for="password">Contraseña</label>
    <div class="password-container">
        <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa una contraseña segura " required />
        <span class="toggle-password" onclick="togglePassword('password')">
            <img src="{{ asset('imagenes/cerrado.png') }}" alt="Mostrar contraseña" id="eye-icon-password" />
        </span>
    </div>
</div>

<div>
    <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
    <div class="password-container">
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Las contraseñas deben coincidir" required/>
        <span class="toggle-password" onclick="togglePassword('password_confirmation')">
            <img src="{{ asset('imagenes/cerrado.png') }}" alt="Mostrar contraseña" id="eye-icon-password_confirmation" />
        </span>
    </div>
</div>

                    <div>
                        <label class="form-label" for="profile_image">Imagen de perfil</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*" required/>
                    </div>

                    <div>
                        <label class="form-label" for="entry_cost">Costo de entradas</label>
                        <input type="text" name="entry_cost" id="entry_cost" class="form-control" placeholder="Ejemplo: Niños: 15 bs, Adultos: 25 bs" required />
                    </div>

                    <div>
                        <label class="form-label" for="opening_hours">Horarios de atención</label>
                        <input type="text" name="opening_hours" id="opening_hours" class="form-control" placeholder="Ejemplo: Lunes - viernes: 09 am - 06 pm" required />
                    </div>

                    <div>
                        <label class="form-label" for="transport_cbba">Lineas de transporte Villa Tunari</label>
                        <input type="text" name="transport_cbba" id="transport_cbba" class="form-control" placeholder="Ejemplo: Trans. 14 de sept." required />
                    </div>

                    <div>
                        <label class="form-label" for="transport_vt">Lineas de transporte Cochabamba (Parada Oquendo)</label>
                        <input type="text" name="transport_vt" id="transport_vt" class="form-control" placeholder="Ejemplo: Trans. Yungas" required />
                    </div>

                    <div>
                        <label class="form-label" for="lodgings">Hospedajes cercanos</label>
                        <input type="text" name="lodgings" id="lodgings" class="form-control" placeholder="Ejemplo: Alojamiento totora" required />
                    </div>

                    <div>
                        <label class="form-label" for="location_url">Enlace de Ubicación</label>
                        <input type="url" class="form-control" id="location_url" name="location_url" placeholder="https://maps.google.com/?q=latitude,longitude" required />
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="custom-btn">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <p><strong>¿Ya tienes una cuenta?</strong></p>
            <a href="{{ route('login') }}" class="custom-btn">Login</a>
        </div>
    </div>

    <script>
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const nameInput = document.getElementById('name');

            // Validar nombre sin números, caracteres especiales, ni espacios
            function validateName() {
                const name = nameInput.value;
                const namePattern = /^[a-zA-ZÀ-ÿ]+$/; // Solo letras (incluyendo acentuadas), sin espacios

                if (!namePattern.test(name)) {
                    alert('El nombre solo debe contener letras, sin números, caracteres especiales ni espacios.');
                    return false;
                }

                return true;
            }

            // Validar contraseña
            function validatePassword() {
                const password = passwordInput.value;
                const passwordConfirmation = passwordConfirmationInput.value;

                // Expresión regular para validar: al menos una minúscula, una mayúscula, un carácter especial, exactamente 8 caracteres
                const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8}$/;

                if (!passwordPattern.test(password)) {
                    alert('La contraseña debe tener exactamente 8 caracteres, incluir mayúsculas, minúsculas, un número y al menos un carácter especial.');
                    return false;
                }

                if (password !== passwordConfirmation) {
                    alert('Las contraseñas no coinciden.');
                    return false;
                }

                return true;
            }
            
            function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const eyeIcon = document.getElementById('eye-icon-' + fieldId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.src = "{{ asset('imagenes/abierto.png') }}"; // Cambiar a un ícono de "ojo abierto"
    } else {
        passwordInput.type = 'password';
        eyeIcon.src = "{{ asset('imagenes/cerrado.png') }}"; // Cambiar a un ícono de "ojo cerrado"
    }
}


            // Verificar ambas validaciones al enviar el formulario
            document.querySelector('form').addEventListener('submit', function(event) {
                if (!validateName() || !validatePassword()) {
                    event.preventDefault(); // Evita el envío del formulario si alguna validación falla
                }
            });
        </script>
</body>
</html>
