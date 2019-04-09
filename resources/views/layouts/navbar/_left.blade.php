<div class="" style=" width: 210px;">
    <ul class="list-unstyled mr-3 top-left-nav m-0">
        <li class="nav-item dropdown" style="position: initial"><a class="nav-link bg-purpl rounded py-2 text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                <span class="px-0 font-weight-bold"><i class="far fa-bars pr-1"></i> Каталог товаров</span>
            </a>
            <div class="dropdown-menu w-100 py-0 m-0 mt-4 rounded-0 border-0 shadow-lg bg-gray animate slideIn" aria-labelledby="dropdown01">
                <div class="container">
                    <div class="d-flex">
                        <ul class="list-menu list-unstyled n-navigation-vertical-category py-4">
                            @foreach($menuRoot as $category)
                                <li id="aHref" data-id="{{ $category->id }}" title="{{ $category->name }}"><a href="{{ $category->id }}"><span>{{ $category->name }}</span></a></li>
                            @endforeach
                        </ul>
                        <div class="vertical-menu bg-white py-2 w-100 ">
                            @foreach($menuRoot as $categories)
                                <div class="vertical-menu_block py-4 px-5 mr-3" data-id="{{ $categories->id }}">
                                    <div class="card-columns pr-5">

                                        @foreach($categories->children as $category)
                                            <div class="pb-1 card border-0 py-0 px-0">
                                                <div class="vertical-menu-block">
                                                    <div class="vertical-menu-block-title font-weight-bold"><a href="">{{ $category->name }}</a></div>
                                                    <ul class="vertical-menu-block-list-item list-unstyled">
                                                        @foreach($category->children as $child)
                                                            <li><a href="">{{ $child->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="flex-fill search-form">
    <form action="?" method="GET" class="form-inline">
        <div class="input-group ">
            <input  id="name" type="text" class="form-control rounded-left-sm" name="name" value="{{ request('name') }}" placeholder="Я хочу найти..">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" >{{ __('button.Search') }}</button>
            </div>
        </div>
    </form>
</div>
