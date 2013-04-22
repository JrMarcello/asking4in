<?php
/**
 * Description of SignedRequestComponent
 *
 * @author Livio
 */

App::uses('Component', 'Controller');

class SignedRequestComponent extends Component {
    
    private $secret;
    
    public function __construct(\ComponentCollection $collection, $settings = array()) {
        parent::__construct($collection, $settings);
        
        $this->secret = Configure::read('Facebook.secret');
    }
    
    private function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }
    
    private function parse_signed_request($signed_request, $secret) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            error_log('Unknown algorithm. Expected HMAC-SHA256');
            return null;
        }

        // check sig
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }
    
    public function decode($signed_request) {
        return $this->parse_signed_request($signed_request, $this->secret);
    }
}

?>
