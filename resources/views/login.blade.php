@extends('layout')

@section('content')
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col" style="margin-left: 15%">
                    <div class="card w-75" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block" style="margin-top: 5%">
                                <img src="https://miro.medium.com/max/1400/0*bP0GbIkuUFhxhzoo" alt="login form"
                                    class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="post" action="{{ route('login.auth') }}">
                                        @csrf
                                        @if (session('success'))
                                            <script>
                                                Swal.fire(
                                                    'Login Now!',
                                                    'Successfully added account!',
                                                    'success'
                                                )
                                            </script>
                                        @endif
                                        @if (session('notAllowed'))
                                            <div class="alert alert-danger">
                                                {{ session('notAllowed') }}
                                            </div>
                                        @endif
                                        @if (session('logout'))
                                            <script>
                                                Swal.fire(
                                                    'Back?',
                                                    'Login Again?',
                                                    'question'
                                                )
                                            </script>
                                        @endif
                                        @if ($errors->any())
                                            {{-- <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div> --}}
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                    footer: '<a href="/register">Register Now!!!</a>'
                                                })
                                            </script>
                                        @endif
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class='bx bx-list-plus'></i>
                                            {{-- <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> --}}
                                            <span class="h1 fw-bold mb-0">Todo list</span>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="disableTextInput">Username</label>
                                            <input type="text" id="disableTextInput" name="username"
                                                class="form-control" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="disableTextInput">Password</label>
                                            <input type="password" id="disableTextInput" name="password"
                                                class="form-control" />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                                href="/register" style="color: #393f81;">Register here</a></p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
