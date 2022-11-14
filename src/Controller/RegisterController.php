<?php

namespace App\Controller;

use App\Annotation\ControllerMapping;
use App\Annotation\RequestBodyVariable;
use App\Annotation\RequestMapping;
use App\Service\RegisterService;
use Exception;

/**
 * @ControllerMapping(classMapping="/register")
 */
class RegisterController implements Controller
{
    private RegisterService $registerService;

    public function __construct()
    {
        $this->registerService = new RegisterService();
    }

    /**
     * @param string $userJson
     *
     * @return string
     *
     * @RequestMapping(path="/register", method="POST")
     * @RequestBodyVariable(variableName="userJson")
     * @throws Exception
     */
    public function register(string $userJson): string
    {
        return $this->registerService->register($userJson);
    }
}
