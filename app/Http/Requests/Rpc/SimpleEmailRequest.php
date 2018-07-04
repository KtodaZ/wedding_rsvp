<?php namespace App\Http\Requests\Rpc;


use Illuminate\Foundation\Http\FormRequest;

class SimpleEmailRequest extends FormRequest
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
            'test'    => 'boolean',
            'subject' => 'required|string',
            'body'    => 'required|string',
            'links'   => 'json',
        ];
    }


}