<?php

use App\Entity\Product;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;
use App\Entity\Category;

Breadcrumbs::register('home', function (Crumbs $crumbs) {
    $crumbs->push(__('fillable.Home'), route('home'));
});

Breadcrumbs::register('cart.index', function (Crumbs $crumbs) {
    $crumbs->push('Корзина', route('cart.index'));
});

Breadcrumbs::register('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login'));
});

Breadcrumbs::register('login.phone', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login.phone'));
});

Breadcrumbs::register('register', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Register', route('register'));
});

Breadcrumbs::register('password.request', function (Crumbs $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Reset Password', route('password.request'));
});

Breadcrumbs::register('password.reset', function (Crumbs $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push('Change', route('password.reset'));
});

Breadcrumbs::register('search.index', function (Crumbs $crumbs) {
    // $crumbs->parent('home');
    $crumbs->push( __('fillable.Search'));
    if (request('text')) {
        $crumbs->push(request('text'));
    }
});

// Category SHOW
Breadcrumbs::register('categories.show', function (Crumbs $crumbs, Category $category) {
    if ($parent = $category->parent) {
        $crumbs->parent('categories.show', $parent);
    }
    $crumbs->push($category->name == null ? $category->name_original : $category->name, route('categories.show', $category));
});

// Product SHOW
Breadcrumbs::register('product.show', function (Crumbs $crumbs, Product $product) {
    $crumbs->parent('categories.show', $product->category);
    $crumbs->push($product->brand->title, route('product.show', $product));
});

