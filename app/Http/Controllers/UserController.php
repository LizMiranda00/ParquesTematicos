<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\ParqueImage; // Asegúrate de importar el modelo
use App\Models\ParqueVideo; // Asegúrate de importar el modelo
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
       // Encuentra al usuario por ID, o lanza una excepción si no se encuentra
    $user = User::findOrFail($id);
    
    // Solo devolver la vista del perfil del usuario
    return view('user.profile', compact('user'));}

    public function edit($id)
    {
        $user = User::with('parqueImages', 'parqueVideos')->findOrFail($id);

        // Asegura que el usuario solo pueda editar su propio perfil
        if (auth()->id() !== $user->id) {
            return redirect('/')->with('error', 'No tienes acceso a esta página.');
        }

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
     // Asegura que el usuario solo pueda editar su propio perfil
     if (auth()->id() !== $user->id) {
        return redirect('/')->with('error', 'No tienes acceso a esta página.');
    }
        // Validar y actualizar la información del usuario
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
           'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'videos.*' => 'nullable|mimes:mp4,mov,ogg,qt|max:51200', // Máximo de 50MB
        ]);
    
        // Guardar la imagen de perfil si se ha subido
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                \Storage::disk('public')->delete($user->profile_image);
            }
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $profileImagePath;
        }
        $user->email = $request->input('email', $user->email); // Mantiene el email si no se actualiza
        $user->save();
    
        // Guardar imágenes adicionales
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('parque_images', 'public');
           
            \Log::info("Imagen guardada en: $imagePath");
            // Crea un nuevo registro en la tabla parque_images
            ParqueImage::create([
                'user_id' => $user->id, // Relaciona la imagen con el usuario/parque
                'image_path' => $imagePath
            ]);
        }
    }

    // Guardar videos adicionales
    if ($request->hasFile('videos')) {
        foreach ($request->file('videos') as $video) {
            $videoPath = $video->store('parque_videos', 'public');

            \Log::info("Video guardado en: $videoPath");
            // Crea un nuevo registro en la tabla parque_videos
            ParqueVideo::create([
                'user_id' => $user->id, // Relaciona el video con el usuario/parque
                'video_path' => $videoPath
            ]);
        }
    }

    return redirect()->route('user.show', $user->id)->with('success', 'Perfil actualizado correctamente.');
   }

   public function deleteImage($userId, $imageId)
   {
       // Busca la imagen en la base de datos
       $image = ParqueImage::findOrFail($imageId);
   
       // Elimina el archivo del sistema de archivos
       Storage::delete('public/parque_images/' . $image->image_path);
   
       // Elimina el registro de la base de datos
       $image->delete(); 
   
       return redirect()->route('profile', ['id' => $userId])->with('success', 'Imagen eliminada con éxito.');
   }

   public function deleteVideo($userId, $videoId)
   {
        // Encuentra la imagen por ID
    $video = ParqueVideo::findOrFail($videoId);
    // Elimina el archivo del sistema de archivos
    Storage::delete('public/parque_videos/' . $video->video_path);
    // Elimina la imagen de la base de datos
    $video->delete();
    return redirect()->route('profile', ['id' => $userId])->with('success', 'Video eliminado con éxito.');
   }
   
   public function recommendedParks(){
    // Obtener los usuarios (parques) con la calificación promedio y ordenarlos de mayor a menor
    $users = User::withAvg('ratings', 'rating')
    ->withCount('ratings') // Contar la cantidad de calificaciones
    ->orderBy('ratings_avg_rating', 'desc') // Ordenar por calificación promedio
    ->orderBy('ratings_count', 'desc') // Ordenar por cantidad de calificaciones
    ->get();

    return view('recommended_parks', compact('users'));
   }
   

}
