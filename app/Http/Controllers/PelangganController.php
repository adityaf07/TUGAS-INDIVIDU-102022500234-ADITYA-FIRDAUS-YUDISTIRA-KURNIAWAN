<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Gate;

class PelangganController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Pelanggan::class);
        $pelanggan = Pelanggan::all();
        return view('Pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        Gate::authorize('create', Pelanggan::class);
        return view('Pelanggan.form');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Pelanggan::class);
        // ... simpan data
    }

    public function edit(Pelanggan $pelanggan)
    {
        Gate::authorize('update', $pelanggan);
        return view('Pelanggan.form', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        Gate::authorize('update', $pelanggan);
        // ... update data
    }

    public function destroy(Pelanggan $pelanggan)
    {
        Gate::authorize('delete', $pelanggan);
        $pelanggan->delete();
        return redirect()->route('pelanggan.index');
    }
}

