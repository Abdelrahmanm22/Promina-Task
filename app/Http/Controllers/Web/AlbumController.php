<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use App\Models\Picture;
use App\Trait\AttachmentTrait;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    use AttachmentTrait;
    //
    public function index()
    {
        $albums = Album::with('pictures')->get();
        return view('albums.index',compact('albums'));
    }

    public function store()
    {
        return view('albums.create');
    }
    public function create(AddAlbumRequest $request)
    {


        $album = Album::create([
           'name'=>$request->name,
        ]);
        // Handle the uploaded images
        if($request->hasFile('images')) {
            foreach($request->file('images') as $file) {
                $pic_name = $this->saveAttach($file,'images/');
                Picture::create([
                   'name'=>$pic_name,
                   'album_id'=>$album->id,
                ]);
            }
        }
        return redirect()->route('album.index')->with('success', 'Created Album Successfully');
    }

    public function edit($id)
    {
        $album = Album::with('pictures')->findOrFail($id);
        return view('albums.update', compact('album'));
    }

    public function update(UpdateAlbumRequest $request,$id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);
        $album = Album::findOrFail($id);
        $album->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('album.index')->with('success', 'Updated Album Successfully');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        return redirect()->route('album.index')->with('success', 'Deleted Album Successfully');
    }


}
