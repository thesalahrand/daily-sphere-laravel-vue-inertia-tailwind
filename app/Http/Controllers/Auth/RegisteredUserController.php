<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\PseudoNameService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(PseudoNameService $pseudoNameService): Response
  {
    return Inertia::render('Auth/Register', [
      'pseudoNames' => $pseudoNameService->getAll(),
    ]);
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'gender' => ['required', Rule::in(['Male', 'Female'])],
      'pseudo_name_id' => [
        'required',
        'unique:users',
        Rule::exists('pseudo_names', 'id')->where(function (Builder $query) use ($request) {
          return $query->where('gender', $request->gender);
        }),
      ],
      'password' => ['required', 'confirmed', Password::min(8)->uncompromised()],
    ]);

    $user = User::create([
      'pseudo_name_id' => $request->pseudo_name_id,
      'password' => $request->password,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
  }
}
