<?php

namespace App\Controllers;

use App\Models\Supplier;

class SupplierController
{
    private Supplier $supplier;

    public function __construct()
    {
        $this->supplier = new Supplier();
    }

    public function index()
    {
        $suppliers = $this->supplier->selectAll();

        return view('supplier/index', ['suppliers' => $suppliers]);
    }

    public function create()
    {
        return view('supplier/create');
    }

    public function store()
    {
        $id = $this->supplier->insert([
            'name' => $_POST['name']
        ]);

        redirect("suppliers/{$id}");
    }

    public function edit(int $id)
    {
        $supplier = $this->supplier->where(['id' => $id])->first();

        return view('supplier/edit', ['supplier' => $supplier]);
    }

    public function update(int $id)
    {
        $this->supplier->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("suppliers/{$id}");
    }

    public function show(int $id)
    {
        $supplier = $this->supplier->where(['id' => $id])->first();

        return view('supplier/show', ['supplier' => $supplier]);
    }

    public function delete(int $id)
    {
        $this->supplier->where(['id' => $id])->delete();

        redirect("suppliers");
    }
}
