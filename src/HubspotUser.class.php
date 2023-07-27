<?php
    require get_template_directory() . '/vendor/autoload.php';
    use Curl\Curl;

    class HubspotUser {
        private $hubspot_api_key = '';
        private $utk_cookie;
        private $user = null;

        function __construct($api_key, $utk_cookie = 'hubspotutk') {
            $this->user = new stdClass();
            $this->hubspot_api_key = $api_key;
            $this->utk_cookie = $utk_cookie;

            if(!empty($api_key)) {
                $this->sync();
            }
        }

        function getUtk() {
            if($this->hasUtk()) {
                return $_COOKIE[$this->utk_cookie];
            }
            
            return null;
        }

        function hasUtk() {
            if(isset($_COOKIE[$this->utk_cookie]) && !empty($_COOKIE[$this->utk_cookie])) {
                return true;
            }

            return false;
        }

        function sync() {
            if($this->hasUtk()) {
                $hubspot_utk = $this->getUtk();

                $curl = new Curl();
                $curl->setHeader('Authorization', "Bearer $this->hubspot_api_key");
                $curl->get("https://api.hubapi.com/contacts/v1/contact/utk/$hubspot_utk/profile", ['property_mode' => 'value-only']);

                if(!$curl->error && $curl->response->properties->hs_is_contact->value != 'false') {
                    $this->user->name = new stdClass();

                    if(isset($curl->response->properties->firstname->value) && !empty($curl->response->properties->firstname->value)) {
                        $this->user->name->first = $curl->response->properties->firstname->value;
                        $this->user->name->full = $this->user->name->first;
                    }

                    if(isset($curl->response->properties->lastname->value) && !empty($curl->response->properties->lastname->value)) {
                        $this->user->name->last = $curl->response->properties->lastname->value;
                        $this->user->name->full = $this->user->name->first . ' ' . $this->user->name->last;
                    }

                    return true;
                }
            }

            return false;
        }

        function get($value) {
            if(isset($this->user->$value)) {
                return $this->user->$value;
            }

            return null;
        }

        function output() {
            ob_start();
            ?>
            <script>
                window.hubspot_user = JSON.parse('<?= json_encode($this->user) ?>');
            </script>
            <?php
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
        }
    }