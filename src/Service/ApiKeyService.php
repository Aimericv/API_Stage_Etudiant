<?php 

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class ApiKeyService{

    /**
     * @param Request $request
     * @return bool 
     * */
    
     public function checkApiKey(Request $request): bool{

            $API_KEY=$request->headers->get('API-KEY');
            $API_KEY=strlen($request->headers->get('API-KEY'))==42;
          

            

          

            if ($API_KEY)
            $output=true;

            else 
            $output=false;

            return $output;

     }
}
