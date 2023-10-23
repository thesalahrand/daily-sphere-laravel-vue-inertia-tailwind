<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'pseudo_name_id' => [
        'required',
        Rule::unique('users')->ignore($this->user()->id),
        Rule::exists('pseudo_names', 'id')->where(function (Builder $query) {
          return $query->where('gender', $this->user()->pseudoName->gender);
        })
      ],
      'profile_pic' => ['nullable', 'max:1000', 'mimetypes:image/jpeg,image/png']
    ];
  }
}
