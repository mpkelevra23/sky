<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MainController extends Controller
{
    /**
     * Display the main page.
     * С помощью метода inertia() мы передаем в шаблонизатор Inertia данные для отображения.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Main/Index');
    }
}
