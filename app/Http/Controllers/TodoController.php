<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('index')->with('logout', 'Anda sudah logout!');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    public function registerAccount(Request $request)
    {
        // dd($request->all());
        //validasi input
        $request->validate([
            'email' => 'required|email:dns',
            'username' => 'required|min:4|max:8|unique:users',
            'password' => 'required|min:4',
            'name' => 'required|min:3',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // redirect kemana setelah berhasil 
        return redirect('/')->with('success', 'Berhasil menambahkan akun! Silahkan login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ], [
            'username.exists' => 'username ini belum tersedia',
            'username.required' => 'username harus diisi',
            'password.required' => 'password harus diisi',
        ]);

        $user = $request->only('username', 'password');
        //authentication
        if (Auth::attempt($user)) {
            return redirect()->route('todo.index')->with('successLogin', 'Ciee login!');
        } else {
            return redirect()->back()->with('error', 'Gagal login, silahkan cek dan coba lagi!');
        }
    }

    public function home()
    {
        // ambil data dari table todos dengan model todo
        // filter data di database  -> where('column','perbandingan','value')
        $todo = Todo::where('user_id', '=', Auth::user()->id)->get();
        return view('todo', compact('todo'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mengirim data ke database
        // dd($request->all());
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);
        // yang nullable ga perlu diisi bisar null dulu, done_time diisi pas udah selesai statusnya
        // colomn status itu boolean : 0 (belum selesai) dan 1 (sudah selesai)
        // user_id dapat diambil dari fitur Auth (history login) 
        // kenapa yang dikirim 5 data?? karena table pada db todos membutuhkan 6 column
        // salah satunya column 'done_time' yang tipe nya nullable, karena nullable jadi ga perlu dikirim nilai
        // 'user_id' untuk memberitahu data todo ini milik siapa, diambil melalui fitur auth
        // 'status' tipenya boolean, 0 = belum dikerjakan, 1- sudah dikerjakan (todonya) 
        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        //kalau berhasil diarahin ke halaman todo awal dengan pemberitahuan
        return redirect('/todo')->with('successAdd', 'Berhasil menambahkan data Todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
        $todo = Todo::where('id', $id)->first();
        return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);
        Todo::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);
        return redirect('/todo')->with('successUpdate', 'Data todo berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // menghapus data di database
        // filter / cari data yang mau di hapus, baru jalankan perintah hapus nya
        Todo::where('id', '=', $id)->delete();
        // kalau udsah, balik lagi ke halaman awalnya dengan pemberitahuan
        return redirect()->back()->with('deleted', 'Berhasil menghapus data ToDo!');
    }

    public function completed()
    {
        // todo yang sudah beres
        return view('todo.complated');
    }

    public function updateCompleted($id)
    {
        // cari data yang mau diubah statusnya jadi 'completed' dan column 'done_time' yang tadinya null, diisi dengan tanggal sekarang (tanggal ketika data todo di ubah statusnya) 
        // karena status boolean, dan 0 itu untuk kondisi todo on-progress, jadi 1 nya untuk kodisi todo completed
        Todo::where('id', '=', $id)->update([
            'status' => 1,
            'done_time' => \Carbon\Carbon::now(),
        ]);
        // apabila berhasil, akan dikembalikan ke halaman awal dengan pemberitahuan
        return redirect()->back()->with('done', 'Todo telah selesai dikerjakan!');
    }
}
