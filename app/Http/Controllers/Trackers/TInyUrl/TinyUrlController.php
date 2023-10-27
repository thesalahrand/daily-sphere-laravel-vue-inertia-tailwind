<?php

namespace App\Http\Controllers\Trackers\TinyUrl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trackers\TinyUrl\StoreTinyUrlRequest;
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
  public function edit(TinyUrl $tinyUrl)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, TinyUrl $tinyUrl)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(TinyUrl $tinyUrl)
  {
    //
  }
}
