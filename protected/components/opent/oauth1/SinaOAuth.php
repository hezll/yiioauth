<?php 

date_default_timezone_set('Asia/Chongqing');

/* 
 * Code based on: 
 * Abraham Williams (abraham@abrah.am) http://abrah.am 
 */ 

/* Load OAuth lib. You can find it at http://oauth.net */ 
/** 
 * @ignore 
 */ 
class OAuthException extends Exception { 
    // pass 
} 


/** 
 * @ignore 
 */ 



/** 
 * @ignore 
 */ 
class OAuthSignatureMethod_PLAINTEXT extends OAuthSignatureMethod { 
    public function get_name() { 
        return "PLAINTEXT"; 
    } 

    public function build_signature($request, $consumer, $token) { 
        $sig = array( 
            OAuthUtil::urlencode_rfc3986($consumer->secret) 
        ); 

        if ($token) { 
            array_push($sig, OAuthUtil::urlencode_rfc3986($token->secret)); 
        } else { 
            array_push($sig, ''); 
        } 

        $raw = implode("&", $sig); 
        // for debug purposes 
        $request->base_string = $raw; 

        return OAuthUtil::urlencode_rfc3986($raw); 
    } 
} 

/** 
 * @ignore 
 */ 
class OAuthSignatureMethod_RSA_SHA1 extends OAuthSignatureMethod { 
    public function get_name() { 
        return "RSA-SHA1"; 
    } 

    protected function fetch_public_cert(&$request) { 
        // not implemented yet, ideas are: 
        // (1) do a lookup in a table of trusted certs keyed off of consumer 
        // (2) fetch via http using a url provided by the requester 
        // (3) some sort of specific discovery code based on request 
        // 
        // either way should return a string representation of the certificate 
        throw Exception("fetch_public_cert not implemented"); 
    } 

    protected function fetch_private_cert(&$request) { 
        // not implemented yet, ideas are: 
        // (1) do a lookup in a table of trusted certs keyed off of consumer 
        // 
        // either way should return a string representation of the certificate 
        throw Exception("fetch_private_cert not implemented"); 
    } 

    public function build_signature(&$request, $consumer, $token) { 
        $base_string = $request->get_signature_base_string(); 
        $request->base_string = $base_string; 

        // Fetch the private key cert based on the request 
        $cert = $this->fetch_private_cert($request); 

        // Pull the private key ID from the certificate 
        $privatekeyid = openssl_get_privatekey($cert); 

        // Sign using the key 
        $ok = openssl_sign($base_string, $signature, $privatekeyid); 

        // Release the key resource 
        openssl_free_key($privatekeyid); 

        return base64_encode($signature); 
    } 

    public function check_signature(&$request, $consumer, $token, $signature) { 
        $decoded_sig = base64_decode($signature); 

        $base_string = $request->get_signature_base_string(); 

        // Fetch the public key cert based on the request 
        $cert = $this->fetch_public_cert($request); 

        // Pull the public key ID from the certificate 
        $publickeyid = openssl_get_publickey($cert); 

        // Check the computed signature against the one passed in the query 
        $ok = openssl_verify($base_string, $decoded_sig, $publickeyid); 

        // Release the key resource 
        openssl_free_key($publickeyid); 

        return $ok == 1; 
    } 
} 



/** 
 * @ignore 
 */ 
class OAuthDataStore { 
    function lookup_consumer($consumer_key) { 
        // implement me 
    } 

    function lookup_token($consumer, $token_type, $token) { 
        // implement me 
    } 

    function lookup_nonce($consumer, $token, $nonce, $timestamp) { 
        // implement me 
    } 

    function new_request_token($consumer) { 
        // return a new token attached to this consumer 
    } 

    function new_access_token($token, $consumer) { 
        // return a new access token attached to this consumer 
        // for the user associated with this token if the request token 
        // is authorized 
        // should also invalidate the request token 
    } 

} 






