<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Sentinel;

class CategoryController extends Controller
{
   /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('sentinel.auth');
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Sentinel::getUser();
		$categories = Category::get();
		
		return view('categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->except(['_token']);
		
		$data = array(
			'name'  => $input['name'],
			'description'  => $input['description']
		);
		
		$category = new Category();
		$category->saveCategory($data);
		
		$message = session()->flash('success', 'Uspješno je dodana nova kategorija');
		
		//return redirect()->back()->withFlashMessage($messange);
		return redirect()->route('categories.index')->withFlashMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

		return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
		$input = $request->except(['_token']);

		$data = array(
			'name'  => $input['name'],
			'description'  => $input['description']
		);
		
		$category->updateCategory($data);
		
		$message = session()->flash('success', 'Podaci su ispravljeni');
		
		return redirect()->route('categories.index')->withFlashMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
		$category->delete();
		
		$message = session()->flash('success', 'Kategorija je obrisana');
		
		return redirect()->route('categories.index')->withFlashMessage($message);
    }
}
