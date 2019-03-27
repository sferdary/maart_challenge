<?php
require_once(DB);

class RealEstate
{
    private static $order_by = null;

    public static function upload($city, $country, $street, $number, $price, $description, $image)
    {
        $rawName = explode('.', $image['name']);
        $ext = strtolower(end($rawName));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $allowed)) {
            if ($image['error'] === 0) {
                if ($image['size'] < 2000000) {
                    $name = uniqid('', true) . ".$ext";
                    $target = UPLOADS . basename($name);
                    move_uploaded_file($image['tmp_name'], $target);
                    DB::insert(
                        "INSERT INTO realEstate VALUES (id, :city, :country, :street, :number, :price, :price_int, :description, :image)",
                        [
                            ":city"         => $city,
                            ":country"      => $country,
                            ":street"       => $street,
                            ":number"       => $number,
                            ":price"        => $price,
                            ":price_int"    => str_replace('.', '', $price),
                            ":description"  => $description,
                            ":image"        => $name,
                        ]
                    );
                    $msg = '&upload=success';
                } else {
                    $msg = '&error=fileTooLarge';
                }
            } else {
                $msg = '&error=uploadError';
            }
        } else {
            $msg = '&error=invalidFileType';
        }
        return header("Location:" . ROOT . "?url=dashboard$msg");
    }


    public static function search($sort_by)
    {
        if ($sort_by === 'price_asc') {
            self::$order_by = 'ORDER BY price_int ASC';
        } else if ($sort_by === 'price_desc') {
            self::$order_by = 'ORDER BY price_int DESC';
        } else if ($sort_by === 'country_asc') {
            self::$order_by = 'ORDER BY country ASC';
        } else if ($sort_by === 'country_desc') {
            self::$order_by = 'ORDER BY country DESC';
        }
    }


    public static function show()
    {
        $result = DB::select("SELECT * FROM realEstate " . self::$order_by . "");
        return $result;
    }
}