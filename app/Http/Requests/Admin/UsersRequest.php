<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UsersRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $model = $this->route('user');
        $passwordRule = $model ? ['nullable'] : ['required'];

        return [
            'name' => ['bail','required' , 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', Rule::unique(User::class)->ignore($model->id ?? null)],
            'password' => ['bail', ...$passwordRule, Password::defaults()],
            'passwordConfirmation' => ['bail', ...$passwordRule, 'same:password'],
            'roleId' => ['bail', 'required', Rule::exists(Role::class, 'id')],
        ];
    }
}
