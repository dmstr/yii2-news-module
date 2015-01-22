#!/bin/bash
./yii giiant-batch --interactive=0 --overwrite=1 \
--tables=dmstr_news,dmstr_text_block,dmstr_image_gallery,dmstr_image,dmstr_video_gallery,dmstr_video \
--tablePrefix=dmstr_ \
--modelNamespace=dmstr\\news\\models \
--crudControllerNamespace=dmstr\\news\\controllers \
--crudProviders=hrzg\\moxiecode\\moxiemanager\\providers\\Provider,dmstr\\news\\providers\\EditorProvider,dmstr\\news\\providers\\FieldProvider,dmstr\\news\\providers\\DateTimeProvider,dmstr\\news\\providers\\OptsProvider,dmstr\\news\\providers\\RelationProvider \
--modelBaseClass=dmstr\\news\\models\\ActiveRecord
