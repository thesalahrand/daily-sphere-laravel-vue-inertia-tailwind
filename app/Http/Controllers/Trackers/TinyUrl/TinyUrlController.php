<?php

namespace App\Http\Controllers\Trackers\TinyUrl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trackers\TinyUrl\StoreTinyUrlRequest;
use App\Http\Requests\Trackers\TinyUrl\UpdateTinyUrlRequest;
use App\Models\TinyUrl;
use App\Services\Trackers\TinyUrl\TinyUrlService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TinyUrlController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, TinyUrlService $tinyUrlService)
  {
    $tinyUrls = $tinyUrlService->index($request->user());

    return Inertia::render("Trackers/TinyUrl/Index", [
      'tinyUrls' => $tinyUrls
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): Response
  {
    return Inertia::render("Trackers/TinyUrl/Create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreTinyUrlRequest $request, TinyUrlService $tinyUrlService)
  {
    $usableTinyUrl = $tinyUrlService->store([...$request->validated(), 'user_id' => $request->user()->id]);

    return back()->with('message', $usableTinyUrl);
  }

  /**
   * Display the specified resource.
   */
  public function show(TinyUrl $tinyUrl)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request, TinyUrl $tinyUrl)
  {
    if ($tinyUrl->user_id != $request->user()->id)
      abort('403');

    return Inertia::render("Trackers/TinyUrl/Edit", [
      'tinyUrl' => $tinyUrl->only(['id', 'full_url', 'tiny_url'])
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateTinyUrlRequest $request, TinyUrl $tinyUrl, TinyUrlService $tinyUrlService)
  {
    if ($tinyUrl->user_id != $request->user()->id)
      abort('403');

    $usableTinyUrl = $tinyUrlService->update($tinyUrl, $request->validated());

    return back()->with('message', $usableTinyUrl);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(TinyUrl $tinyUrl, Request $request, TinyUrlService $tinyUrlService)
  {
    if ($tinyUrl->user_id != $request->user()->id)
      abort('403');

    $tinyUrlService->destroy($tinyUrl);

    return back();
  }
}
