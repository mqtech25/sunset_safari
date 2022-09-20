<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $mail = DB::table('settings')->whereIn('key', ['contect_smtp_mail_driver', 'contect_smtp_host', 'contect_smtp_port', 'contect_smtp_user', 'site_name', 'contect_smtp_encryption', 'contect_smtp_user', 'contect_smtp_pass'])->get()->keyBy('key');
        
        $config = [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
    |
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers to be used while
    | sending an e-mail. You will specify which one you are using for your
    | mailers below. You are free to add additional mailers as required.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses",
    |            "postmark", "log", "array"
    |
    */
    'mailers' => [
        'smtp' => [
            'driver' => $mail['contect_smtp_mail_driver']->value,
            'host' => $mail['contect_smtp_host']->value,
            'port' => $mail['contect_smtp_port']->value,
            'from' => array('address' => $mail['contect_smtp_user']->value, 'name' => $mail['site_name']->value),
            'encryption' => $mail['contect_smtp_encryption']->value,
            'username' => $mail['contect_smtp_user']->value,
            'password' => $mail['contect_smtp_pass']->value,
            'timeout' => null,
            'auth_mode' => null,
            'transport' => 'smtp',
        ],
        'ses' => [
            'transport' => 'ses',
        ],

        'mailgun' => [
            'transport' => 'mailgun',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => '/usr/sbin/sendmail -bs',
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
        
        // $config = array(
        //     'driver' => $mail['contect_smtp_mail_driver']->value,
        //     'host' => $mail['contect_smtp_host']->value,
        //     'port' => $mail['contect_smtp_port']->value,
        //     'from' => array('address' => $mail['contect_smtp_user']->value, 'name' => $mail['site_name']->value),
        //     'encryption' => $mail['contect_smtp_encryption']->value,
        //     'username' => $mail['contect_smtp_user']->value,
        //     'password' => $mail['contect_smtp_pass']->value,
        //     'sendmail' => '/usr/sbin/sendmail -bs',
        //     'pretend' => false,
        // );
        Config::set('mail', $config);
        // dd(Config::get('mail'));
    }
}
