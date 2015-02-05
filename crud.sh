#!/bin/bash
./yii giiant-batch --interactive=0 --overwrite=1 \
--tables=dmstr_news,dmstr_text_block,dmstr_image_gallery,dmstr_image,dmstr_video_gallery,dmstr_video \
--tablePrefix=dmstr_ \
--enableI18N=1 \
--modelNamespace=dmstr\\modules\\news\\models \
--crudControllerNamespace=dmstr\\modules\\news\\controllers \
--crudSearchModelNamespace=dmstr\\modules\\news\\models\\search \
--crudPathPrefix= \
--messageCategory=app \
--crudViewPath=@app/vendor/dmstr/yii2-news-module/views \
--crudProviders=hrzg\\moxiecode\\moxiemanager\\providers\\Provider,schmunk42\\giiant\\crud\\providers\\CallbackProvider,dmstr\\modules\\news\\providers\\EditorProvider,dmstr\\modules\\news\\providers\\DateTimeProvider \
--modelBaseClass=dmstr\\modules\\news\\models\\ActiveRecord
