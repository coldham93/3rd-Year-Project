<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class BookRequest extends Request {

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
		switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'book.image' => 'required|image|mimes:jpeg,jpg',
                    'book.title' => 'required|max:255',
                    'book.author' => 'required|max:255',
                    'book.subject_id' => 'required|exists:subjects,id',
                    'book.isbn' => 'required|isbn',
                    'book.description' => 'required|max:420'
                ];
            }
            default:break;
        }
	}
    
    public function messages()
    {
        return [
            'book.image.required' => 'The book\'s image is required.',
            'book.image.image' => 'The book\'s image must be a file of type: jpeg, jpg.',
            'book.image.mimes' => 'The book\'s image must be a file of type: jpeg, jpg.',
            'book.title.required' => 'The book\'s title is required.',
            'book.title.max' => 'The book\'s title is too long.',
            'book.author.required' => 'The book\'s author is required.',
            'book.author.max' => 'The book\'s author is too long.',
            'book.subject_id.required' => 'The book\'s subject is required.',
            'book.isbn.required' => 'The book\'s ISBN is required.',
            'book.isbn.isbn' => 'The book\'s ISBN must be a valid International Standard Book Number (ISBN).',
            'book.description.required' => 'The book\'s description is required.',
            'book.description.max' => 'Theb book\'s description is too long.'
        ];
    }

}
