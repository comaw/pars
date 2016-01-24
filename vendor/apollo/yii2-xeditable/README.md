#X-editable for yii2 trial. Provide only basis functionality. Not stable
Usage:
```php
 echo GridView::widget([
 .....
 'columns' => [
 ......
 [
                     'value'=>function($data) {

                             if(empty($data->is_active))
                             {
                                 return Yii::t('app','No');
                             }

                             return Yii::t('app','Yes');
                         },
                     'class' => \Apollo\EditableColumn::className(),
                     'dataType'=>'select',
                     'url'=>Yii::$app->urlManager->createUrl('/users/changeStatus'),
                     'editable'=>[

                         'source'=>[
                             ['value'=>1,
                             'text'=>Yii::t('app','Yes')],
                             ['value'=>0,
                             'text'=>Yii::t('app','No')]
                         ],

                     ],

                     'attribute' => 'is_active',
                     'format' => 'raw',
                     'filter' => ['1' => Yii::t('app', 'Yes'),'0' => Yii::t('app', 'No'),],

                 ],
                 .....
                 ]
                 .....
                 ]);
```



