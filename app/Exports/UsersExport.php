<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Collection;

class UsersExport implements FromCollection, WithHeadings
{

    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

        public function collection()
        {
            return new Collection(
             $this->data
            );
        }

        public function headings(): array
        {
            return [
                    'Name',
                    'LastName',
                    'Email',
                    'phone',
                    'password',
                    'longitude',
                    'latitude'

                    ];
        }
    }
