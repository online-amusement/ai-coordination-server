仮登録しました。<br>
このメールの有効期限は{{ $expiration_date }}です。<br>
本登録するには下記URLからプロフィールを登録して送信してくださいますようお願い申し上げます。<br>
<a href="{{ env('APP_FRONT_URL')}}/registration/profile?token={{ $token }}">{{ env('APP_FRONT_URL')}}/registration/verify?token={{ $token }}</a>

