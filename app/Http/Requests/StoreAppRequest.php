<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'title.*' => ['required' , 'string' ],
            'description' => ['required'],
            'description.*' => ['required' , 'string'],
            'extension' => ['required' , 'string'],
            'original_link' => ['required' , 'active_url'],
            'published_at' => ['required' , 'date_format:Y-m-d'],
            'size' => ['required' , 'string'],
            'category_id' => ['required' , 'exists:categories,id'],
            'tags' => ['required'],
            'category.*' => ['required' , 'exists:tags,id'],
            'os_type_id' => ['required' , 'exists:o_s_types,id'],
            'os_version_id' => ['required' , 'exists:o_s_versions,id'],
            'owner_id' => ['required' , 'exists:users,id'],
            'parts.*.size' => ['required' , 'string'],
            'parts.*.original_link' => ['required' , 'active_url'],
            'parts.*.extension' => ['required' , 'string'],
        ];
    }
}
