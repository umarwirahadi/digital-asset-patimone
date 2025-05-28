<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data       = ['title' => 'Options', 'subtitle' => 'List of Options'];
        $options    = Option::all();
        return view('database.options.index', compact('data', 'options'));
    }
    public function create()
    {
        $data = ['title' => 'Options', 'subtitle' => 'Create New Option'];
        return view('database.options.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'option_name' => 'required|string|max:255',
            'option_value' => 'required|string',
            'option_type' => 'required|string',
            'option_group' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Option::create($request->all());

        return redirect()->route('options.index')->with('success', 'Option created successfully.');
    }
    public function edit($id)
    {
        $option = Option::findOrFail($id);
        $data = ['title' => 'Options', 'subtitle' => 'Edit Option', 'option' => $option];
        return view('database.options.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'option_name' => 'required|string|max:255',
            'option_value' => 'required|string',
            'option_type' => 'required|string',
            'option_group' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $option = Option::findOrFail($id);
        $option->update($request->all());

        return redirect()->route('options.index')->with('success', 'Option updated successfully.');
    }
    public function destroy($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();

        return redirect()->route('options.index')->with('success', 'Option deleted successfully.');
    }
    
}
