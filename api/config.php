<?php
class Config
{
    const DATE_FORMAT = "Y-m-d H:i:s";
    const JWT_SECRET = "dk*M6spn7qk6b$<5";
    const JWT_TOKEN_TIME = 604800;

    // DB connection
    public static function DB_HOST()
    {
        return Config::get_env("DB_HOST", null);
    }
    public static function DB_USERNAME()
    {
        return Config::get_env("DB_USERNAME", null);
    }
    public static function DB_PASSWORD()
    {
        return Config::get_env("DB_PASSWORD", null);
    }
    public static function DB_SCHEME()
    {
        return Config::get_env("DB_SCHEME", null);
    }
    public static function DB_PORT()
    {
        return Config::get_env("DB_PORT", null);
    }

    // mail provider
    public static function SMTP_HOST()
    {
        return Config::get_env("SMTP_HOST", "smtp.gmail.com");
    }
    public static function SMTP_PORT()
    {
        return Config::get_env("SMTP_PORT", "587");
    }
    public static function SMTP_USER()
    {
        return Config::get_env("SMTP_USER", null);
    }
    public static function SMTP_PASSWORD()
    {
        return Config::get_env("SMTP_PASSWORD", null);
    }

    // spaces
    public static function SPACES_KEY()
    {
        return Config::get_env("SPACES_KEY", null);
    }
    public static function SPACES_SECRET()
    {
        return Config::get_env("SPACES_SECRET", null);
    }

    // environment servers setup
    public static function ENVIRONMENT_SERVER()
    {
        return Config::get_env("ENVIRONMENT_SERVER", "localhost/cardiaries/");
    }
    public static function PROTOCOL()
    {
        return strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))).'://';
    }

    public static function get_env($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
}
