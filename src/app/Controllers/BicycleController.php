<?php

namespace App\Controllers;

use App\Builders\BatteryBuilder;
use App\Builders\BicycleBuilder;
use App\Builders\FeatureBuilder;
use App\Builders\SupplierBuilder;
use App\Builders\TypeBuilder;

class BicycleController
{
    private BicycleBuilder $bicycleBuilder;
    private SupplierBuilder $supplierBuilder;
    private BatteryBuilder $batteryBuilder;
    private TypeBuilder $typeBuilder;
    private FeatureBuilder $featureBuilder;

    public function __construct()
    {
        $this->bicycleBuilder = new BicycleBuilder();
        $this->batteryBuilder = new BatteryBuilder();
        $this->supplierBuilder = new SupplierBuilder();
        $this->typeBuilder = new TypeBuilder();
        $this->featureBuilder = new FeatureBuilder();
    }

    public function index()
    {
        $bicycles = $this->bicycleBuilder->selectAll();

        return view('bicycle/index', ['bicycles' => $bicycles]);
    }

    public function create()
    {
        $batteries = $this->batteryBuilder->selectAll();
        $suppliers = $this->supplierBuilder->selectAll();
        $types = $this->typeBuilder->selectAll();

        return view('bicycle/create', [
            'batteries' => $batteries,
            'suppliers' => $suppliers,
            'types' => $types,
        ]);
    }

    public function store()
    {
        $id = $this->bicycleBuilder->insert([
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
        $bicycle = $this->bicycleBuilder->where(['id' => $id])->first();

        return view('bicycle/edit', ['bicycle' => $bicycle]);
    }

    public function update(int $id)
    {
        $this->bicycleBuilder->where(['id' => $id])->update([
            'name' => $_POST['name'],
            'price' => $_POST['price'],
        ]);

        redirect("bicycles/{$id}");
    }

    public function show(int $id)
    {
        $bicycle = $this->bicycleBuilder->where(['id' => $id])->first();
        $battery = $this->batteryBuilder->where(['id' => $bicycle->battery_id])->first();
        $supplier = $this->supplierBuilder->where(['id' => $bicycle->supplier_id])->first();
        $type = $this->typeBuilder->where(['id' => $bicycle->type_id])->first();
        $features = $this->featureBuilder->where(['bicycle_id', $id])->selectAll();

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
        $this->bicycleBuilder->where(['id' => $id])->delete();

        redirect("bicycles");
    }
}
