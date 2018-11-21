<?php
    if(!function_exists('ClassAutoLoader')){
        function ClassAutoLoader($class){
            //$class=strtolower($class);
            $classFile= dirname( __FILE__ ).'/class_'.$class.'.php';
            // echo "<script>console.log('".$classFile."')</script>";
            if(is_file($classFile)&&!class_exists($class)&&$class!="PayPal") include $classFile;
        }
    }
    spl_autoload_register('ClassAutoLoader');

?>
