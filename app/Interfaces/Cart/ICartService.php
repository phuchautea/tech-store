<?php

namespace App\Interfaces\Cart;

interface ICartService
{
    public function add($request);
    public function getCartItems();
    public function getItemCount();
    public function remove($id);
    public function update($request);
}
