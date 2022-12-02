@extends('layout')

@section('content')
    <div class="wrapper bg-white" style="opacity: 85%">
        <div style="background-image=url(https://miro.medium.com/max/1400/0*bP0GbIkuUFhxhzoo)"></div>

        @if (session('notAllowed'))
            <div class="alert alert-danger">
                {{ session('notAllowed') }}
            </div>
            {{-- Mengambil dan mengirim data input ke controller --}}
        @endif
        @if (session('successAdd'))
            <div class="alert alert-success">
                {{ session('successAdd') }}
            </div>
        @endif
        @if (session('successUpdate'))
            <div class="alert alert-success">
                {{ session('successUpdate') }}
            </div>
        @endif
        @if (session('successLogin'))
            <script>
                Swal.fire(
                    'Success',
                    'Ciee Login....',
                    'success'
                )
            </script>
        @endif
        @if (session('deleted'))
            <script>
                Swal.fire(
                    'Berhasil menghapus ToDo!',
                    'You clicked the button!',
                    'success'
                )
            </script>
        @endif
        <div class="d-flex align-items-start justify-content-between">
            <div class="d-flex flex-column">
                <div class="h5">My Todo's</div>
                <p class="text-muted text-justify">
                    Here's a list of activities you have to do
                </p>
                <br>
                <span>
                    <a href="{{ route('todo.create') }}" class="text-success">Edit</a> or <a href="">Delete</a>
                </span>
            </div>
            <div class="info btn ml-md-4 ml-0">
                <span class="fas fa-info" title="Info"></span>
            </div>
        </div>
        <div class="work border-bottom pt-3">
            <div class="d-flex align-items-center py-2 mt-1">
                <div>
                    <span class="text-muted fas fa-comment btn"></span>
                </div>
                <div class="text-muted">2 todos</div>
                <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                    data-target="#comments" aria-expanded="false" aria-controls="comments" style="margin-left:68%"></button>
            </div>
        </div>
        <div id="comments" class="mt-1">
            @foreach ($todo as $a)
                <div class="comment d-flex align-items-start justify-content-between">
                    <div class="mr-2">
                        <form action="/todo/completed/{{$a['id']}}" method="POST">
                            @csrf
                            @method('PATCH')
                        <button type="submit" class="fas fa-circle-check text-primary btn" ></button>
                    </form>
                    </div>
                    <div class="d-flex flex-column">
                        {{-- menampilkan data dinamis/data yang diambil dari database pada blade harus menggunakan {{}} --}}
                        <a href="/todo/edit/{{ $a['id'] }}" class="text-justify">
                            {{ $a['title'] }}
                        </a>
                        <p> {{ $a['description'] }} </p>
                        {{-- konsep ternary : if column status baris ini isinya 1 bakal memunculkan teks 'Completed' selain dari itu akan menampilkan teks 'On-proccess' --}}
                        <p class="text-muted">{{ $a['status'] == 1 ? 'Completed' : 'On Proccess' }}
                            <span class="date">{{ \Carbon\Carbon::parse($a['date'])->format('j F, Y') }}</span>
                        </p>
                    </div>
                    <div class="ml-md-4 ml-0">
                        {{-- apabila fitur nya berhubungan dengan memodifikasi database, maka gunakan form --}}
                        <form action="{{ route('todo.delete', $a['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="fas fa-trash text-danger btn"></button>
                        </form>
                    </div>
                </div>
            @endforeach
                {{-- <div class="d-flex flex-column w-75">
                    <b class="text-justify">
                        Add to Copper
                    </b>
                    <p class="text-muted">Completed <span class="date">Dec 16, 2019</span></p>
                </div>
                <div class="ml-auto">
                    <span class="fas fa-arrow-right btn"></span>
                </div>
            </div>
            <div class="comment d-flex align-items-start justify-content-between">
                <div class="mr-2">
                    <label class="option">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="d-flex flex-column w-75">
                    <b class="text-justify">
                        Check on-boarding status
                    </b>
                    <p class="text-muted">Completed <span class="date">Dec 16, 2019</span></p>
                </div>
                <div class="ml-auto">
                    <span class="fas fa-arrow-right btn"></span>
                </div>
            </div>
        </div>
    </div> --}}

            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
                integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
            </script>
        @endsection
