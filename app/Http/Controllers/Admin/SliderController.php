<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->summary = $request->summary;

        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/sliders'), $filename);
            $slider->image = $filename;
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success','Slider created!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->summary = $request->summary;

        if ($request->hasFile('image')) {
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/sliders'), $filename);
            $slider->image = $filename;
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success','Slider updated!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success','Slider deleted!');
    }
}
