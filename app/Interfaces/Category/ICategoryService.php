<?php

namespace App\Interfaces\Category;

interface ICategoryService
{
    public function paginate();
    public function find($id);
    public function store($request);
    public function update($id, $data);
    public function destroy($request);
}
