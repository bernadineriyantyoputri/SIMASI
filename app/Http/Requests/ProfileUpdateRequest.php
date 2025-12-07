<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Rules validasi untuk update profil.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            // NPM – saat ini di-set HARUS 10 digit angka
            // kalau kamu mau NPM boleh 7–10 digit, ubah 'digits:10'
            // menjadi 'digits_between:7,10'
            'npm' => [
                'nullable',
                'digits:10',     // → wajib 10 digit
                'numeric',       // → hanya angka
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            // Validasi foto profil
            'photo' => [
                'nullable',
                'image',
                'max:2048',      // maksimal 2MB
            ],
        ];
    }
}
