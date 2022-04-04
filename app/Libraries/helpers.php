<?php
use Illuminate\Support\Facades\File;

function timeAgoEnglish($timestamp){
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        return date('jS F Y, H:i', strtotime($timestamp));
    }
    else if($diff->m > 0){
        return date('jS F Y, H:i', strtotime($timestamp));
    }
    else if($diff->d > 0){
        return date('jS F Y, H:i', strtotime($timestamp));
    }
    else if($diff->h > 0){
        $timemsg = $diff->h .' hour'. ($diff->h > 1?"s":'');
    }
    else if($diff->i > 0){
        $timemsg = $diff->i .' minute'. ($diff->i > 1?"s":'');
    }
    else if($diff->s > 0){
        $timemsg = $diff->s .' second'. ($diff->s > 1?"s":'');
    }

    $timemsg = $timemsg.' ago';
    return $timemsg;
}

function timeAgoVietnam($timestamp){
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        return date('j/n/Y, H:i', strtotime($timestamp));
    }
    else if($diff->m > 0){
        return date('j/n/Y, H:i', strtotime($timestamp));
    }
    else if($diff->d > 0){
        return date('j/n/Y, H:i', strtotime($timestamp));
    }
    else if($diff->h > 0){
        $timemsg = $diff->h .' giờ trước';
    }
    else if($diff->i > 0){
        $timemsg = $diff->i .' phút trước';
    }
    else if($diff->s > 0){
        $timemsg = $diff->s .' giây trước';
    }
    return $timemsg;
}


if (!function_exists('formatMoney')) {
    function formatMoney($price, $currency): string
    {

        $price = str_replace('.', '', (int)$price);
        return number_format((float)$price, 0, ',', '.') . $currency;
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($number): string
    {
        $price = str_replace('.', '', $number);
        return number_format((float)$price, 0, ',', '.') ;
    }
}

if (!function_exists('createFolder')) {
    function createFolder($directory)
    {
        if (!File::exists($directory)){
            File::makeDirectory($directory, 0777);
        }
    }
}


if (! function_exists('avatar_url')) {
    /**
     * Returns the avatar URL of a user.
     *
     * @param $user
     *
     * @return string
     */
    function avatar_url($userName)
    {
        return 'https://ui-avatars.com/api/?size=128&background=E64D23&color=fff&name='.$userName;
    }
}


if (! function_exists('round_star')){
    function round_star($number){
        $integer = (int)$number;

        if ($number - $integer != 0.5){
            return round($number);
        }
        return $number;
    }
}


if (!function_exists('inValidInput')){
    function inValidInput($key, $errors){
        return $errors->has($key);
    }
}

if (!function_exists('getErrorInput')){
    function getErrorValInput($key, $errors){
        return $errors->first($key);
    }
}

if (!function_exists('renderTemplateError')){
    function renderTemplateError($key, $errors): string
    {
        if (inValidInput($key, $errors)){
            return '<div class="feedback-error">' . getErrorValInput($key, $errors) . '</div>';
        }
        return '';
    }
}

if (!function_exists('getOldErrorInput')){
    function getOldErrorInput($key, $defaultValue = ''){
        return old($key) ?? $defaultValue;
    }
}


if (!function_exists('formatMoneyComma')) {
    function formatMoneyComma($price, $currency): string
    {

        $price = str_replace('.', '', (int)$price);
        return number_format((float)$price, 0, '.', ',') . $currency;
    }
}


if (!function_exists('calculatePercentDiscount')){
    function calculatePercentDiscount($product): int
    {
        $sizeProductFirst = $product->sizes->first();
        return ceil((1 - ($sizeProductFirst->price_sell / $sizeProductFirst->price_marketing)) * 100);
    }
}

if (!function_exists('isAttributeModelExists')){
    function isAttributeModelExists(\Illuminate\Database\Eloquent\Model $model): int
    {
        return $model->exists;
    }
}

if (!function_exists('sizeProductFirst')){
    function sizeProductFirst($product)
    {
        return $product->sizes->first();
    }
}

if (!function_exists('sizeProductByIdSize')){
    function sizeProductByIdSize($product, $idSize)
    {
        return $product->sizes->where('id', $idSize)->first();
    }
}

