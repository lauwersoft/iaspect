<?php

namespace App\Controllers;

use App\Builders\SupplierBuilder;

class SupplierController
{
    private SupplierBuilder $supplierBuilder;

    public function __construct()
    {
        $this->supplierBuilder = new SupplierBuilder();
    }

    public function index()
    {
        $suppliers = $this->supplierBuilder->selectAll();

        return view('supplier/index', ['suppliers' => $suppliers]);
    }

    public function create()
    {
        return view('supplier/create');
    }

    public function store()
    {
        $id = $this->supplierBuilder->insert([
            'name' => $_POST['name']
        ]);

        redirect("suppliers/{$id}");
    }

    public function edit(int $id)
    {
        $supplier = $this->supplierBuilder->where(['id' => $id])->first();

        return view('supplier/edit', ['supplier' => $supplier]);
    }

    public function update(int $id)
    {
        $this->supplierBuilder->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("suppliers/{$id}");
    }

    public function show(int $id)
    {
        $supplier = $this->supplierBuilder->where(['id' => $id])->first();

        return view('supplier/show', ['supplier' => $supplier]);
    }

    public function delete(int $id)
    {
        $this->supplierBuilder->where(['id' => $id])->delete();

        redirect("suppliers");
    }
}
