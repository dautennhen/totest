<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Book extends Model
{
    use ElasticquentTrait;
    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [
                'replace' => [
                    'type' => 'mapping',
                    'mappings' => [
                        '&=> and '
                    ],
                ],
            ],
            'filter' => [
                'word_delimiter' => [
                    'type' => 'word_delimiter',
                    'split_on_numerics' => false,
                    'split_on_case_change' => true,
                    'generate_word_parts' => true,
                    'generate_number_parts' => true,
                    'catenate_all' => true,
                    'preserve_original' => true,
                    'catenate_numbers' => true,
                ]
            ],
            'analyzer' => [
                'default' => [
                    'type' => 'custom',
                    'char_filter' => [
                        'html_strip',
                        'replace',
                    ],
                    'tokenizer' => 'whitespace',
                    'filter' => [
                        'lowercase',
                        'word_delimiter',
                    ],
                ],
            ],
        ],
    ];
    
    protected $mappingProperties = array(
        'title' => array(
             'type' => 'string',
             'analyzer' => 'standard'
         )
    );
    
    function getIndexName()
    {
        return 'custom_index_name';
    }
    
    function getTypeName()
    {
        return 'custom_type_name';
    }
}