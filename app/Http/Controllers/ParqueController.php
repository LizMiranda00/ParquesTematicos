<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parque;
use App\Models\ParqueImage;
use App\Models\ParqueVideo;

class ParqueController extends Controller
{
    public function show($id)
    {
        // Buscar el parque por su ID
        $parque = Parque::findOrFail($id);
        
        if (auth()->id() !== $parque->user_id) { // Aquí verificas que el parque pertenece al usuario autenticado
            return redirect('/')->with('error', 'No tienes acceso a esta página.');
        }

        // Retornar la vista del parque
        return view('user.show', compact('parque'));
    }

    public function edit($id)
    {
        // Buscar el parque por su ID
        $parque = Parque::findOrFail($id);
        
        // Verificar que el parque pertenece al usuario autenticado
        if (auth()->id() !== $parque->user_id) {
            return redirect('/')->with('error', 'No tienes acceso a esta página.');
        }

        // Retornar la vista de edición del parque
        return view('user.edit', compact('parque'));
    }

    public function update(Request $request, $id)
    {
        // Buscar el parque por su ID
        $parque = Parque::findOrFail($id);

        // Validar la solicitud
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        // Guardar la imagen si se ha subido
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('parque_images', 'public');
            ParqueImage::create([
                'parque_id' => $parque->id,
                'image_path' => $imagePath,
            ]);
        }

        // Guardar el video si se ha subido
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('parque_videos', 'public');
            ParqueVideo::create([
                'parque_id' => $parque->id,
                'video_path' => $videoPath,
            ]);
        }

        // Redirigir a la página de detalles del parque con un mensaje de éxito
        return redirect()->route('parque.show', $parque->id)->with('success', 'Contenido actualizado correctamente.');
    }
}
