<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => '账户或密码错误！',
    'throttle' => '错误登录次数太多，请过 :seconds 后重试。',
    'confirmation' => [
        'resend' => '您的帐户未确认。 请点击您的电子邮件中的确认链接，或<a href="'.route('frontend.auth.account.confirm.resend', ':user_id').'">点击此处</a>重新发送确认电子邮件。'
    ],
    'deactivated' => '您的帐户已停用。'

];
