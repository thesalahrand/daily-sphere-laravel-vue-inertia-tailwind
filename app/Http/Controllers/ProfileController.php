<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\PseudoNameService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request, PseudoNameService $pseudoNameService): Response
  {
    return Inertia::render('Profile/Edit', [
      // 'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
      // 'status' => session('status'),
      'availablePseudoNames' => $pseudoNameService->getAvailable(),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    // if ($request->user()->isDirty('email')) {
    //   $request->user()->email_verified_at = null;
    // }
    $request->user()->pseudo_name_id = $request->validated()['pseudo_name_id'];

    if (isset($request->validated()['profile_pic'])) {
      $request->user()->profile_pic && Storage::disk('public')->delete($request->user()->profile_pic);
      $request->user()->profile_pic = $request->validated()['profile_pic']->store('users', 'public');
    }

    $request->user()->save();

    return Redirect::route('profile.edit');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $request->validate([
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }
}
