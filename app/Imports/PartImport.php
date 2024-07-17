<?php

namespace App\Imports;

use App\Models\Part;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Maatwebsite\Excel\Concerns\ToModel;

class PartImport implements ToModel,WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Part([
            //
            'gudang_id'     => $row[0],
            'no_part'       => $row[1],
            'nama_barang'   => $row[2],
            'deskripsi'     => $row[3],
            'stok'          => $row[4],
            'jenis_barang'  => $row[5],
            'barcode'       => $row[6],
        ]);
    }
}
