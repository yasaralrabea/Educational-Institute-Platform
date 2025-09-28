<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lighting;

class LightingController extends Controller
{
    public function index()
    {
        $lighting=Lighting::all();
        return view('lightings',compact('lighting'));
    }

     public function index_to_student()
    {
        $lighting=Lighting::where('condition','yes')->get();
        return view('lightings_s',compact('lighting'));
    }

   public function store(Request $request)
{
    $request->validate([
        'condition' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:255',
        'lighting' => 'nullable|string|max:255',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // تحقق من نوع وحجم الصورة
    ]);

     $path = null;

    // رفع الصورة وتخزينها في public/images
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $filename, 'public'); // يخزن في storage/app/public/images
    }

    Lighting::create([
        'condition' => $request->condition,
        'lighting' => $request->lighting,
        'subject' => $request->subject,
        'photo' => '/storage/' . $path, // رابط الوصول للصورة
    ]);

    return redirect()->route('lighting.index')->with('success','تمت إضافة الإضاءة بنجاح');
}


   public function update(Request $request, $id)
{
    $light = Lighting::findOrFail($id);

    $request->validate([
        'lighting'  => 'nullable|string|max:255',
        'subject'   => 'nullable|string|max:255',
        'condition' => 'nullable|string|max:255',
        'photo'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $light->lighting  = $request->lighting;
    $light->subject   = $request->subject;
    $light->condition = $request->condition;

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('images', 'public');
        $light->photo = 'storage/'.$path;
    }

    $light->save();

    return redirect()->route('lighting.index')->with('success', 'تم تعديل الإضاءة بنجاح');
}


     public function destroy( $id)
    {
        $lighting=Lighting::find($id);
       
        $lighting->delete();
        return redirect()->route('lighting.index')->with('success','تمت تعديل الإضاءة بنجاح');

    }
}
