<?php

namespace App\Controllers;

use App\Models\Type;

class TypeController
{
    private Type $type;

    public function __construct()
    {
        $this->type = new Type();
    }

    public function index()
    {
        $types = $this->type->selectAll();

        return view('type/index', ['types' => $types]);
    }

    public function create()
    {
        return view('type/create');
    }

    public function store()
    {
        $id = $this->type->insert([
            'name' => $_POST['name']
        ]);

        redirect("types/{$id}");
    }

    public function edit(int $id)
    {
        $type = $this->type->where(['id' => $id])->first();

        return view('type/edit', ['type' => $type]);
    }

    public function update(int $id)
    {
        $this->type->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("types/{$id}");
    }

    public function show(int $id)
    {
        $type = $this->type->where(['id' => $id])->first();

        return view('type/show', ['type' => $type]);
    }

    public function delete(int $id)
    {
        $this->type->where(['id' => $id])->delete();

        redirect("types");
    }
}
