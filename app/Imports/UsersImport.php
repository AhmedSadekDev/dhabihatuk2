<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make($row['password']),
            'lat' => $row['lat'],
            'long' => $row['long'],
            'address' => $row['address'],
            'twitter' => $row['twitter'],
            'role_id' => 4,
        ]);
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['nullable', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required'],
            'lat' => ['required'],
            'long' => ['required'],
            'address' => ['required', 'string'],
            'twitter' => ['nullable', 'string'],
        ];
    }
}
