<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface 
{
    public function getAllPosts() 
    {
        return Post::all();
    }

    // public function getOrderById($orderId) 
    // {
    //     return Post::findOrFail($orderId);
    // }

    // public function deleteOrder($orderId) 
    // {
    //     Post::destroy($orderId);
    // }

    // public function createOrder(array $orderDetails) 
    // {
    //     return Post::create($orderDetails);
    // }

    // public function updateOrder($orderId, array $newDetails) 
    // {
    //     return Post::whereId($orderId)->update($newDetails);
    // }

    // public function getFulfilledOrders() 
    // {
    //     return Post::where('is_fulfilled', true);
    // }
}