[![Latest Stable Version](https://poser.pugx.org/arrilot/bitrix-tankers/v/stable.svg)](https://packagist.org/packages/arrilot/bitrix-tankers/)

# Мост для интеграции `arrilot/tankers` с 1C-Bitrix (В разработке)

## Установка

```composer require arrilot/bitrix-tankers```

## Использование

Основа - [https://www.github.com/arrilot/tankers](https://www.github.com/arrilot/tankers)

Данный пакет реализует несколько наиболее востребованных в Битриксе Заправщиков (Tankers) 

1. `Arrilot\BitrixTanker\FileTanker` - FileTable::getList
2. WIP `Arrilot\BitrixTanker\SectionTanker` - CIBlockSection::GetList
3. WIP `Arrilot\BitrixTanker\ElementTanker` - CIBlockElement::GetList
4. `Arrilot\BitrixTanker\UserTanker` - UserTable::getList
5. WIP `Arrilot\BitrixTanker\TableTanker` - произвольная таблица (например от Highload-блока)

Все танкеры поддерживают `$config['select']`, в котором можно указать массив `$arSelect`.

Для `ElementTanker` в `$config['select']` можно указать `PROPS` как одно из значений массива.
В этом случае будут выбраны все свойства элемента.

Для примера рассмотрим `FileTanker`
```php
    use Arrilot\BitrixTanker\FileTanker;

    $elements = [
        ['ID' => 1, 'PROPERTY_FILES_VALUE' => 1],
        ['ID' => 2, 'PROPERTY_FILES_VALUE' => [2, 1]],
    ];
    
    $tanker = new FileTanker();
    $tanker->collection($elements)->fields('PROPERTY_FILES_VALUE')->fill();
    
    // результат
    /*
        array:2 [▼
          0 => array:3 [▼
            "ID" => 1
            "PROPERTY_FILES_VALUE" => 1
            "PROPERTY_FILES_VALUE_DATA" => array:13 [▼
              "ID" => "1"
              "TIMESTAMP_X" => "2017-02-10 17:35:17"
              "MODULE_ID" => "iblock"
              "HEIGHT" => "150"
              "WIDTH" => "140"
              "FILE_SIZE" => "15003"
              "CONTENT_TYPE" => "image/png"
              "SUBDIR" => "iblock/b03"
              "FILE_NAME" => "avatar.png"
              "ORIGINAL_NAME" => "avatar-gs.png"
              "DESCRIPTION" => ""
              "HANDLER_ID" => null
              "EXTERNAL_ID" => "125dc3213f7ecde31124f3ebca7322b5"
            ]
          ]
          1 => array:3 [▼
            "ID" => 2
            "PROPERTY_FILES_VALUE" => array:2 [▶]
            "PROPERTY_FILES_VALUE_DATA" => array:2 [▼
              2 => array:13 [▼
                "ID" => "2"
                "TIMESTAMP_X" => "2017-02-10 17:35:30"
                "MODULE_ID" => "iblock"
                "HEIGHT" => "84"
                "WIDTH" => "460"
                "FILE_SIZE" => "4564"
                "CONTENT_TYPE" => "image/png"
                "SUBDIR" => "iblock/fcf"
                "FILE_NAME" => "4881-03.png"
                "ORIGINAL_NAME" => "4881-03.png"
                "DESCRIPTION" => ""
                "HANDLER_ID" => null
                "EXTERNAL_ID" => "35906df62694b4ed5f150c468a1f5d72"
              ]
              1 => array:13 [▼
                "ID" => "1"
                "TIMESTAMP_X" => "2017-02-10 17:35:17"
                "MODULE_ID" => "iblock"
                "HEIGHT" => "150"
                "WIDTH" => "140"
                "FILE_SIZE" => "15003"
                "CONTENT_TYPE" => "image/png"
                "SUBDIR" => "iblock/b03"
                "FILE_NAME" => "avatar.png"
                "ORIGINAL_NAME" => "avatar.png"
                "DESCRIPTION" => ""
                "HANDLER_ID" => null
                "EXTERNAL_ID" => "125dc3213f7ecde31124f3ebca7322b5"
              ]
            ]
          ]
        ]
    */
```