<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data   = ['title' => 'Item', 'subtitle' => 'List of Item'];
        $items  = Item::all();
        return view('database.item.index', compact('data', 'items'));
    }

    public function create()
    {
        $data           = ['title' => 'Item', 'subtitle' => 'Create New Item'];
        $form           = ['url' => route('items.store'), 'method' => 'POST', 'back' => route('items.index')];
        $categories     = DB::table('items')->select('item_category')->distinct()->get();
        return view('database.item.create', compact('data', 'form', 'categories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_code' => 'required|string|max:20',
            'item_name' => 'required|string|max:50',
            'item_category' => 'required|string|max:50',
        ]);

        Item::create([
            'item_code' => $validatedData['item_code'],
            'item_name' => $validatedData['item_name'],
            'item_category' => $validatedData['item_category'],
            'status' => $request->input('status') == 'Active' ? 1 : 0
        ]);

        return redirect()->route('items.index')->with('success', 'New Item created successfully.');
    }
    public function edit($id)
    {
        $data = ['title' => 'Item', 'subtitle' => 'Edit Item'];
        $form = ['url' => route('items.update', $id), 'method' => 'PUT', 'back' => route('items.index')];
        $categories = DB::table('items')->select('item_category')->distinct()->get();
        $item = Item::findOrFail($id);
        return view('database.item.edit', compact('data', 'form', 'categories', 'item'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'item_code' => 'required|string|max:20',
            'item_name' => 'required|string|max:50',
            'item_category' => 'required|string|max:50',
            'status' => 'required|string|in:Active,Deactive',
        ]);

        $item = Item::findOrFail($id);
        $item->update([
            'item_code' => $validatedData['item_code'],
            'item_name' => $validatedData['item_name'],
            'item_category' => $validatedData['item_category'],
            'status' => $validatedData['status']
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }
    public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('items.index')->with('error', 'Error deleting item: ' . $e->getMessage());
        }
    }
    public function changeStatus($id)
    {
        $item = Item::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item status updated successfully.');
    }
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('database.item.show', compact('item'));
    }
    public function change_is_show($id)
    {
        $item = Item::findOrFail($id);
        $item->is_show = !$item->is_show;
        $item->save();

        return redirect()->route('items.index')->with('success', 'Item visibility updated successfully.');
    }
}
