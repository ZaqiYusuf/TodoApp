@extends('layout')
@section('content')
<section class="vh-100" >
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-3">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
                  <form action="/register" method="POST">
                    @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="d-flex flex-row align-items-center mb-4 ">
                      <i class="fas fa-user fa-lg me-3 fa-fw" ></i>
                      <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="name">Your Name</label>
                        <input type="text" name="name" id="disabledTextInput" class="form-control" style="border-color: #3060fc "/>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="username">Username</label>
                        <input type="text" name="username" id="disabledTextInput" class="form-control" style="border-color: #3060fc" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" id="disabledTextInput" class="form-control" style="border-color: #3060fc" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="disabledTextInput" class="form-control" style="border-color: #3060fc" />
                      </div>
                    </div>
  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-dark btn-lg">Register</button>
                    </div>
  
                  </form>
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <img src="https://espay.id/wp-content/uploads/2020/01/registrasi.png"
                    class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
