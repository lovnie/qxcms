<?php
return [
   'captcha'  => [
         
        // 验证码字体大小(px)
        'fontSize' => 16,
        // 是否画混淆曲线
        'useCurve' => false,
        // 验证码图片高度
        'imageH'   => 35,
        // 验证码图片宽度
        'imageW'   => 66,
        // 验证码位数
        'length'   => 2,
        // 验证成功后是否重置
        'reset'    => true,
        'useNoise' =>false,
        'bg'       =>array(93, 202, 27)
    ]
];
?>