<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class CsvFileService
{

    /**
     * Salva um arquivo CSV na pasta especificada
     *
     * @param string $folderSave Pasta onde o arquivo será salvo
     * @param \Illuminate\Http\UploadedFile $file Arquivo a ser salvo
     * @return array Informações do arquivo salvo
     */
    public function saveFile(string $folderSave, UploadedFile $file): array
    {
        $filename = Hash::make($file->getClientOriginalName()) . '.csv';
        $file->storeAs($folderSave, $filename, 'public');

        $path = storage_path("app/public/{$folderSave}/{$filename}");

        $reader = Reader::createFromPath($path)
            ->setDelimiter(';')
            ->setHeaderOffset(0);

        $numRows = count($reader);
        $offset = ceil($numRows / 1000);

        return [
            'filename' => $filename,
            'offset' => $offset,
        ];
    }

}

