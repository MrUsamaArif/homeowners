<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NameProcessorTest extends TestCase
{
    public function testCsvUploadAndProcessing()
    {
        Storage::fake('uploads');

        $csvContent = "name\nMr John Smith\nMr and Mrs Smith\nMr J. Smith";
        $file = UploadedFile::fake()->createWithContent('test.csv', $csvContent);

        $response = $this->postJson('/upload-csv', [
            'csv_file' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            [
                'title' => 'Mr',
                'first_name' => 'John',
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => 'J',
                'last_name' => 'Smith'
            ]
        ]);
    }
}
