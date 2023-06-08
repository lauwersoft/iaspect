<?php

namespace App\Controllers;

use App\Builders\BicycleBuilder;
use App\Builders\FeatureBuilder;

class FeatureController
{
    private FeatureBuilder $featureBuilder;
    private BicycleBuilder $bicycleBuilder;

    public function __construct()
    {
        $this->featureBuilder = new FeatureBuilder();
        $this->bicycleBuilder = new BicycleBuilder();
    }

    public function index()
    {
        $features = $this->featureBuilder->selectAll();

        return view('feature/index', ['features' => $features]);
    }

    public function create()
    {
        $bicycles = $this->bicycleBuilder->selectAll();

        return view('feature/create', ['bicycles' => $bicycles]);
    }

    public function store()
    {
        $id = $this->featureBuilder->insert([
            'name' => $_POST['name'],
            'bicycle_id' => $_POST['bicycle_id']
        ]);

        redirect("features/{$id}");
    }

    public function edit(int $id)
    {
        $feature = $this->featureBuilder->where(['id' => $id])->first();

        return view('feature/edit', ['feature' => $feature]);
    }

    public function update(int $id)
    {
        $this->featureBuilder->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("features/{$id}");
    }

    public function show(int $id)
    {
        $feature = $this->featureBuilder->where(['id' => $id])->first();

        return view('feature/show', ['feature' => $feature]);
    }

    public function delete(int $id)
    {
        $this->featureBuilder->where(['id' => $id])->delete();

        redirect("features");
    }
}
