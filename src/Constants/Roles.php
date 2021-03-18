<?php
/**
 * Created by IntelliJ IDEA.
 * User: tyaki
 * Date: 10/5/2018
 * Time: 4:05 PM
 */

namespace App\Constants;


class Roles
{
    public const ROLE_USER = "ROLE_USER";

    public const ROLE_ADMIN = "ROLE_ADMIN";

    public const ROLE_GOD = "ROLE_GOD";

    public const ALL = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
        self::ROLE_GOD
    ];
}