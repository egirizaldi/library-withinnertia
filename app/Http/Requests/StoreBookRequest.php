<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   $currentYear = date('Y');
        return [
            'judul' => 'required|string|max:255',
            'penulis'=> 'required|string|max:255',
            'penerbit'=> 'required|string|max:255',
            'tahun_terbit'=> 'required|integer|min:1900|max:'.$currentYear,
            'stok'=> 'required|integer|min:0',
        ];
    }

    public function messages():array
    {
        return [
            'judul.required' => 'Judul buku harus diisi.',
            'judul.string' => 'Judul buku harus berupa teks.',
            'judul.max' => 'Judul buku tidak boleh lebih dari 255 karakter.',
            'penulis.required' => 'Nama penulis harus diisi.',
            'penulis.string' => 'Nama penulis harus berupa teks.',
            'penulis.max' => 'Nama penulis tidak boleh lebih dari 255 karakter.',
            'penerbit.required' => 'Nama penerbit harus diisi.',
            'penerbit.string' => 'Nama penerbit harus berupa teks.',
            'penerbit.max' => 'Nama penerbit tidak boleh lebih dari 255 karakter.',
            'tahun_terbit.required' => 'Tahun terbit harus diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min' => "Tahun terbit tidak boleh kurang dari 1900.",
            'stok.required' => 'Stok buku harus diisi.',
            'stok.integer' => 'Stok buku harus berupa angka.',
            'stok.min' => "Stok buku tidak boleh kurang dari 0.",

        ];
    }
}
