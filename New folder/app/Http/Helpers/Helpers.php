<?php
function Replace($data) {
    $data = str_replace("!", "", trim($data));
    $data = str_replace("@", "", trim($data));
    $data = str_replace("#", "", trim($data));
    $data = str_replace("$", "", trim($data));
    $data = str_replace("%", "", trim($data));
    $data = str_replace("^", "", trim($data));
    $data = str_replace("&", "", trim($data));
    $data = str_replace("*", "", trim($data));
    $data = str_replace("(", "", trim($data));
    $data = str_replace(")", "", trim($data));
    $data = str_replace("?", "", trim($data));
    $data = str_replace("+", "", trim($data));
    $data = str_replace("=", "", trim($data));
    $data = str_replace(",", "", trim($data));
    $data = str_replace(":", "", trim($data));
    $data = str_replace(";", "", trim($data));
    $data = str_replace("|", "", trim($data));
    $data = str_replace("'", "", trim($data));
    $data = str_replace('"', "", trim($data));
    $data = str_replace("  ", "-", trim($data));
    $data = str_replace(" ", "-", trim($data));
    $data = str_replace(".", "", trim($data));
    $data = str_replace("__", "-", trim($data));
    $data = str_replace("_", "-", trim($data));
    return strtolower($data);
 }

 function makeSlug($string) {
    $data = preg_replace('/\s+/u', '-', trim($string));

     return $data;
}


function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
    $secret_key = 'beatnik#technolgoy_sampreeti';
    $secret_iv = 'beatnik$technolgoy@sampreeti';

        // hash
    $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
            //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

// function imageOptimizer ($path){
//     $type = pathinfo($path, PATHINFO_EXTENSION);
//     $data = file_get_contents($path);
//     $base64_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
//     return $base64_image;
// }


function banglaDate($date){
    $englishDate = $date;

    $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December","Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", ":", ",");

    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বার", "অক্টোবার", "নভেম্বার", "ডিসেম্বার","জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বার", "অক্টোবার", "নভেম্বার", "ডিসেম্বার", "ঃ", ",");

    $bng_date = str_replace($search_array, $replace_array, $englishDate);
    return $bng_date;
}

function banglaNumber($number){
    $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", ":", ",");

    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", ":", ",");

    $bng_number = str_replace($search_array, $replace_array, $number);
    return $bng_number;
}




// The function to count words in Unicode  strings
function countUnicodeWords( $unicode_string ){
  // First remove all the punctuation marks & digits
  $unicode_string = preg_replace('/[[:punct:][:digit:]]/', '', $unicode_string);
  // Now replace all the whitespaces (tabs, new lines, multiple spaces) by single space
  $unicode_string = preg_replace('/[[:space:]]/', ' ', $unicode_string);
  // The words are now separated by single spaces and can be splitted to an array
  // I have included \n\r\t here as well, but only space will also suffice
  $words_array = preg_split( "/[\n\r\t ]+/", $unicode_string, 0, PREG_SPLIT_NO_EMPTY );
  // Now we can get the word count by counting array elments
  return count($words_array);
}

function limitWordShow($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

function urlLink($prefix, $data, $lag){
    if($lag){
        if($data->slug_bn != null || $data->slug_bn != ''){
            return URL::to("$prefix")."/".Replace($data->slug_bn)."/".$data->id;
        }else{
            if($data->title_bn != '' || $data->title_bn != null){
                return URL::to("$prefix")."/".Replace($data->title_bn)."/".$data->id;
            }else{
                return URL::to("$prefix")."/".Replace($data->title_en)."/".$data->id;
            }
        }
    }else{
        if($data->slug_en != null || $data->slug_en != ''){
            return URL::to("en/$prefix")."/".Replace($data->slug_en)."/".$data->id;
        }else{
            if($data->title_en != '' || $data->title_en != null){
                return URL::to("en/$prefix")."/".Replace($data->title_en)."/".$data->id;
            }else{
                return URL::to("en/$prefix")."/".Replace($data->title_en)."/".$data->id;
            }
        }
    }
}
