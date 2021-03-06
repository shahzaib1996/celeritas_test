<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentRequest extends FormRequest
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
            'comment' => ['required','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'Comment cannot be empty'
        ];
    }

    protected function getValidatorInstance() {
        $data = $this->all();
        $data['user_id'] = auth()->user()->id;
        
        $this->getInputSource()->replace($data);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }

}
