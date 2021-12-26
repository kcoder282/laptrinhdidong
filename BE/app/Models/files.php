<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    use HasFactory;
    public static function compile($code)
    {
        $myfile = fopen("tmpCode.cpp", "w");
        fwrite($myfile, $code);
        fclose($myfile);
        $error = shell_exec("g++ -o tmpcodec.exe tmpCode.cpp 2>&1");
        unlink("tmpCode.cpp");
        return $error;
    }

    public static function RunCode($input)
    {

        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "w"),
        );

        $process = proc_open("tmpcodec 2>&1", $descriptorspec, $pipes);
        if (is_resource($process)) {
            fwrite($pipes[0], str_replace(";", "\n", $input));
            fclose($pipes[0]);
            $print = '';
            while (!feof($pipes[1])) {
                $print .= fgets($pipes[1]);
            }
        }

        proc_close($process);


        return $print ?? "";
    }
}
