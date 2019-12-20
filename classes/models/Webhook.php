<?php

require_once _PS_MODULE_DIR_ . 'centry_ps_esclavo/classes/ConfigurationCentry.php';
require_once _PS_MODULE_DIR_ . 'centry_ps_esclavo/classes/AuthorizationCentry.php';


class WebhookCentry
{
    public $id;
    public $callback_url;
    public $on_product_save;
    public $on_product_delete;
    public $on_order_save;
    public $on_order_delete;

    public function __construct($callback_url=null, $on_product_save=true, $on_product_delete=true, $on_order_save=true, $on_order_delete=true){
        $this->callback_url = $callback_url;
        $this->on_product_save = $on_product_save;
        $this->on_product_delete = $on_product_delete;
        $this->on_order_save = $on_order_save;
        $this->on_order_delete = $on_order_delete;
    }

    public function createCentryWebhook()
    {
        if((ConfigurationCentry::getSyncAuthSecretId() == false || ConfigurationCentry::getSyncAuthSecretId() == false) ||
            (empty($this->callback_url)) ||
            ($this->on_product_save == false && $this->on_product_delete == false && $this->on_order_save == false && $this->on_order_delete == false)){
            return false;
        }
        else{
            $centry = new AuthorizationCentry();

            $endpoint = "conexion/v1/webhooks.json ";
            $method = "POST";
            $payload = array(
                "callback_url"=> $this->callback_url,
                "on_product_save" => $this->on_product_save,
                "on_product_delete" => $this->on_product_delete,
                "on_order_save" => $this->on_order_save,
                "on_order_delete" => $this->on_order_delete,
            );

            $resp = $centry->sdk()->request($endpoint, $method, null, $payload);
            //TODO: guardar id Centry
            return true;
        }
    }

    public function getCentryWebhook()
    {
        //TODO: Obtener id de Centry
        $centry_id = "5dfcfdd0ce4247131f3a8837";
        $centry = new AuthorizationCentry();

        $endpoint = "conexion/v1/webhooks/" . $centry_id . ".json ";
        $method = "GET";
        $resp = $centry->sdk()->request($endpoint, $method);
        error_log(print_r($resp, true));
        // TODO: Verificar request exitoso
        $this->callback_url = $resp->callback_url;
        $this->on_product_save = $resp->on_product_save;
        $this->on_product_delete = $resp->on_product_delete;
        $this->on_order_save = $resp->on_order_save;
        $this->on_order_delete = $resp->on_order_delete;
        return true;
    }

    public function updateCentryWebhook()
    {
        if((ConfigurationCentry::getSyncAuthSecretId() == false || ConfigurationCentry::getSyncAuthSecretId() == false) ||
            (empty($this->callback_url)) ||
            ($this->on_product_save == false && $this->on_product_delete == false && $this->on_order_save == false && $this->on_order_delete == false)){
            return false;
        }
        else{
            //TODO: obtener id Centry
            $centry_id = "5dfcfe33887072131c014f9c";
            $centry = new AuthorizationCentry();

            $endpoint = "conexion/v1/webhooks/" . $centry_id . ".json ";
            $method = "PUT";
            $payload = array(
                "callback_url"=> $this->callback_url,
                "on_product_save" => $this->on_product_save,
                "on_product_delete" => $this->on_product_delete,
                "on_order_save" => $this->on_order_save,
                "on_order_delete" => $this->on_order_delete,
            );
            $centry->sdk()->request($endpoint, $method, null, $payload);
            return true;
        }
    }

    public static function deleteCentryWebhook(){
        if(ConfigurationCentry::getSyncAuthSecretId() == false || ConfigurationCentry::getSyncAuthSecretId() == false){
            return false;
        }
        else{
            //TODO: obtener id Centry
            $centry_id = "5dfcfe33887072131c014f9c";
            $centry = new AuthorizationCentry();

            $endpoint = "conexion/v1/webhooks/" . $centry_id . ".json ";
            $method = "DELETE";
            $resp = $centry->sdk()->request($endpoint, $method);
            //TODO: eliminar registro de la BD
            return true;
        }
    }
}