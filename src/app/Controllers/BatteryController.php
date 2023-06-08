<?php

namespace App\Controllers;

use App\Builders\BatteryBuilder;

class BatteryController
{
    private BatteryBuilder $batteryBuilder;

    public function __construct()
    {
        $this->batteryBuilder = new BatteryBuilder();
    }

    public function index()
    {
        $batteries = $this->batteryBuilder->selectAll();

        return view('battery/index', ['batteries' => $batteries]);
    }

    public function create()
    {
        return view('battery/create');
    }

    public function store()
    {
        $id = $this->batteryBuilder->insert([
            'name' => $_POST['name']
        ]);

        redirect("batteries/{$id}");
    }

    public function edit(int $id)
    {
        $battery = $this->batteryBuilder->where(['id' => $id])->first();

        return view('battery/edit', ['battery' => $battery]);
    }

    public function update(int $id)
    {
        $this->batteryBuilder->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("batteries/{$id}");
    }

    public function show(int $id)
    {
        $battery = $this->batteryBuilder->where(['id' => $id])->first();

        return view('battery/show', ['battery' => $battery]);
    }

    public function delete(int $id)
    {
        $this->batteryBuilder->where(['id' => $id])->delete();

        redirect("batteries");
    }
}
