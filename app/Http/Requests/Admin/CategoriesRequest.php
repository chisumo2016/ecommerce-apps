<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriesRequest extends FormRequest
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
        $model = $this->route('category');
        return [
            'parentId'  => ['bail', 'nullable', 'integer', Rule::exists(Category::class, 'id')->whereNull('parent_id')],
            'name'      => ['bail', 'required', 'string', 'max:255'],
            'slug'      => ['bail', 'required', 'string', 'max:255', Rule::unique(Category::class)->ignore($model->id ?? null)],
            'active'    => ['bail', 'boolean'],
        ];
    }
}
