<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public $baseURL = 'http://localhost/Aplikasi_Agen-LPG-3KG/';
    public $indexPage = '';
    public $uriProtocol = 'REQUEST_URI';
    public $urlSuffix = '';
    public $defaultLocale = 'en';
    public $negotiateLocale = false;
    public $supportedLocales = ['en', 'id'];
    public $charset = 'UTF-8';
    public $subdirectory = '';

    public $sessionDriver = 'CodeIgniter\Session\Handlers\DatabaseHandler';
    public $sessionCookieName = 'ci_session';
    public $sessionExpiration = 7200;
    public $sessionSavePath = 'ci_sessions';
    public $sessionMatchIP = false;
    public $sessionTimeToUpdate = 300;
    public $sessionRegenerateDestroy = false;

    public $csrfProtection = true;
    public $csrfTokenName = 'csrf_test_name';
    public $csrfCookieName = 'csrf_cookie_name';
    public $csrfExpiration = 7200;
    public $csrfRegenerate = true;

    public $compressOutput = false;
    public $cacheDriver = 'file';
    public $cachePath = '';
    public $cacheTTL = 60;

    public $logThreshold = 4;
    public $logPath = '';
    public $logFileExtension = '';
    public $logFilePermissions = 0644;
    public $logDateFormat = 'Y-m-d H:i:s';

    public $errorViewPath = APPPATH . 'Views/errors/';
    public $errorLogPath = '';
    public $errorLogFilePermissions = 0644;

    public $emailProtocol = 'smtp';
    public $emailSMTPHost = 'localhost';
    public $emailSMTPUser = '';
    public $emailSMTPPass = '';
    public $emailSMTPPort = 25;
    public $emailSMTPTimeout = 5;
    public $emailMailType = 'text';
    public $emailCharset = 'UTF-8';
    public $emailWordWrap = true;

    public $encryptionKey = '';
    public $encryptionDriver = 'OpenSSL';
}