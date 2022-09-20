<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
	protected $settings = [
		[
			'key'		=>	'site_name',
			'value'		=>	'E-Commerce App'
		],
		[
			'key'		=>	'site_title',
			'value'		=>	'E-Commerce'
		],
		[
			'key'		=>	'default_email_address',
			'value'		=>	'admin@admin.com'
		],
		[
			'key'		=>	'default_phone_number',
			'value'		=>	''
		],
		[
			'key'		=>	'default_site_address',
			'value'		=>	''
		],
		[
			'key'		=>	'currency_code',
			'value'		=>	'GBP'
		],
		[
			'key'		=>	'currency_symbol',
			'value'		=>	'£'
		],
		[
			'key'		=>	'site_logo',
			'value'		=>	''
		],
		[
			'key'		=>	'site_favicon',
			'value'		=>	''
		],
		[
			'key'		=>	'footer_copyright_text',
			'value'		=>	''
		],
		[
			'key'		=>	'seo_meta_title',
			'value'		=> 	''
		],
		[
			'key'		=>	'seo_meta_description',
			'value'		=>	''
		],
		[
			'key'		=> 'social_facebook',
			'value'		=> ''
		],
		[
			'key'		=> 'social_twitter',
			'value'		=> ''
		],
		[
			'key'		=> 'social_instagram',
			'value'		=> ''
		],
		[
			'key'		=> 'social_linkedin',
			'value'		=> ''
		],
		[
			'key'		=> 'google_analytics',
			'value'		=> ''
		],
		[
			'key'		=> 'facebook_pixels',
			'value'		=> ''
		],
		[
			'key'		=> 'square_payment_method',
			'value'		=> ''
		],
		[
			'key'		=> 'square-app-id',
			'value'		=> ''
		],
		[
			'key'		=> 'square-access-token',
			'value'		=> ''
		],
		[
			'key'		=> 'square-location-id',
			'value'		=> ''
		],
		[
			'key'		=> 'square-mode',
			'value'		=> ''
		],
		[
			'key'		=> 'paypal_payment_method',
			'value'		=> ''
		],
		[
			'key'		=> 'paypal_client_id',
			'value'		=> ''
		],
		[
			'key'		=> 'paypal_secret_id',
			'value'		=> ''
		],
		[
			'key'		=> 'paypal_mode',
			'value'		=> ''
		],
		[
			'key'		=> 'banner_width',
			'value'		=> ''
		],
		[
			'key'		=> 'banner_height',
			'value'		=> ''
		],
		[
			'key'		=> 'wishlist-items-limit',
			'value'		=> ''
		],
		[
			'key'		=> 'cat_img_width',
			'value'		=> ''
		],
		[
			'key'		=> 'product_image_width',
			'value'		=> ''
		],
		[
			'key'		=> 'product_thumb_img',
			'value'		=> ''
		],
		[
			'key'		=> 'contect_smtp_to_email',
			'value'		=> ''
		],
		[
			'key'		=> 'contect_smtp_mail_driver',
			'value'		=> ''
		],
		[
			'key'		=> 'contect_smtp_port',
			'value'		=> ''
		],
		[
			'key'		=> 'contect_smtp_host',
			'value'		=> ''
		],
		[
			'key'		=> 'contect_smtp_encryption',
			'value'		=> ''
		],
		[
			'key'		=> 'contect_smtp_user',
			'value'		=> ''
		],
		[
			'key'		=> 'contect_smtp_pass',
			'value'		=> ''
		],
		[
			'key'		=> 'blog_enabled',
			'value'		=> ''
		],
		[
			'key'		=> 'post_thumb_image_width',
			'value'		=> ''
		],
		[
			'key'		=> 'blog_featured_image',
			'value'		=> ''
		],
		[
			'key'		=> 'single_post_image_height',
			'value'		=> ''
		],
	];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->settings as $index => $setting){
    		$result = Setting::create($setting);
    		if(!$result){
    			$this->command->info("Insert failed at record $index. ");
    			return;
    		}
    	}
    	$this->command->info('Inserted '.count($this->settings). ' records');
    }
}
