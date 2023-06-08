<?php

namespace App\Controllers;

use App\Models\Battery;
use App\Models\Bicycle;
use App\Models\Feature;
use App\Models\Supplier;
use App\Models\Type;

class BicycleController
{
    private Bicycle $bicycle;

    public function __construct()
    {
        $this->bicycle = new Bicycle();
    }

    public function index()
    {
        $bicycles = $this->bicycle->selectAll();

        return view('bicycle/index', ['bicycles' => $bicycles]);
    }

    public function create()
    {
        $battery = new Battery();
        $supplier = new Supplier();
        $type = new Type();

        $batteries = $battery->selectAll();
        $suppliers = $supplier->selectAll();
        $types = $type->selectAll();

        return view('bicycle/create', [
            'batteries' => $batteries,
            'suppliers' => $suppliers,
            'types' => $types,
        ]);
    }

    public function store()
    {
        $id = $this->bicycle->insert([
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'battery_id' => $_POST['battery_id'],
            'supplier_id' => $_POST['supplier_id'],
            'type_id' => $_POST['type_id'],
        ]);

        redirect("bicycles/{$id}");
    }

    public function edit(int $id)
    {
        $bicycle = $this->bicycle->where(['id' => $id])->first();

        return view('bicycle/edit', ['bicycle' => $bicycle]);
    }

    public function update(int $id)
    {
        $this->bicycle->where(['id' => $id])->update([
            'name' => $_POST['name'],
            'price' => $_POST['price'],
        ]);

        redirect("bicycles/{$id}");
    }

    public function show(int $id)
    {
        $bicycle = $this->bicycle->where(['id' => $id])->first();

        $batteryQuery = new Battery();
        $supplierQuery = new Supplier();
        $typeQuery = new Type();
        $featureQuery = new Feature();

        $battery = $batteryQuery->where(['id' => $bicycle->battery_id])->first();
        $supplier = $supplierQuery->where(['id' => $bicycle->supplier_id])->first();
        $type = $typeQuery->where(['id' => $bicycle->type_id])->first();

        $features = $featureQuery->where(['bicycle_id', $id])->selectAll();

        return view('bicycle/show', [
            'bicycle' => $bicycle,
            'battery' => $battery,
            'supplier' => $supplier,
            'type' => $type,
            'features' => $features
        ]);
    }

    public function delete(int $id)
    {
        $this->bicycle->where(['id' => $id])->delete();

        redirect("bicycles");
    }
}
