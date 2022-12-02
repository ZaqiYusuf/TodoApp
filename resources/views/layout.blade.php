<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Nunito+Sans:ital,wght@1,900&display=swap"
        rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Todo App</title>
</head>

<body>
    @if (Auth::check())
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-family: 'Nunito Sans', sans-serif; margin-left: 2%">TodoApp</a>
                <div class="dropdown" style="margin-right: 2%">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Option
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('todo.create') }}"><i class="fa-solid fa-plus"></i>
                            Create</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-check"></i> Completed</a>
                        <a onclick="confirmLogout()" class="dropdown-item" type="submit"><i
                                class="fa-solid fa-power-off"></i> LOGOUT</a>
                    </div>
                </div>

                </form>
            </div>
        </nav>
    @endif
    @yield('content')

    <script>
        function confirmLogout() {
        Swal.fire({
            icon: 'question',
            title: 'Oops...',
            text: 'Are You Sure?',
            showDenyButton: true,
            confirmButtonText: 'Sure',
            denyButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/logout";
            } else if (result.isDenied) {
                Swal.fire('Anda tidak jadi logout', '', 'info')
            }
        })
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
