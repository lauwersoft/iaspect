<?php

namespace App\Controllers;

use App\Builders\TypeBuilder;

class TypeController
{
    private TypeBuilder $typeBuilder;

    public function __construct()
    {
        $this->typeBuilder = new TypeBuilder();
    }

    public function index()
    {
        $types = $this->typeBuilder->selectAll();

        return view('type/index', ['types' => $types]);
    }

    public function create()
    {
        return view('type/create');
    }

    public function store()
    {
        $id = $this->typeBuilder->insert([
            'name' => $_POST['name']
        ]);

        redirect("types/{$id}");
    }

    public function edit(int $id)
    {
        $type = $this->typeBuilder->where(['id' => $id])->first();

        return view('type/edit', ['type' => $type]);
    }

    public function update(int $id)
    {
        $this->typeBuilder->where(['id' => $id])->update([
            'name' => $_POST['name']
        ]);

        redirect("types/{$id}");
    }

    public function show(int $id)
    {
        $type = $this->typeBuilder->where(['id' => $id])->first();

        return view('type/show', ['type' => $type]);
    }

    public function delete(int $id)
    {
        $this->typeBuilder->where(['id' => $id])->delete();

        redirect("types");
    }
}
