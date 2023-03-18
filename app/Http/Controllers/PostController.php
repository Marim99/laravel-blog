<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $_allPosts=[

        [
            'id' => 0,
            'title' => 'Laravel',
            'posted_by' => 'Mariam',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description',
        ],

        [
            'id' => 1,
            'title' => 'PHP',
            'posted_by' => 'Hager',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description',
        ],

        [
            'id' => 2,
            'title' => 'Javascript',
            'posted_by' => 'Alaa',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description',
        ],
    ];
    public function index()
    {

        return view('post.index', ['posts' =>$this->_allPosts]);
    }
    public function create()
    {
        return view('post.create');
    }
    public function show($Id)
    {
        return view('post.show', ["post" =>$this->_allPosts[$Id]]);
    }
    public function edit($Id)
    {
        return view("post.edit", ["post" =>$this->_allPosts[$Id]]);
    }
    public function store()
    {
        return redirect()->route('post.index');    }
    public function update()
    {
        return redirect()->route('post.index');
    }
}