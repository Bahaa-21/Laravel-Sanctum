<?php

namespace App\InterfaceRepository;



interface InterfaceAuthRepository
{
    public function register($file_path, $image_path, $data);
    public function login(array $data);
}
