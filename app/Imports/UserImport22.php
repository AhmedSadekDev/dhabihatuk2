<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport22 implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        return new User([
            'name' => $collection[0],
            'email' => $collection[1],
            'phone' => $collection[2],
            'password' => Hash::make($collection[3]),
            'lat' => $collection[4],
            'long' => $collection[5],
            'address' => $collection[6],
            'role_id' => 4,
        ]);
    }
}
