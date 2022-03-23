<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset("js/app.js") }}"></script>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Продукты</title>
</head>
<body>
    <main>
        <div class="d-flex flex-row bd-highlight h-100">
            <div class="bd-highlight left_panel">
                <div class="row">
                    <div class="col d-flex bg-light align-items-center justify-content-center logo_products"><img src="{{asset("images/logo.svg")}}" alt=""></div>
                    <div class="col px-4  mt-2 text-white" style="font-size: 11px">
                        Enterprise
                        Resource
                        Planning
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-3 mx-3 text-white opacity-25" style="font-size: 12px">Продукты</div>
                </div>
            </div>
            <div class="bd-highlight main_panel w-100">
                <div class="d-flex flex-row justify-content-between bd-highlight mx-0 main_panel__header">
                    <div class="bd-highlight">
                        <ul class="nav custom_tabs">
                            <li class="custom_tabs__nav">
                                <a class="nav-elem active text-uppercase ms-3" aria-current="page" href="#">продукты</a>
                            </li>
                        </ul>
                    </div>
                    <div class="bd-highlight user_name me-5">Елсуков Андрей Вячеславович</div>
                </div>
                <div class="d-flex justify-content-between main_content">
                    <div class="list_products">
                        <div class="list_products__header ms-3">
                            <div class="list_products__header-item">артикул</div>
                            <div class="list_products__header-item">название</div>
                            <div class="list_products__header-item">статус</div>
                            <div class="list_products__header-item">атрибуты</div>
                        </div>
                        <div class="list_products__items">
                            @foreach ($products as $product)
                                <div class="list_products__items-item ps-3" data-product='{{json_encode($product)}}'>
                                    <div class="list_item">{{$product->ARTICLE}}</div>
                                    <div class="list_item">{{$product->NAME}}</div>
                                    <div class="list_item">{{($product->STATUS) ? "Доступен" : "Не доступен"}}</div>
                                    <div class="list_item-col">
                                        @if (json_decode($product->DATA))
                                            @foreach (json_decode($product->DATA) as $data)
                                                <div class="list_item">{{$data->name}} : {{$data->value}}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="me-4 mt-3">
                        <button class="add_product" type="button" data-bs-toggle="collapse" data-bs-target="#createProduct" aria-expanded="false" aria-controls="createProduct">Добавить</button>
                    </div>
                    <div class="collapse create_product" id="createProduct">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title">Добавить продукт</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-toggle="collapse" data-bs-target="#createProduct" aria-expanded="false" aria-controls="createProduct"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="/add_product">
                                    @method("PUT")
                                    @csrf
                                    <div class="mb-3">
                                        <label for="articleProduct" class="form-label">Артикул</label>
                                        <input type="string" required name="article" class="form-control" id="articleProduct" aria-describedby="articleProduct">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nameProduct" class="form-label">Название</label>
                                        <input type="string" required name="name" class="form-control" id="nameProduct" aria-describedby="nameProduct">
                                    </div>
                                    <div class="mb-3">
                                        <label for="statusProduct" class="form-label">Статус</label>
                                        <select class="form-select" name="status" id="statusProduct" aria-label="Default select example">
                                            <option value="1">Доступен</option>
                                            <option value="2">Не доступен</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 d-flex flex-column">
                                        <label for="" class="form-label-attr mb-4"> Атрибуты</label>
                                        <div class="form_attributes"></div>
                                        <div class="add_attr mt-4 mb-3">+ Добавить атрибут</div>
                                    </div>
                                    <button type="submit" class="add_product">Добавить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="collapse edit_product" id="editProduct" data-token="{{csrf_token()}}"></div>

                    <div class="collapse info_product" id="infoProduct" >
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <div class="product_actions" data-token="{{csrf_token()}}">
                                <button class="action_edit"><img src="{{asset("images/edit.png")}}" alt="Редактировать"></button>
                                <button class="action_remove"><img src="{{asset("images/remove.png")}}" alt="Удалить"></button>
                                <button type="button" class="btn-close btn-close-white" data-bs-toggle="collapse" data-bs-target="#infoProduct" aria-expanded="false" aria-controls="createProduct"></button>
                            </div>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</body>
</html>
