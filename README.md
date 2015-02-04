Yii2 News Modul
==================

###Dev-config
put this into your app/config/bootstrap.php

```
    \Yii::$container->set(
        'schmunk42\giiant\crud\providers\CallbackProvider',
        [
            'columnFormats' => [
    
                /**
                 * hide system fields in grid
                 */
                '^id$|created_at$|updated_at$' => function () {
                    return false;
                },
    
            ],
            'activeFields' => [
    
                /**
                 * hide system fields in grid
                 */
                '^id$|created_at$|updated_at$' => function () {
                    return false;
                },
    
            ]
        ]
    );
```
