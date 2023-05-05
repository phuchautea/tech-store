<?php

namespace App\Interfaces\Category;

interface ICategoryRepository
{
    public function paginate();
    public function find($id);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);
}
