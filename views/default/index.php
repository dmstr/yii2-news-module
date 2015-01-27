<div class="news-default-index">
    <?= dmstr\news\widgets\DashboardWidget::widget(
        [
            'box_info'  => dmstr\news\models\News::find()->count(),
            'box_title' => 'News',
            'box_style' => 'light-blue-gradient',
            'bg_icon'   => 'ion-android-drawer',
            'link_text' => 'Verwalten',
            'rel_url'   => '../news/news',
            'col_xs'   => '12',
            'col_md'   => '6',
            'col_lg'   => '4',
        ]
    );
    ?>
    <?= dmstr\news\widgets\DashboardWidget::widget(
        [
            'box_info'  => dmstr\news\models\TextBlock::find()->count(),
            'box_title' => 'TextBlock',
            'box_style' => 'light-blue-gradient',
            'bg_icon'   => 'ion-android-drawer',
            'link_text' => 'Verwalten',
            'rel_url'   => '../news/text-block',
            'col_xs'   => '12',
            'col_md'   => '6',
            'col_lg'   => '4',
        ]
    );
    ?>
    <?= dmstr\news\widgets\DashboardWidget::widget(
        [
            'box_info'  => dmstr\news\models\VideoGallery::find()->count(),
            'box_title' => 'VideoGallery',
            'box_style' => 'light-blue-gradient',
            'bg_icon'   => 'ion-android-drawer',
            'link_text' => 'Verwalten',
            'rel_url'   => '../news/video-gallery',
            'col_xs'   => '12',
            'col_md'   => '6',
            'col_lg'   => '4',
        ]
    );
    ?>
    <?= dmstr\news\widgets\DashboardWidget::widget(
        [
            'box_info'  => dmstr\news\models\ImageGallery::find()->count(),
            'box_title' => 'ImageGallery',
            'box_style' => 'light-blue-gradient',
            'bg_icon'   => 'ion-android-drawer',
            'link_text' => 'Verwalten',
            'rel_url'   => '../news/image-gallery',
            'col_xs'   => '12',
            'col_md'   => '6',
            'col_lg'   => '4',
        ]
    );
    ?>
    </div>
