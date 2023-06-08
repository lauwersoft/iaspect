<?php

namespace App\Controllers;

use App\Models\Bicycle;
use App\Models\Feature;

class FeatureController
{
    private Feature $feature;

    public function __construct()
    {
        $this->feature = new Feature();
    }

    public function index()
    {
        $features = $this->feature->selectAll();

        return view('feature/index', ['features' => $features]);
    }

    public function create()
    {
        $bicycleQuery = new Bicycle();

        $bicycles = $bicycleQuery->selectAll();

        return view('feature/create', ['bicycles' => $bicycles]);
    }

    public function store()
    {
        $id = $this->feature->insert([
            'name' => $_POST['name'],
            'bicycle_id' => $_POST['bicycle_id']
        ]);

        redirect("features/{$id}");
    }

    public function edit(int $id)
    {
        $feature = $this->feature->where(['id' => $id])->first();

        return view('feature/edit', ['feature' => $feature]);
    }

    public function update(int $id)
    {
        $this->feature->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("features/{$id}");
    }

    public function show(int $id)
    {
        $feature = $this->feature->where(['id' => $id])->first();

        return view('feature/show', ['feature' => $feature]);
    }

    public function delete(int $id)
    {
        $this->feature->where(['id' => $id])->delete();

        redirect("features");
    }
}
