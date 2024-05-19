<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function delete($id)
    {

        $picture = Picture::findOrFail($id);
        $picturePath = public_path('images/' . $picture->name);
        if (file_exists($picturePath)) {
            unlink($picturePath);
        }
        $picture->delete();
        return back()->with('success', 'Picture deleted successfully');
    }

    public function deleteAllPictures($id)
    {
        $album = Album::with('pictures')->findOrFail($id);

        foreach ($album->pictures as $picture) {
            $picturePath = public_path('images/' . $picture->name);
            if (file_exists($picturePath)) {
                unlink($picturePath);
            }
            $picture->delete();
        }

        $album->delete();

        return redirect()->route('album.index')->with('success', 'Deleted all pictures in the album successfully');
    }

    public function movePictures(Request $request, $id)
    {
        $request->validate([
            'target_album_id' => 'required|exists:albums,id',
        ]);

        $album = Album::with('pictures')->findOrFail($id);
        $targetAlbum = Album::findOrFail($request->target_album_id);

        foreach ($album->pictures as $picture) {
            $picture->album_id = $targetAlbum->id;
            $picture->save();
        }
        $album->delete();

        return redirect()->route('album.index')->with('success', 'Moved all pictures to another album successfully');
    }
}
