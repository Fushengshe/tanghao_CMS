<?php
namespace kj1;
header("contant-type:text/html;charset=utf-8");
function summ(){
    echo '123';
}
namespace kj2;
function summ(){
    echo '456';
}

namespace kj3;
function summ(){
    echo '789';
}

\kj1\summ();