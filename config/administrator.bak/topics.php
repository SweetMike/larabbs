<?php

use App\Models\Topic;

return [
    // 页面标题
    'title'   => '话题',

    // 模型单数，用作页面『新建 $single』
    'single'  => '话题',

    // 数据模型，用作数据的 CRUD
    'model'   => Topic::class,

    // 字段负责渲染『数据表格』，由无数的『列』组成，
    'columns' => [

        // 列的标示，这是一个最小化『列』信息配置的例子，读取的是模型里对应
        // 的属性的值，如 $model->id
        'id' => [
            'title' => 'ID',
        ],

        'title' => [
            // 数据表格里列的名称，默认会使用『列标识』
            'title'  => '话题',

            // 默认情况下会直接输出数据，你也可以使用 output 选项来定制输出内容
            'output' => function ($value, $model) {
                return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
            },

            // 是否允许排序
            'sortable' => false,
        ],

        'user' => [
            'title'    => '作者',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . $model->user->name;
                return model_link($value, $model);
            },
        ],

        'category' => [
            'title'    => '分类',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return model_admin_link($model->category->name, $model->category);
            },
        ],

        'reply_count' => [
            'title'    => '评论',
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'title' => [
            'title'    => '标题',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],
        'category' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
        'reply_count' => [
            'title'    => '评论',
        ],
        'view_count' => [
            'title'    => '查看',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => '内容 ID',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'category' => [
            'title'              => '分类',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
    ],
    'rules'   => [
        'title' => 'required'
    ],
    'messages' => [
        'title.required' => '请填写标题',
    ],
];