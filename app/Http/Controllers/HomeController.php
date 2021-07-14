<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use Illuminate\Cache\Repository;
use App\Http\Views\Composers\MultiComposer;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * @var private repso
     *
     */

    private $repo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepo $repository)
    {
        $this->repo = $repository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');

        $c = $this->repo->all()->toArray();
        return $c;

    }


}
