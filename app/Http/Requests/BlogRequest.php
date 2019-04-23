<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo('ADMINISTRATOR_ACCESS');

    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('banner', 'required', function($input)
        {

            if(!empty($input->banner)) {
                return TRUE;
            }
            if($this->route()->hasParameter('blog')) {
                $model = $this->route()->parameter('blog');
                return empty($model->banner);
            }

            return TRUE;
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = (isset($this->route()->parameter('blog')->id)) ? $this->route()->parameter('blog')->id : '';
        return [
            'titleH1' => "required|string",
            'title' => "required|string",
            'text' => "required",
            'alias' => "required|unique:blogs,alias,".$id
        ];
    }
}
