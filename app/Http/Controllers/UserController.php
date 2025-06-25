<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    /**
     * Show the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Show the form to edit the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit_profile', compact('user'));
    }
    /**
     * Método unificado para actualizar datos del usuario.
     */
    public function updateUser(Request $request)
    {
        $user = Auth::user();




        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string|max:20',
        ]);

            // Validación condicional para la contraseña
    if ($request->filled('password') || $request->filled('password_confirmation')) {
        $request->validate([
            'password' => 'required|string|min:3|confirmed',
        ]);

        // Si pasa la validación, se actualiza la contraseña
        $user->password = Hash::make($request->password);
    }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        
        $user->save();
        // Redirigir a la vista de perfil con un mensaje de éxito
        

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }



    /**
     * Show the registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('users.register');
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'telefono' => 'required|string|max:15',
        'password' => 'required|string|min:8',
        'admin_code' => 'nullable|string',
    ]);

    $adminCodeSecret = env('ADMIN_CODE_SECRET', 'Codigo123');

    $rolId = ($request->admin_code === $adminCodeSecret) ? 1 : 2;

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'telefono' => $request->input('telefono'),
        'password' => Hash::make($request->input('password')),
        'rol_id' => $rolId,
    ]);

    // Auth::login($user); // Opcional: login automático tras registro

    return redirect()->route('login')->with('success', 'Registro exitoso.');
}


    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('users.login');
    }

    /**
     * Login the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Verificar si el usuario es administrador
        if ($user->rol_id == 1) {
            session(['modo_admin' => true]);
            return redirect()->route('admin.productos.index')->with('success', 'Bienvenido administrador.');
        }

        // Usuario normal
        return redirect()->intended('inicio')->with('success', 'Inicio de sesión exitoso.');
    }

    return back()->with('error', 'Credenciales incorrectas.');
}
    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}



