<?php
   require_once './config/config.php';

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    class AuthHelper {
        function getAuthHeaders() {
            $header = "";
            if(isset($_SERVER['HTTP_AUTHORIZATION']))
                $header = $_SERVER['HTTP_AUTHORIZATION'];
            if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
                $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            return $header;
        }

        function createToken($payload) {
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            
            $payload['exp'] = time() + JWT_EXP;

            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            
            $signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
            $signature = base64url_encode($signature);

            $token = "$header.$payload.$signature";
            
            return $token;
        }

        function verify($token) {
            $tokenParts = explode(".", $token);
        
            if (count($tokenParts) !== 3) {
                return false; // El token no tiene las tres partes esperadas
            }
        
            list($header, $payload, $signature) = $tokenParts;
        
            $new_signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
            $new_signature = base64url_encode($new_signature);
        
            if ($signature !== $new_signature) {
                return false; // La firma no coincide
            }
        
            $payload = json_decode(base64_decode($payload));
        
            if (!$payload || isset($payload->exp) && $payload->exp < time()) {
                return false; // El token ha expirado o el payload es inválido
            }
        
            return $payload;
        }

        function currentUser() {
            $auth = $this->getAuthHeaders();
            $auth = explode(" ", $auth);

            if($auth[0] != "Bearer") {
                return false;
            }

            return $this->verify($auth[1]);
        }
    }