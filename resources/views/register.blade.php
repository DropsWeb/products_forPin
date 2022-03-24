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
    <title>Регистрация</title>
</head>
    <body>
        <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Создать аккаунт</h2>
                                @if(session('success'))
                                    <div class="alert alert-danger w-100">{{ session('success') }}</div>
                                @endif
                                <form method="POST" action="{{route('make_account')}}">
                                    @csrf
                                <div class="form-outline mb-4">
                                    <input type="text" name="name" id="form3Example1cg" value="{{old('name')}}" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1cg">Логин</label>
                                    @error('name')
                                        <div class="alert alert-danger w-100">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" name="email" id="form3Example1cg" value="{{old('email')}}" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1cg">E-mail</label>
                                    @error('email')
                                        <div class="alert alert-danger w-100">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cg">Пароль</label>
                                    @error('password')
                                        <div class="alert alert-danger w-100">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="repeatPassword" id="form3Example4cdg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cdg">Повторите пароль</label>
                                </div>

                                <div class="form-check d-flex justify-content-center mb-5">
                                    <input
                                        class="form-check-input me-2"
                                        type="checkbox"
                                        value="1"
                                        id="form2Example3cg"
                                        name="isAdmin"
                                    />
                                    <label class="form-check-label" for="form2Example3g">
                                        Зарегистрироваться как администратор
                                    </label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Зарегистрироваться</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Есть логин?<a href="/login" class="fw-bold text-body"><u>Авторизоваться!</u></a></p>

                                </form>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
