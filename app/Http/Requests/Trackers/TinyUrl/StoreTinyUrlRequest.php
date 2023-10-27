<?php

namespace App\Http\Requests\Trackers\TinyUrl;

use Illuminate\Foundation\Http\FormRequest;

class StoreTinyUrlRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'full_url' => 'required|url',
      'tiny_url' => 'required|min:6|max:18|regex:/^[A-Za-z0-9_-]{6,18}$/|unique:App\Models\TinyUrl'
    ];
  }

  public function messages(): array
  {
    return [
      'tiny_url.regex' => 'The :attribute may contain a-z, A-Z, 0-9, - and _',
    ];
  }
}
