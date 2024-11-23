<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $slides = [['label' => 'women', 'url' => 'women', 'image' => 'h1.webp'], ['label' => 'men', 'url' => 'men', 'image' => 'h2.webp'], ['label' => 'Offers', 'url' => 'women', 'image' => 'h3.webp']];
        $items = [['url' => 'men', 'image' => 'img/home/c1.jpg', 'label' => "Nexus Original's Men Shirt"], ['url' => 'women', 'image' => 'img/home/I3.jpg', 'label' => "Nexus Original's Women Shirt"], ['url' => 'men', 'image' => 'img/home/c3.jpg', 'label' => "Nexus Original's Men Shirt"]];
        return view('home', compact('items', 'slides'));
    }
}
