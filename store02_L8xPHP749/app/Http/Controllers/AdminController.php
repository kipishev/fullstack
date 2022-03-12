<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Jobs\ExportProducts;
use App\Jobs\ImportCategoriesFromFile;
use App\Jobs\ImportProductsFromFile;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin () {
        return view('admin.admin');
    }
    public function users () {
        $users = User::get();
        $roles = Role::get();
        $data = [
            'title' => 'Список пользователей',
            'users' => $users,
            'roles' => $roles,
        ];
        return view('admin.users', $data);
    }
    public function categories () {
        // Код для VueJS
        $categories = Category::get();
        return view('admin.categories', compact('categories'));

        // Код для BLADE
        /*$categories = Category::get();
        $data = [
            'title' => 'Список всех категорий',
            'categories' => $categories,
        ];
        return view('admin.categories', $data);*/
    }

    public function addCategory () {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'picture' => 'mimetypes:image/*',
        ]);

        $input = request()->all();
        $name = $input['name'];
        $description = $input['description'];
        $picture = $input['picture'] ?? null;
        /*TODO "picture can not be null" if I make an insert with Category::create. How to fix it?*/

        Category::create([
            'name' => $name,
            'description' => $description,
        ]);

        $category = Category::latest()->first();

        if ($picture) {
            $ext = $picture->getClientOriginalExtension();
            $fileName = time() . '_' . rand(10000, 99999) . '.' . $ext;
            $picture->storeAs('public/categories', $fileName);
            $category->picture = "categories/$fileName";
        }
        $category->save();
        session()->flash('addCategory');
        return back();
    }

    public function importCategoriesFromFile () {
        ImportCategoriesFromFile::dispatch();
        session()->flash('startImportCategoriesFromFile');
        return back();
    }
    public function importProductsFromFile () {
        ImportProductsFromFile::dispatch();
        session()->flash('startImportProductsFromFile');
        return back();
    }

    public function exportCategories () {
        ExportCategories::dispatch(Auth::user()->id);

        // Для BLADE
        /*ExportCategories::dispatch();
        session()->flash('startExportCategories');
        return back();*/
    }
    public function exportProducts () {
        ExportProducts::dispatch();
        session()->flash('startExportProducts');
        return back();
    }

    public function products () {
        $products = Product::get();
        $categories = Category::get();
        $data = [
            'title' => 'Список всех продуктов',
            'products' => $products,
            'categories' => $categories,
        ];
        return view('admin.products', $data);
    }
    public function addProduct () {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            /*TODO правильно ли выбрана валидация для цены?*/
            'picture' => 'mimetypes:image/*',
        ]);

        $input = request()->all();
        $name = $input['name'];
        $description = $input['description'];
        $category_id = $input['category_id'];
        $price = $input['price'];
        $picture = $input['picture'] ?? null;
        /*TODO "picture can not be null" if I make an insert with Product::create. How to fix it?*/

        Product::create([
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id,
            'price' => $price,
            /*TODO добавить вставку цены в требуемом формате*/
        ]);

        $product = Product::latest()->first();

        if ($picture) {
            $ext = $picture->getClientOriginalExtension();
            $fileName = time() . '_' . rand(10000, 99999) . '.' . $ext;
            $picture->storeAs('public/products', $fileName);
            $product->picture = "products/$fileName";
        }
        $product->save();
        session()->flash('addProduct');
        return back();
    }

    public function enterAsUser ($id) {
        Auth::loginUsingId($id);
        return redirect()->route('adminUsers');
    }
    public function addRole () {
        request()->validate([
            'name' => 'required|min:3',
        ]);
        Role::create([
            'name' => request('name')
        ]);
        return back();
    }
    public function addRoleToUser () {
        request()->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);
        $user = User::find(request('user_id'));
        $user->roles()->attach(Role::find(request('role_id')));
        return back();
    }
}
