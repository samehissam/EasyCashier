 <?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            // 'dsn' => 'mysql:host=db4free.net;port=3306;dbname=cashierdb',
            //    'username' => 'samissam',
            //    'password' => 'Sa449954',

            'dsn' => 'mysql:host=localhost;dbname=cashier',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];


