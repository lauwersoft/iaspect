<?php

namespace App\Controllers;

use App\Models\Battery;

class BatteryController
{
    private Battery $battery;

    public function __construct()
    {
        $this->battery = new Battery();
    }

    public function index()
    {
        $batteries = $this->battery->selectAll();

        return view('battery/index', ['batteries' => $batteries]);
    }

    public function create()
    {
        return view('battery/create');
    }

    public function store()
    {
        $id = $this->battery->insert([
            'name' => $_POST['name']
        ]);

        redirect("batteries/{$id}");
    }

    public function edit(int $id)
    {
        $battery = $this->battery->where(['id' => $id])->first();

        return view('battery/edit', ['battery' => $battery]);
    }

    public function update(int $id)
    {
        $this->battery->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("batteries/{$id}");
    }

    public function show(int $id)
    {
        $battery = $this->battery->where(['id' => $id])->first();

        return view('battery/show', ['battery' => $battery]);
    }

    public function delete(int $id)
    {
        $this->battery->where(['id' => $id])->delete();

        redirect("batteries");
    }
}
