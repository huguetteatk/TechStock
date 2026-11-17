<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    // Lister les catégories
    public function index()
    {
        // On récupère aussi le nombre d'équipements par catégorie pour le bonus
        $categories = Category::withCount('devices')->get();
        return view('categories.index', compact('categories'));
    }

    // Enregistrer une nouvelle catégorie
    public function store(StoreCategoryRequest $request)
        {
            Category::create($request->validated());

            return redirect()->route('categories.index')
                ->with('success', 'La catégorie a bien été ajoutée !');
        }

    // Page affichant tous les équipements d'une catégorie donnée 
    public function show(Category $category)
    {
        // On récupère les équipements associés à cette catégorie
        $devices = $category->devices()->with('room')->paginate(10);
        return view('categories.show', compact('category', 'devices'));
    }
}