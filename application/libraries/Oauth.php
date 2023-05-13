<?php 

class Oauth  {

    public $storage;
    public $server;
    private $dsn;
    private $username;
    private $password;

    public function __construct()
    {
        $this->dsn = get_env('DSN');
        $this->username = get_env('USERNAME');
        $this->password = get_env('PASSWORD');
        $this->init();
    }

    public function init()
    {
        OAuth2\Autoloader::register();
        $this->storage = new OAuth2\Storage\Pdo(array(
            'dsn' => $this->dsn, 
            'username' => $this->username, 
            'password' => $this->password
        ));
        $this->server = new OAuth2\Server($this->storage);

        // Add the "User Credentials" grant type (it is the simplest of the grant types)
        $this->server->addGrantType(new OAuth2\GrantType\UserCredentials($this->storage));

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $this->server->addGrantType(new OAuth2\GrantType\ClientCredentials($this->storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($this->storage));

    }

}

?>