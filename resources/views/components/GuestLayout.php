<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Properti publik untuk menampung judul halaman.
     * Ini memastikan bahwa atribut 'title' pada <x-guest-layout title="ABC"> 
     * diteruskan ke view resources/views/layouts/guest.blade.php.
     */
    public string $title;

    /**
     * Konstruktor
     * @param string $title Judul yang akan ditampilkan di tab browser.
     */
    public function __construct(string $title = 'Masuk')
    {
        // Tetapkan nilai judul yang diterima atau nilai default
        $this->title = $title;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
